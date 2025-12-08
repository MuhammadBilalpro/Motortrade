<?php
// Email sending functions for Motor Trade Referrals
// Uses PHPMailer with Hostinger SMTP settings

require_once __DIR__ . '/../config/email_config.php';

// Try to load PHPMailer (via Composer or manual install)
$phpmailerLoaded = false;
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
    $phpmailerLoaded = true;
} elseif (file_exists(__DIR__ . '/../vendor/PHPMailer/src/Exception.php')) {
    require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';
    require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
    require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';
    $phpmailerLoaded = true;
}

// Note: We use fully qualified class names (\PHPMailer\PHPMailer\PHPMailer)
// instead of 'use' statements to avoid syntax errors when PHPMailer is not loaded

/**
 * Build HTML email body for referral
 */
function buildReferralEmailBody($formData) {
    $htmlBody = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 0 auto; padding: 0; }
            .header { background: #951F20; color: white; padding: 20px; text-align: center; }
            .content { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
            table { width: 100%; border-collapse: collapse; margin-top: 15px; }
            td { padding: 10px; border: 1px solid #ddd; }
            .label { background: #e9e9e9; font-weight: bold; width: 40%; }
            .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; background: #fff; }
            .action-box { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2 style="margin: 0;">New Motor Trade Insurance Referral</h2>
            </div>
            <div class="content">
                <p><strong>A new referral has been submitted through the website.</strong></p>
                <table>
                    <tr>
                        <td class="label">Full Name:</td>
                        <td>' . htmlspecialchars($formData['name']) . '</td>
                    </tr>';
    
    if (!empty($formData['dob'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Date of Birth:</td>
                        <td>' . htmlspecialchars($formData['dob']) . '</td>
                    </tr>';
    }
    
    $htmlBody .= '
                    <tr>
                        <td class="label">Phone Number:</td>
                        <td>' . htmlspecialchars($formData['phone']) . '</td>
                    </tr>';
    
    if (!empty($formData['business_type'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Business Type:</td>
                        <td>' . htmlspecialchars($formData['business_type']) . '</td>
                    </tr>';
    }
    
    if (!empty($formData['service_type'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Service Type:</td>
                        <td>' . htmlspecialchars($formData['service_type']) . '</td>
                    </tr>';
    }
    
    if (!empty($formData['postcode'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Postcode:</td>
                        <td>' . htmlspecialchars($formData['postcode']) . '</td>
                    </tr>';
    }
    
    if (!empty($formData['occupation'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Occupation:</td>
                        <td>' . htmlspecialchars($formData['occupation']) . '</td>
                    </tr>';
    }
    
    if (!empty($formData['trade_ncb'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Trade NCB:</td>
                        <td>' . htmlspecialchars($formData['trade_ncb']) . '</td>
                    </tr>';
    }
    
    if (!empty($formData['convictions'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Convictions:</td>
                        <td>' . nl2br(htmlspecialchars($formData['convictions'])) . '</td>
                    </tr>';
    }
    
    if (!empty($formData['conviction_code'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Conviction Code:</td>
                        <td>' . htmlspecialchars($formData['conviction_code']) . '</td>
                    </tr>';
    }
    
    if (!empty($formData['policy_type'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Policy Type:</td>
                        <td>' . htmlspecialchars($formData['policy_type']) . '</td>
                    </tr>';
    }
    
    if (!empty($formData['stock_value'])) {
        $htmlBody .= '
                    <tr>
                        <td class="label">Stock Value:</td>
                        <td>£' . htmlspecialchars($formData['stock_value']) . '</td>
                    </tr>';
    }
    
    $htmlBody .= '
                    <tr>
                        <td class="label">Submitted Date:</td>
                        <td>' . date('d/m/Y H:i:s') . '</td>
                    </tr>
                </table>
                <div class="action-box">
                    <strong>Action Required:</strong> Please contact this customer to provide a quote.
                </div>
            </div>
            <div class="footer">
                <p>This is an automated email from motortradeinsurancesra.co.uk</p>
                <p>Do not reply to this email. Contact the customer directly using the email address provided above.</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $htmlBody;
}

/**
 * Build plain text email body for referral
 */
function buildReferralEmailText($formData) {
    $textBody = "New Motor Trade Insurance Referral\n\n";
    $textBody .= "Name: " . $formData['name'] . "\n";
    if (!empty($formData['dob'])) {
        $textBody .= "Date of Birth: " . $formData['dob'] . "\n";
    }
    $textBody .= "Phone: " . $formData['phone'] . "\n";
    if (!empty($formData['business_type'])) {
        $textBody .= "Business Type: " . $formData['business_type'] . "\n";
    }
    if (!empty($formData['service_type'])) {
        $textBody .= "Service Type: " . $formData['service_type'] . "\n";
    }
    if (!empty($formData['convictions'])) {
        $textBody .= "Convictions: " . $formData['convictions'] . "\n";
    }
    $textBody .= "\nSubmitted: " . date('d/m/Y H:i:s');
    $textBody .= "\n\nAction Required: Please contact this customer to provide a quote.";
    
    return $textBody;
}

/**
 * Send referral email notification using PHPMailer with Hostinger SMTP
 * @param array $formData - Array containing form submission data
 * @return bool - True if email sent successfully, false otherwise
 */
function sendReferralEmail($formData) {
    global $phpmailerLoaded;
    
    $subject = 'New Motor Trade Insurance Referral - ' . date('d/m/Y H:i');
    $htmlBody = buildReferralEmailBody($formData);
    $textBody = buildReferralEmailText($formData);
    
    // Use PHPMailer if available
    if ($phpmailerLoaded) {
        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            
            // Server settings - Exact Hostinger SMTP settings
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USERNAME;
            $mail->Password   = SMTP_PASSWORD;
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS; // SSL for port 465
            $mail->Port       = SMTP_PORT;
            $mail->CharSet    = 'UTF-8';
            
            // Recipients
            $mail->setFrom(FROM_EMAIL, FROM_NAME);
            $mail->addAddress(RECIPIENT_EMAIL);
            if (!empty($formData['email'])) {
                $mail->addReplyTo($formData['email'], $formData['name']);
            }
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = $textBody;
            
            $mail->send();
            return true;
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            error_log("PHPMailer Error: " . $mail->ErrorInfo);
            // Fall back to PHP mail() if PHPMailer fails
            return sendReferralEmailFallback($formData, $subject, $htmlBody);
        }
    } else {
        // Fallback to PHP mail() if PHPMailer not available
        return sendReferralEmailFallback($formData, $subject, $htmlBody);
    }
}

/**
 * Fallback email sending using PHP mail() function
 */
function sendReferralEmailFallback($formData, $subject, $htmlBody) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . FROM_NAME . " <" . FROM_EMAIL . ">" . "\r\n";
    if (!empty($formData['email'])) {
        $headers .= "Reply-To: " . $formData['email'] . "\r\n";
    }
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    $mailSent = @mail(RECIPIENT_EMAIL, $subject, $htmlBody, $headers);
    
    if ($mailSent) {
        return true;
    } else {
        error_log("Email sending failed for referral: " . ($formData['email'] ?? 'unknown'));
        return false;
    }
}

/**
 * Build HTML email body for contact form
 */
function buildContactEmailBody($formData) {
    $htmlBody = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 0; }
            .header { background: #951F20; color: white; padding: 20px; text-align: center; }
            .content { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; }
            .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2 style="margin: 0;">New Contact Enquiry</h2>
            </div>
            <div class="content">
                <p><strong>A new enquiry has been submitted through the contact form.</strong></p>
                <p><strong>Name:</strong> ' . htmlspecialchars($formData['name']) . '</p>';
    
    if (!empty($formData['email'])) {
        $htmlBody .= '<p><strong>Email:</strong> <a href="mailto:' . htmlspecialchars($formData['email']) . '">' . htmlspecialchars($formData['email']) . '</a></p>';
    }
    
    if (!empty($formData['phone'])) {
        $htmlBody .= '<p><strong>Phone:</strong> ' . htmlspecialchars($formData['phone']) . '</p>';
    }
    
    $htmlBody .= '
                <p><strong>Message:</strong></p>
                <div style="background: white; padding: 15px; border-left: 4px solid #951F20; margin-top: 10px;">
                    ' . nl2br(htmlspecialchars($formData['message'])) . '
                </div>
                <p style="margin-top: 20px;"><strong>Submitted:</strong> ' . date('d/m/Y H:i:s') . '</p>
            </div>
            <div class="footer">
                <p>This is an automated email from motortradeinsurancesra.co.uk</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $htmlBody;
}

/**
 * Send contact enquiry email using PHPMailer with Hostinger SMTP
 * @param array $formData - Array containing contact form data
 * @return bool - True if email sent successfully, false otherwise
 */
function sendContactEmail($formData) {
    global $phpmailerLoaded;
    
    $subject = 'New Contact Enquiry - ' . date('d/m/Y H:i');
    $htmlBody = buildContactEmailBody($formData);
    
    // Use PHPMailer if available
    if ($phpmailerLoaded) {
        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            
            // Server settings - Exact Hostinger SMTP settings
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USERNAME;
            $mail->Password   = SMTP_PASSWORD;
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS; // SSL for port 465
            $mail->Port       = SMTP_PORT;
            $mail->CharSet    = 'UTF-8';
            
            // Recipients
            $mail->setFrom(FROM_EMAIL, FROM_NAME);
            $mail->addAddress(RECIPIENT_EMAIL);
            if (!empty($formData['email'])) {
                $mail->addReplyTo($formData['email'], $formData['name']);
            }
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = strip_tags($htmlBody);
            
            $mail->send();
            return true;
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            error_log("PHPMailer Error: " . $mail->ErrorInfo);
            // Fall back to PHP mail() if PHPMailer fails
            return sendContactEmailFallback($formData, $subject, $htmlBody);
        }
    } else {
        // Fallback to PHP mail() if PHPMailer not available
        return sendContactEmailFallback($formData, $subject, $htmlBody);
    }
}

/**
 * Fallback email sending for contact form using PHP mail() function
 */
function sendContactEmailFallback($formData, $subject, $htmlBody) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . FROM_NAME . " <" . FROM_EMAIL . ">" . "\r\n";
    if (!empty($formData['email'])) {
        $headers .= "Reply-To: " . $formData['email'] . "\r\n";
    }
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    $mailSent = @mail(RECIPIENT_EMAIL, $subject, $htmlBody, $headers);
    
    if ($mailSent) {
        return true;
    } else {
        error_log("Contact email sending failed: " . ($formData['email'] ?? 'unknown'));
        return false;
    }
}
?>
