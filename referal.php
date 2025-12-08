<?php
// Process form submission FIRST (before any HTML output to allow redirects)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'includes/send_email.php';
    require_once 'includes/send_to_google_sheets.php';
    
    // Detect form type and normalize data
    $isHomeForm = isset($_POST['firstname']) || isset($_POST['surname']);
    $isServiceForm = isset($_POST['name']) && (isset($_POST['trade_type']) || isset($_POST['conviction_code']) || isset($_POST['policy_type']));
    $serviceType = htmlspecialchars(trim($_POST['service_type'] ?? ''));
    
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
    
    if (empty($errors)) {
        // Save to CSV (Database simulation) - PRESERVE EXISTING FUNCTIONALITY
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
        }

        // Send Email Notification
        $emailSent = sendReferralEmail($formData);
        
        // Send to Google Sheets
        $sheetsSent = sendToGoogleSheets($formData);
        
        // TEMPORARY DEBUG - Remove after testing
        if (isset($_GET['debug']) || isset($_POST['debug'])) {
            error_log("DEBUG: Google Sheets function called, result: " . ($sheetsSent ? 'SUCCESS' : 'FAILED'));
            error_log("DEBUG: Credentials path: " . (defined('GOOGLE_CREDENTIALS_PATH') ? GOOGLE_CREDENTIALS_PATH : 'NOT DEFINED'));
            error_log("DEBUG: Credentials exists: " . (file_exists(GOOGLE_CREDENTIALS_PATH) ? 'YES' : 'NO'));
            error_log("DEBUG: Autoload exists: " . (file_exists(__DIR__ . '/vendor/autoload.php') ? 'YES' : 'NO'));
            error_log("DEBUG: Form data keys: " . implode(', ', array_keys($formData)));
        }
        
        // Redirect for home/service forms BEFORE any HTML output
        if ($isHomeForm || $isServiceForm) {
            // Redirect to referral page with success message
            $redirectUrl = "referal.php?success=1&name=" . urlencode($formData['name']);
            if ($emailSent) $redirectUrl .= "&email_sent=1";
            if ($sheetsSent) $redirectUrl .= "&sheets_sent=1";
            header("Location: " . $redirectUrl);
            exit();
        }
        // For referral form, we'll show success message below (after header is included)
    }
    // If there are errors, we'll show them below (after header is included)
}

// NOW include header (after processing POST to allow redirects)
include 'header.php';
require_once 'includes/send_email.php';
require_once 'includes/send_to_google_sheets.php';
?>

<section style="background-color: #f4f6f8; padding: 40px 20px;">
    <div class="container">
        <h1 class="text-center">Get a Quick Quote</h1>
        <p class="text-center" style="margin-bottom: 30px;">Fill in the details below. Our partner broker will contact you shortly.</p>

        <div class="form-wrapper">
            
            <?php
            // Show success message if redirected from home/service form
            if (isset($_GET['success']) && $_GET['success'] == 1) {
                $name = isset($_GET['name']) ? htmlspecialchars(urldecode($_GET['name'])) : 'there';
                $emailSent = isset($_GET['email_sent']) && $_GET['email_sent'] == '1';
                $sheetsSent = isset($_GET['sheets_sent']) && $_GET['sheets_sent'] == '1';
                
                echo '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; text-align: center; margin-bottom: 20px;">
                        <strong>✓ Success!</strong> Thank you, ' . $name . '. Your details have been sent. Our partner broker will contact you shortly.';
                
                if ($emailSent) {
                    echo '<br><small style="color: #155724; margin-top: 10px; display: block;">✓ Email notification sent to broker</small>';
                }
                if ($sheetsSent) {
                    echo '<br><small style="color: #155724; margin-top: 10px; display: block;">✓ Data saved to Google Sheets</small>';
                } else {
                    echo '<br><small style="color: #856404; margin-top: 10px; display: block;">⚠ Google Sheets save failed. Check PHP error log for details.</small>';
                }
                
                echo '</div>';
            }
            
            // Show success message for referral form (if form was submitted and no redirect happened)
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($isHomeForm) && isset($isServiceForm) && !$isHomeForm && !$isServiceForm && isset($formData) && isset($errors) && empty($errors)) {
                echo '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; text-align: center; margin-bottom: 20px;">
                        <strong>✓ Success!</strong> Thank you, ' . htmlspecialchars($formData['name']) . '. Your details have been sent. Our partner broker will contact you shortly.';
                
                if (isset($emailSent) && $emailSent) {
                    echo '<br><small style="color: #155724; margin-top: 10px; display: block;">✓ Email notification sent to broker</small>';
                }
                if (isset($sheetsSent) && $sheetsSent) {
                    echo '<br><small style="color: #155724; margin-top: 10px; display: block;">✓ Data saved to Google Sheets</small>';
                } else {
                    echo '<br><small style="color: #856404; margin-top: 10px; display: block;">⚠ Google Sheets save failed. Check PHP error log for details.</small>';
                }
                
                echo '</div>';
            }
            
            // Show errors if form was submitted but had validation errors
            if (isset($errors) && !empty($errors)) {
                echo '<div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                        <strong>Error:</strong> Please correct the following:<ul style="margin: 10px 0 0 20px;">';
                foreach ($errors as $error) {
                    echo '<li>' . htmlspecialchars($error) . '</li>';
                }
                echo '</ul></div>';
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

<?php include 'footer.php'; ?>
