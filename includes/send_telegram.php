<?php
// Telegram Bot Integration for Motor Trade Referrals
// Sends form submission notifications to Telegram

require_once __DIR__ . '/../config/telegram_config.php';

/**
 * Escape Markdown special characters in user input
 * @param string $text Text to escape
 * @return string Escaped text
 */
function escapeMarkdown($text) {
    // Escape Markdown special characters: * _ [ ] ( ) ~ ` > # + - = | { } . !
    $specialChars = ['*', '_', '[', ']', '(', ')', '~', '`', '>', '#', '+', '-', '=', '|', '{', '}', '.', '!'];
    foreach ($specialChars as $char) {
        $text = str_replace($char, '\\' . $char, $text);
    }
    return $text;
}

/**
 * Build Telegram message text from form data
 * @param array $formData Form submission data
 * @return string Formatted message text
 */
function buildTelegramMessage($formData) {
    $message = "🔔 *New Motor Trade Insurance Referral*\n\n";
    
    // Service Type (with emoji)
    $serviceType = $formData['service_type'] ?? 'General Referral';
    $message .= "📋 *Service Type:* " . $serviceType . "\n";
    $message .= "━━━━━━━━━━━━━━━━━━━━\n\n";
    
    // Name
    $message .= "👤 *Name:* " . escapeMarkdown(htmlspecialchars($formData['name'])) . "\n";
    
    // Date of Birth
    if (!empty($formData['dob'])) {
        $message .= "📅 *Date of Birth:* " . escapeMarkdown(htmlspecialchars($formData['dob'])) . "\n";
    }
    
    // Phone
    $message .= "📞 *Phone:* " . escapeMarkdown(htmlspecialchars($formData['phone'])) . "\n";
    
    // Email (if provided)
    if (!empty($formData['email'])) {
        $message .= "✉️ *Email:* " . escapeMarkdown(htmlspecialchars($formData['email'])) . "\n";
    }
    
    // Business Type / Trade Type
    if (!empty($formData['business_type'])) {
        $message .= "🏢 *Business Type:* " . escapeMarkdown(htmlspecialchars($formData['business_type'])) . "\n";
    }
    
    // Policy Type (for Road Risk)
    if (!empty($formData['policy_type'])) {
        $message .= "📄 *Policy Type:* " . escapeMarkdown(htmlspecialchars($formData['policy_type'])) . "\n";
    }
    
    // Stock Value (for Road Risk)
    if (!empty($formData['stock_value'])) {
        $message .= "💰 *Stock Value:* £" . escapeMarkdown(htmlspecialchars($formData['stock_value'])) . "\n";
    }
    
    // Conviction Code (for High-Risk)
    if (!empty($formData['conviction_code'])) {
        $message .= "⚠️ *Conviction Code:* " . escapeMarkdown(htmlspecialchars($formData['conviction_code'])) . "\n";
    }
    
    // Date of Conviction (for High-Risk - stored in convictions field)
    if (!empty($formData['convictions']) && strpos($formData['service_type'], 'High-Risk') !== false) {
        $message .= "📅 *Date of Conviction:* " . escapeMarkdown(htmlspecialchars($formData['convictions'])) . "\n";
    }
    
    // Convictions (general)
    if (!empty($formData['convictions']) && strpos($formData['service_type'], 'High-Risk') === false) {
        $message .= "⚠️ *Convictions:* " . escapeMarkdown(htmlspecialchars($formData['convictions'])) . "\n";
    }
    
    // Postcode
    if (!empty($formData['postcode'])) {
        $message .= "📍 *Postcode:* " . escapeMarkdown(htmlspecialchars($formData['postcode'])) . "\n";
    }
    
    // Occupation
    if (!empty($formData['occupation'])) {
        $message .= "💼 *Occupation:* " . escapeMarkdown(htmlspecialchars($formData['occupation'])) . "\n";
    }
    
    // Trade NCB
    if (!empty($formData['trade_ncb'])) {
        $message .= "🎯 *Trade NCB:* " . escapeMarkdown(htmlspecialchars($formData['trade_ncb'])) . "\n";
    }
    
    // Submission time
    $message .= "\n━━━━━━━━━━━━━━━━━━━━\n";
    $message .= "🕐 *Submitted:* " . date('d/m/Y H:i:s') . "\n";
    $message .= "\n✅ *Action Required:* Contact customer to provide quote";
    
    return $message;
}

/**
 * Send referral notification to Telegram (to all configured chat IDs and username)
 * @param array $formData Form submission data
 * @return bool True if sent successfully to at least one chat, false otherwise
 */
function sendTelegramNotification($formData) {
    // Check if Telegram is configured
    if (!defined('TELEGRAM_BOT_TOKEN') || empty(TELEGRAM_BOT_TOKEN)) {
        error_log("Telegram: Bot token not configured");
        return false;
    }
    
    $message = buildTelegramMessage($formData);
    $botToken = TELEGRAM_BOT_TOKEN;
    $apiUrl = TELEGRAM_API_URL . $botToken . '/sendMessage';
    
    $successCount = 0;
    $totalChats = 0;
    
    // Send to all configured chat IDs
    if (defined('TELEGRAM_CHAT_IDS') && !empty(TELEGRAM_CHAT_IDS) && is_array(TELEGRAM_CHAT_IDS)) {
        $chatIds = TELEGRAM_CHAT_IDS;
        $totalChats = count($chatIds);
        
        foreach ($chatIds as $chatId) {
            // Prepare data
            $data = [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown', // Allows formatting with *bold*, _italic_, etc.
                'disable_web_page_preview' => true
            ];
            
            // Send via cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);
            
            if ($curlError) {
                error_log("Telegram cURL Error for chat ID {$chatId}: " . $curlError);
                continue;
            }
            
            if ($httpCode !== 200) {
                error_log("Telegram API Error for chat ID {$chatId}: HTTP " . $httpCode . " - Response: " . $response);
                continue;
            }
            
            $result = json_decode($response, true);
            if (isset($result['ok']) && $result['ok'] === true) {
                $successCount++;
                error_log("✓ Telegram notification sent successfully to chat ID: {$chatId}");
            } else {
                $errorDesc = $result['description'] ?? 'Unknown error';
                error_log("Telegram API Error for chat ID {$chatId}: " . $errorDesc);
            }
        }
    }
    
    // Also send to username/group if configured
    if (defined('TELEGRAM_USERNAME') && !empty(TELEGRAM_USERNAME)) {
        $username = TELEGRAM_USERNAME;
        $totalChats++; // Count username as one recipient
        
        // Prepare data for username
        $data = [
            'chat_id' => $username,
            'text' => $message,
            'parse_mode' => 'Markdown',
            'disable_web_page_preview' => true
        ];
        
        // Send via cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        if ($curlError) {
            error_log("Telegram cURL Error for username {$username}: " . $curlError);
        } elseif ($httpCode !== 200) {
            error_log("Telegram API Error for username {$username}: HTTP " . $httpCode . " - Response: " . $response);
        } else {
            $result = json_decode($response, true);
            if (isset($result['ok']) && $result['ok'] === true) {
                $successCount++;
                error_log("✓ Telegram notification sent successfully to username: {$username}");
            } else {
                $errorDesc = $result['description'] ?? 'Unknown error';
                error_log("Telegram API Error for username {$username}: " . $errorDesc);
            }
        }
    }
    
    // Return true if at least one message was sent successfully
    if ($successCount > 0) {
        error_log("Telegram: Sent to {$successCount} out of {$totalChats} recipient(s)");
        return true;
    } else {
        error_log("Telegram: Failed to send to any recipient");
        return false;
    }
}
?>

