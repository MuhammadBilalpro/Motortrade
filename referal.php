<?php
// Start output buffering to prevent "headers already sent" errors
ob_start();

// Suppress deprecation warnings and hide errors from users
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', 0); // Never show errors to users
ini_set('display_startup_errors', 0); // Never show startup errors
ini_set('log_errors', 1); // Still log errors for debugging

// Log script start
error_log("=== REFERAL.PHP START ===");
error_log("REQUEST_METHOD: " . ($_SERVER["REQUEST_METHOD"] ?? 'NOT SET'));
error_log("POST data: " . json_encode($_POST));

// Load required files FIRST (before any processing to avoid errors)
try {
    error_log("Loading send_email.php...");
    require_once 'includes/send_email.php';
    error_log("✓ send_email.php loaded successfully");
} catch (Exception $e) {
    error_log("✗ ERROR loading send_email.php: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
}

try {
    error_log("Loading send_to_google_sheets.php...");
    require_once 'includes/send_to_google_sheets.php';
    error_log("✓ send_to_google_sheets.php loaded successfully");
} catch (Exception $e) {
    error_log("✗ ERROR loading send_to_google_sheets.php: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
}

// Initialize variables to avoid undefined variable errors
$isHomeForm = false;
$isServiceForm = false;
$formData = array();
$errors = array();
$emailSent = false;
$sheetsSent = false;

// Process form submission (before any HTML output to allow redirects)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    error_log("=== POST REQUEST DETECTED ===");
    
    // Add JavaScript console logging at the start (will be in output buffer)
    ob_start();
    echo "<script>";
    echo "console.log('[FORM] POST request received');";
    echo "console.log('[FORM] Starting form processing...');";
    echo "</script>";
    ob_end_flush();
    ob_start(); // Restart buffer for the rest
    
    try {
        // Detect form type and normalize data
        $isHomeForm = isset($_POST['firstname']) || isset($_POST['surname']);
        $isServiceForm = isset($_POST['name']) && (isset($_POST['trade_type']) || isset($_POST['conviction_code']) || isset($_POST['policy_type']));
        $serviceType = htmlspecialchars(trim($_POST['service_type'] ?? ''));
        
        error_log("Form type detection - isHomeForm: " . ($isHomeForm ? 'YES' : 'NO'));
        error_log("Form type detection - isServiceForm: " . ($isServiceForm ? 'YES' : 'NO'));
        error_log("Service type: " . $serviceType);
    
    if ($isHomeForm) {
        // Home form format (from index.php)
        $title = htmlspecialchars(trim($_POST['title'] ?? ''));
        $firstname = htmlspecialchars(trim($_POST['firstname'] ?? ''));
        $surname = htmlspecialchars(trim($_POST['surname'] ?? ''));
        $fullname = trim($title . ' ' . $firstname . ' ' . $surname);
        
        // Build DOB from separate fields
        $dob_day = htmlspecialchars(trim($_POST['dob_day'] ?? ''));
        $dob_month = htmlspecialchars(trim($_POST['dob_month'] ?? ''));
        $dob_year = htmlspecialchars(trim($_POST['dob_year'] ?? ''));
        $dob = '';
        if (!empty($dob_day) && !empty($dob_month) && !empty($dob_year)) {
            $dob = sprintf('%04d-%02d-%02d', $dob_year, $dob_month, $dob_day);
        }
        
        $formData = array(
            'name' => $fullname,
            'dob' => $dob,
            'phone' => htmlspecialchars(trim($_POST['mobile'] ?? '')),
            'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
            'postcode' => htmlspecialchars(trim($_POST['postcode'] ?? '')),
            'house_number' => htmlspecialchars(trim($_POST['house_number'] ?? '')),
            'occupation' => htmlspecialchars(trim($_POST['occupation'] ?? '')),
            'trade_ncb' => htmlspecialchars(trim($_POST['trade_ncb'] ?? '')),
            'business_type' => htmlspecialchars(trim($_POST['occupation'] ?? '')), // Use occupation as business type
            'convictions' => htmlspecialchars(trim($_POST['convictions'] ?? '')),
            'service_type' => 'Home Page Referral'
        );
    } elseif ($isServiceForm) {
        // Service page form format (motor-trade, high-risk, road-risk)
        $formData = array(
            'name' => htmlspecialchars(trim($_POST['name'] ?? '')),
            'phone' => htmlspecialchars(trim($_POST['phone'] ?? '')),
            'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
            'service_type' => $serviceType ?: 'Service Page Referral'
        );
        
        // Add service-specific fields and ensure correct service type
        if (isset($_POST['trade_type'])) {
            $formData['business_type'] = htmlspecialchars(trim($_POST['trade_type']));
            // Always set service type when trade_type is detected
            $formData['service_type'] = 'Motor Trade Insurance';
        }
        if (isset($_POST['conviction_code'])) {
            $formData['conviction_code'] = htmlspecialchars(trim($_POST['conviction_code']));
            $formData['convictions'] = htmlspecialchars(trim($_POST['details'] ?? ''));
            // Always set service type when conviction_code is detected
            $formData['service_type'] = 'High-Risk Driver (Convicted)';
        }
        if (isset($_POST['policy_type'])) {
            $formData['policy_type'] = htmlspecialchars(trim($_POST['policy_type']));
            $formData['stock_value'] = htmlspecialchars(trim($_POST['stock_value'] ?? ''));
            // Always set service type when policy_type is detected (ensures correct routing)
            $formData['service_type'] = 'Road Risk & Combined';
        }
    } else {
        // Referral form format (from referal.php itself)
        $formData = array(
            'name' => htmlspecialchars(trim($_POST['fullname'] ?? '')),
            'dob' => htmlspecialchars(trim($_POST['dob'] ?? '')),
            'phone' => htmlspecialchars(trim($_POST['phone'] ?? '')),
            'email' => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
            'business_type' => htmlspecialchars(trim($_POST['business_type'] ?? '')),
            'convictions' => htmlspecialchars(trim($_POST['convictions'] ?? '')),
            'service_type' => 'General Referral'
        );
    }
    
    // Validate required fields (relaxed for service forms)
    $errors = array();
    if (empty($formData['name']) || trim($formData['name']) == '') $errors[] = "Name is required";
    if (empty($formData['phone'])) $errors[] = "Phone number is required";
    
    // Email and DOB required for home and referral forms, optional for service forms
    if (!$isServiceForm) {
        if (empty($formData['dob'])) $errors[] = "Date of birth is required";
        if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid email is required";
        }
    } elseif (!empty($formData['email']) && !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    // Consent checkbox for general referral form
    if (!$isHomeForm && !$isServiceForm && empty($_POST['consent'])) {
        $errors[] = "You must consent to the privacy policy.";
    }
    
    error_log("Validation errors count: " . count($errors));
    if (!empty($errors)) {
        error_log("Validation errors: " . json_encode($errors));
    }
    
    if (empty($errors)) {
        error_log("=== NO VALIDATION ERRORS - PROCESSING FORM ===");
        error_log("Form data: " . json_encode($formData));
        
        // Process CSV, email, and Google Sheets for ALL forms (with error handling)
        // Errors won't block redirect - processing happens but redirect always succeeds
        try {
            // Save to CSV (Database simulation) - PRESERVE EXISTING FUNCTIONALITY
            error_log("Saving to CSV...");
            echo "<script>console.log('[FORM] Saving to CSV...');</script>";
            $file = fopen("enquiries.csv", "a");
            if ($file) {
                $data = array(
                    date("Y-m-d H:i:s"), 
                    $formData['name'], 
                    $formData['dob'] ?? 'N/A', 
                    $formData['phone'], 
                    $formData['email'] ?? 'N/A', 
                    $formData['business_type'] ?? ($formData['policy_type'] ?? 'N/A'), 
                    $formData['convictions'] ?? ($formData['conviction_code'] ?? '')
                );
                fputcsv($file, $data);
                fclose($file);
                error_log("✓ CSV saved successfully");
            } else {
                error_log("✗ ERROR: Could not open CSV file for writing");
            }
        } catch (Exception $e) {
            error_log("✗ ERROR saving to CSV: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
        }

        try {
            // Send Email Notification
            error_log("Sending email notification...");
            echo "<script>console.log('[FORM] Sending email notification...');</script>";
            $emailSent = sendReferralEmail($formData);
            error_log("Email sent result: " . ($emailSent ? 'SUCCESS' : 'FAILED'));
        } catch (Exception $e) {
            error_log("✗ ERROR sending email: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            $emailSent = false;
        }
        
        try {
            // Send to Google Sheets
            error_log("Sending to Google Sheets...");
            echo "<script>console.log('[FORM] Sending to Google Sheets...');</script>";
            $sheetsSent = sendToGoogleSheets($formData);
            $sheetsError = $GLOBALS['google_sheets_last_error'] ?? '';
            error_log("Google Sheets result: " . ($sheetsSent ? 'SUCCESS' : 'FAILED'));
            if (!$sheetsSent && !empty($sheetsError)) {
                error_log("Google Sheets error message: " . $sheetsError);
            }
        } catch (Exception $e) {
            error_log("✗ ERROR sending to Google Sheets: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            $sheetsSent = false;
            $sheetsError = $e->getMessage();
        }
        
        // Always log detailed debug info
        error_log("=== PROCESSING SUMMARY ===");
        error_log("Email sent: " . ($emailSent ? 'YES' : 'NO'));
        error_log("Sheets sent: " . ($sheetsSent ? 'YES' : 'NO'));
        error_log("Is home form: " . ($isHomeForm ? 'YES' : 'NO'));
        error_log("Is service form: " . ($isServiceForm ? 'YES' : 'NO'));
        if (defined('GOOGLE_CREDENTIALS_PATH')) {
            error_log("Credentials path: " . GOOGLE_CREDENTIALS_PATH);
            error_log("Credentials exists: " . (file_exists(GOOGLE_CREDENTIALS_PATH) ? 'YES' : 'NO'));
        }
        error_log("Autoload exists: " . (file_exists(__DIR__ . '/vendor/autoload.php') ? 'YES' : 'NO'));
        error_log("Form data keys: " . implode(', ', array_keys($formData)));
        
        // NOW redirect for service and home forms (after processing)
        // End and clean output buffer completely to ensure clean redirect
        if ($isServiceForm || $isHomeForm) {
            try {
                // Log detailed information before redirect (to server logs)
                $obLevel = ob_get_level();
                $headersSent = headers_sent($file, $line);
                $outputBufferLength = ob_get_length();
                
                error_log("=== REDIRECT PREPARATION ===");
                error_log("Output buffer level: " . $obLevel);
                error_log("Output buffer length: " . ($outputBufferLength !== false ? $outputBufferLength : 'N/A'));
                error_log("Headers sent: " . ($headersSent ? "YES (file: {$file}, line: {$line})" : "NO"));
                error_log("Form type: " . ($isServiceForm ? "Service" : "Home"));
                
                // Store redirect info for potential error display
                $redirectInfo = array(
                    'obLevel' => $obLevel,
                    'obLength' => $outputBufferLength !== false ? $outputBufferLength : 0,
                    'headersSent' => $headersSent,
                    'formType' => $isServiceForm ? "Service" : "Home"
                );
                
                // End output buffering completely before redirect
                if ($obLevel > 0) {
                    error_log("Ending output buffer (level: {$obLevel})...");
                    ob_end_clean();
                    error_log("✓ Output buffer ended");
                } else {
                    error_log("No output buffer to end");
                }
                
                $redirectUrl = "success.php?name=" . urlencode($formData['name']);
                error_log("=== REDIRECTING (" . ($isServiceForm ? "Service" : "Home") . " Form) - AFTER PROCESSING ===");
                error_log("Redirect URL: " . $redirectUrl);
                
                // Check if headers can be sent
                if (headers_sent($file, $line)) {
                    $errorMsg = "Cannot redirect: Headers already sent in {$file} on line {$line}";
                    error_log("✗ ERROR: " . $errorMsg);
                    // Output error page with console logging
                    ob_start();
                    echo "<!DOCTYPE html><html><head><title>Redirect Error</title></head><body>";
                    echo "<h1>Redirect Error</h1><p>" . htmlspecialchars($errorMsg) . "</p>";
                    echo "<script>";
                    echo "console.error('[REDIRECT ERROR] " . htmlspecialchars($errorMsg, ENT_QUOTES) . "');";
                    echo "console.error('[REDIRECT ERROR] File: " . htmlspecialchars($file, ENT_QUOTES) . "');";
                    echo "console.error('[REDIRECT ERROR] Line: " . $line . "');";
                    echo "console.error('[REDIRECT ERROR] OB Level: " . $redirectInfo['obLevel'] . "');";
                    echo "console.error('[REDIRECT ERROR] OB Length: " . $redirectInfo['obLength'] . "');";
                    echo "</script></body></html>";
                    ob_end_flush();
                    exit();
                }
                
                // Send redirect header
                error_log("Sending Location header: " . $redirectUrl);
                header("Location: " . $redirectUrl);
                header("HTTP/1.1 302 Found");
                error_log("✓ Headers sent successfully");
                
                // Final check
                $finalObLevel = ob_get_level();
                error_log("Final output buffer level: " . $finalObLevel);
                error_log("=== EXITING AFTER REDIRECT ===");
                
                // Exit immediately
                exit();
                
            } catch (Exception $e) {
                $errorMsg = "Redirect error: " . $e->getMessage();
                error_log("✗ FATAL ERROR in redirect: " . $errorMsg);
                error_log("File: " . $e->getFile());
                error_log("Line: " . $e->getLine());
                error_log("Stack trace: " . $e->getTraceAsString());
                
                // Output error page with detailed console logging
                ob_start();
                echo "<!DOCTYPE html><html><head><title>Redirect Fatal Error</title></head><body>";
                echo "<h1>Redirect Fatal Error</h1>";
                echo "<p><strong>Error:</strong> " . htmlspecialchars($errorMsg) . "</p>";
                echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
                echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>";
                echo "<script>";
                echo "console.error('[REDIRECT FATAL ERROR] " . htmlspecialchars($errorMsg, ENT_QUOTES) . "');";
                echo "console.error('[REDIRECT FATAL ERROR] File: " . htmlspecialchars($e->getFile(), ENT_QUOTES) . "');";
                echo "console.error('[REDIRECT FATAL ERROR] Line: " . $e->getLine() . "');";
                echo "console.error('[REDIRECT FATAL ERROR] Stack: " . htmlspecialchars($e->getTraceAsString(), ENT_QUOTES) . "');";
                echo "</script></body></html>";
                ob_end_flush();
                exit();
                
            } catch (Error $e) {
                $errorMsg = "Fatal PHP error in redirect: " . $e->getMessage();
                error_log("✗ FATAL PHP ERROR in redirect: " . $errorMsg);
                error_log("File: " . $e->getFile());
                error_log("Line: " . $e->getLine());
                
                // Output error page with detailed console logging
                ob_start();
                echo "<!DOCTYPE html><html><head><title>Redirect Fatal PHP Error</title></head><body>";
                echo "<h1>Redirect Fatal PHP Error</h1>";
                echo "<p><strong>Error:</strong> " . htmlspecialchars($errorMsg) . "</p>";
                echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
                echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>";
                echo "<script>";
                echo "console.error('[REDIRECT FATAL PHP ERROR] " . htmlspecialchars($errorMsg, ENT_QUOTES) . "');";
                echo "console.error('[REDIRECT FATAL PHP ERROR] File: " . htmlspecialchars($e->getFile(), ENT_QUOTES) . "');";
                echo "console.error('[REDIRECT FATAL PHP ERROR] Line: " . $e->getLine() . "');";
                echo "</script></body></html>";
                ob_end_flush();
                exit();
            }
        }
        
        // For referral form, continue to show success message below (after header is included)
        error_log("=== NO REDIRECT (Referral Form) ===");
    } else {
        error_log("=== VALIDATION ERRORS - NOT PROCESSING ===");
    }
    // If there are errors, we'll show them below (after header is included)
    } catch (Exception $e) {
        $errorMsg = "Fatal error in POST processing: " . $e->getMessage();
        error_log("✗ FATAL ERROR in POST processing: " . $errorMsg);
        error_log("File: " . $e->getFile());
        error_log("Line: " . $e->getLine());
        error_log("Stack trace: " . $e->getTraceAsString());
        
        // Output error to console (will be in output buffer)
        echo "<script>";
        echo "console.error('[FORM FATAL ERROR] " . htmlspecialchars($errorMsg, ENT_QUOTES) . "');";
        echo "console.error('[FORM FATAL ERROR] File: " . htmlspecialchars($e->getFile(), ENT_QUOTES) . "');";
        echo "console.error('[FORM FATAL ERROR] Line: " . $e->getLine() . "');";
        echo "console.error('[FORM FATAL ERROR] Stack: " . htmlspecialchars($e->getTraceAsString(), ENT_QUOTES) . "');";
        echo "</script>";
        
        $errors[] = "An error occurred processing your request. Please try again.";
    } catch (Error $e) {
        $errorMsg = "Fatal PHP error in POST processing: " . $e->getMessage();
        error_log("✗ FATAL PHP ERROR in POST processing: " . $errorMsg);
        error_log("File: " . $e->getFile());
        error_log("Line: " . $e->getLine());
        
        // Output error to console (will be in output buffer)
        echo "<script>";
        echo "console.error('[FORM FATAL PHP ERROR] " . htmlspecialchars($errorMsg, ENT_QUOTES) . "');";
        echo "console.error('[FORM FATAL PHP ERROR] File: " . htmlspecialchars($e->getFile(), ENT_QUOTES) . "');";
        echo "console.error('[FORM FATAL PHP ERROR] Line: " . $e->getLine() . "');";
        echo "</script>";
        
        $errors[] = "A fatal error occurred. Please try again.";
    }
}

// NOW include header (after processing POST to allow redirects)
// End output buffering and flush any buffered content before including header
ob_end_flush();
error_log("Including header.php...");
try {
    include 'header.php';
    error_log("✓ header.php included successfully");
} catch (Exception $e) {
    error_log("✗ ERROR including header.php: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    // Continue anyway to show error message
}
error_log("=== REFERAL.PHP HTML OUTPUT START ===");
?>

<section style="background-color: #f4f6f8; padding: 40px 20px;">
    <div class="container">
        <h1 class="text-center">Get a Quick Quote</h1>
        <p class="text-center" style="margin-bottom: 30px;">Fill in the details below. Our partner broker will contact you shortly.</p>

        <div class="form-wrapper">
            
            <?php
            // Show success message if redirected from home form
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                $name = isset($_GET['name']) ? htmlspecialchars(urldecode($_GET['name'])) : 'there';
                
                echo '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; text-align: center; margin-bottom: 20px;">
                        <strong>✓ Success!</strong> Thank you, ' . $name . '. Your details have been sent. Our partner broker will contact you shortly.
                      </div>';
            }
            
            // Show success message for referral form (if form was submitted and no redirect happened)
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !$isHomeForm && !$isServiceForm && !empty($formData) && empty($errors)) {
                echo '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; text-align: center; margin-bottom: 20px;">
                        <strong>✓ Success!</strong> Thank you, ' . htmlspecialchars($formData['name']) . '. Your details have been sent. Our partner broker will contact you shortly.
                      </div>';
            }
            
            // Show errors if form was submitted but had validation errors - log to console
            if (isset($errors) && !empty($errors)) {
                echo '<script>logErrorToConsole(' . json_encode('Validation Errors: ' . implode(', ', $errors)) . ', "error");</script>';
            }
            ?>

            <form action="referal.php" method="POST">
                
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="fullname" required placeholder="e.g. John Smith" value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Date of Birth *</label>
                    <input type="date" name="dob" required value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" name="phone" required placeholder="07700 900 000" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" required placeholder="john@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>Business Type *</label>
                    <select name="business_type" required>
                        <option value="">-- Select Option --</option>
                        <option value="Car Sales" <?php echo (isset($_POST['business_type']) && $_POST['business_type'] == 'Car Sales') ? 'selected' : ''; ?>>Car Sales</option>
                        <option value="Mechanic" <?php echo (isset($_POST['business_type']) && $_POST['business_type'] == 'Mechanic') ? 'selected' : ''; ?>>Mechanic / Repair</option>
                        <option value="Valeter" <?php echo (isset($_POST['business_type']) && $_POST['business_type'] == 'Valeter') ? 'selected' : ''; ?>>Valeter</option>
                        <option value="Recovery" <?php echo (isset($_POST['business_type']) && $_POST['business_type'] == 'Recovery') ? 'selected' : ''; ?>>Recovery</option>
                        <option value="Other" <?php echo (isset($_POST['business_type']) && $_POST['business_type'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Do you have any Convictions? (Optional)</label>
                    <textarea name="convictions" rows="3" placeholder="If yes, please list codes (e.g. DR10, IN10) and dates..."><?php echo isset($_POST['convictions']) ? htmlspecialchars($_POST['convictions']) : ''; ?></textarea>
                </div>

                <div class="form-group" style="background: #f9f9f9; padding: 15px; border: 1px solid #eee; font-size: 0.9rem;">
                    <label style="font-weight: normal; display: flex; align-items: flex-start; gap: 10px;">
                        <input type="checkbox" name="consent" required style="width: auto; margin-top: 5px;">
                        <span>I consent to my details being passed to a partner insurance broker for the purpose of a quote. I have read the <a href="privacy.php" target="_blank">Privacy Policy</a>.</span>
                    </label>
                </div>

                <button type="submit" class="submit-btn">GET MY QUOTE <i class="fas fa-arrow-right"></i></button>

            </form>
        </div>
    </div>
</section>

<?php 
error_log("Including footer.php...");
try {
    include 'footer.php';
    error_log("✓ footer.php included successfully");
} catch (Exception $e) {
    error_log("✗ ERROR including footer.php: " . $e->getMessage());
}
error_log("=== REFERAL.PHP END ===");
?>
