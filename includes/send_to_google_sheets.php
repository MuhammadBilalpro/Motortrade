<?php
// Google Sheets Integration for Motor Trade Referrals
// Sends form submission data to Google Sheets

require_once __DIR__ . '/../config/google_sheets_config.php';

/**
 * Send referral data to Google Sheets
 * @param array $formData Form submission data
 * @return bool True if successful, false otherwise
 */
function sendToGoogleSheets($formData) {
    // Always log detailed information for debugging
    error_log("=== GOOGLE SHEETS FUNCTION CALLED ===");
    error_log("Form data service_type: " . ($formData['service_type'] ?? 'NOT SET'));
    error_log("Form data keys: " . implode(', ', array_keys($formData)));
    
    // Check if credentials file exists
    $credentialsPath = GOOGLE_CREDENTIALS_PATH;
    error_log("Checking credentials at: " . $credentialsPath);
    error_log("Credentials path defined: " . (defined('GOOGLE_CREDENTIALS_PATH') ? 'YES' : 'NO'));
    
    if (!file_exists($credentialsPath)) {
        $error = "Google Sheets: Credentials file not found at " . $credentialsPath;
        error_log("✗ " . $error);
        error_log("File exists check: " . (file_exists($credentialsPath) ? 'YES' : 'NO'));
        error_log("Directory exists: " . (is_dir(dirname($credentialsPath)) ? 'YES' : 'NO'));
        if (is_dir(dirname($credentialsPath))) {
            $files = @scandir(dirname($credentialsPath));
            if ($files) {
                error_log("Files in config directory: " . implode(', ', array_filter($files, function($f) { return $f !== '.' && $f !== '..'; })));
            }
        }
        error_log("Absolute path: " . realpath($credentialsPath) ?: 'PATH DOES NOT EXIST');
        return false;
    }
    error_log("✓ Credentials file found");
    error_log("Credentials file size: " . filesize($credentialsPath) . " bytes");
    
    // Try to load Google API client
    $autoloadPath = __DIR__ . '/../vendor/autoload.php';
    error_log("Checking autoload at: " . $autoloadPath);
    if (!file_exists($autoloadPath)) {
        $error = "Google Sheets: Autoload file not found at " . $autoloadPath;
        error_log("✗ " . $error);
        error_log("Autoload exists: " . (file_exists($autoloadPath) ? 'YES' : 'NO'));
        error_log("Vendor directory exists: " . (is_dir(__DIR__ . '/../vendor') ? 'YES' : 'NO'));
        if (is_dir(__DIR__ . '/../vendor')) {
            $vendorFiles = @scandir(__DIR__ . '/../vendor');
            if ($vendorFiles) {
                error_log("Vendor directory contents (first 10): " . implode(', ', array_slice(array_filter($vendorFiles, function($f) { return $f !== '.' && $f !== '..'; }), 0, 10)));
            }
        }
        return false;
    }
    error_log("✓ Autoload file found");
    
    try {
        require_once $autoloadPath;
        error_log("✓ Autoload file loaded successfully");
    } catch (Exception $e) {
        error_log("✗ ERROR loading autoload: " . $e->getMessage());
        return false;
    }
    
    // Get service type and map to tab name
    $serviceType = $formData['service_type'] ?? 'General Referral';
    $tabName = GOOGLE_SHEET_TABS[$serviceType] ?? 'General Referral';
    
    error_log("Google API client loaded successfully");
    error_log("Sheet ID: " . GOOGLE_SHEET_ID);
    error_log("Service Type: " . $serviceType);
    error_log("Tab Name: " . $tabName);
    error_log("Available tabs: " . json_encode(GOOGLE_SHEET_TABS));
    
    try {
        error_log("Creating Google Client...");
        // Create Google Client
        $client = new \Google_Client();
        $client->setApplicationName('Motor Trade Insurance Referrals');
        $client->setScopes(\Google_Service_Sheets::SPREADSHEETS);
        error_log("Setting auth config from: " . $credentialsPath);
        $client->setAuthConfig($credentialsPath);
        $client->setAccessType('offline');
        
        // Fix SSL certificate issue - check if we need to disable SSL verification
        $host = $_SERVER['HTTP_HOST'] ?? '';
        error_log("HTTP_HOST: " . $host);
        if (strpos($host, 'localhost') !== false || 
            strpos($host, '127.0.0.1') !== false ||
            strpos($host, '.local') !== false) {
            error_log("Localhost detected - disabling SSL verification");
            $httpClient = new \GuzzleHttp\Client([
                'verify' => false // Disable SSL verification for localhost only
            ]);
            $client->setHttpClient($httpClient);
        } else {
            error_log("Production server - using default SSL verification");
        }
        
        error_log("✓ Google Client created successfully");
        
        // Create Sheets service
        error_log("Creating Google Sheets service...");
        $service = new \Google_Service_Sheets($client);
        error_log("✓ Google Sheets service created successfully");
        
        // Prepare data row based on service type (matching exact column order for each tab)
        $values = [];
        $range = '';
        
        switch ($serviceType) {
            case 'Home Page Referral':
                // Home Referral: Timestamp | Name | Date of Birth | Phone | Email | Postcode | House number | Occupation | Trade NCB | Business Type | Convictions | Service Type
                $values = [[
                    date("Y-m-d H:i:s"),
                    $formData['name'] ?? 'N/A',
                    $formData['dob'] ?? 'N/A',
                    $formData['phone'] ?? 'N/A',
                    $formData['email'] ?? 'N/A',
                    $formData['postcode'] ?? 'N/A',
                    $formData['house_number'] ?? 'N/A',
                    $formData['occupation'] ?? 'N/A',
                    $formData['trade_ncb'] ?? 'N/A',
                    $formData['business_type'] ?? 'N/A',
                    $formData['convictions'] ?? 'N/A',
                    $serviceType
                ]];
                $range = $tabName . '!A:L'; // 12 columns
                break;
                
            case 'Motor Trade Insurance':
                // Motor Trade Insurance: Timestamp | Name | Phone | Email | Business Type | Service Type
                $values = [[
                    date("Y-m-d H:i:s"),
                    $formData['name'] ?? 'N/A',
                    $formData['phone'] ?? 'N/A',
                    $formData['email'] ?? 'N/A',
                    $formData['business_type'] ?? 'N/A',
                    $serviceType
                ]];
                $range = $tabName . '!A:F'; // 6 columns
                break;
                
            case 'High-Risk Driver (Convicted)':
                // High-Risk Driver: Timestamp | Name | Phone | Email | Conviction Code | Conviction Details | Service Type
                $values = [[
                    date("Y-m-d H:i:s"),
                    $formData['name'] ?? 'N/A',
                    $formData['phone'] ?? 'N/A',
                    $formData['email'] ?? 'N/A',
                    $formData['conviction_code'] ?? 'N/A',
                    $formData['convictions'] ?? ($formData['details'] ?? 'N/A'),
                    $serviceType
                ]];
                $range = $tabName . '!A:G'; // 7 columns
                break;
                
            case 'Road Risk & Combined':
                // Road Risk & Combined: Timestamp | Name | Phone | Email | Policy Type | Stock Value | Service Type
                $values = [[
                    date("Y-m-d H:i:s"),
                    $formData['name'] ?? 'N/A',
                    $formData['phone'] ?? 'N/A',
                    $formData['email'] ?? 'N/A',
                    $formData['policy_type'] ?? 'N/A',
                    $formData['stock_value'] ?? 'N/A',
                    $serviceType
                ]];
                $range = $tabName . '!A:G'; // 7 columns
                break;
                
            case 'General Referral':
            default:
                // General Referral: Timestamp | Name | Date of Birth | Phone | Email | Business Type | Convictions | Service Type
                $values = [[
                    date("Y-m-d H:i:s"),
                    $formData['name'] ?? 'N/A',
                    $formData['dob'] ?? 'N/A',
                    $formData['phone'] ?? 'N/A',
                    $formData['email'] ?? 'N/A',
                    $formData['business_type'] ?? 'N/A',
                    $formData['convictions'] ?? 'N/A',
                    $serviceType
                ]];
                $range = $tabName . '!A:H'; // 8 columns
                break;
        }
        
        error_log("Prepared values: " . json_encode($values));
        error_log("Range: " . $range);
        error_log("Number of columns: " . count($values[0] ?? []));
        
        // Prepare the request
        error_log("Preparing request body...");
        $body = new \Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        
        // Append the row to the sheet (appends after the last row with data)
        $params = [
            'valueInputOption' => 'RAW'
        ];
        
        error_log("Attempting to append to range: " . $range);
        error_log("Sheet ID: " . GOOGLE_SHEET_ID);
        error_log("Full range: " . $tabName . "!" . $range);
        
        $result = $service->spreadsheets_values->append(
            GOOGLE_SHEET_ID,
            $range,
            $body,
            $params
        );
        
        error_log("Append result received");
        $updatedCells = $result->getUpdates()->getUpdatedCells();
        error_log("Updated cells: " . $updatedCells);
        error_log("Updated range: " . ($result->getUpdates()->getUpdatedRange() ?? 'N/A'));
        error_log("Spreadsheet ID: " . ($result->getSpreadsheetId() ?? 'N/A'));
        
        // Check if successful
        if ($updatedCells > 0) {
            error_log("✓ Google Sheets update successful!");
            error_log("=== GOOGLE SHEETS FUNCTION SUCCESS ===");
            return true;
        }
        
        error_log("✗ Google Sheets update returned 0 cells updated");
        error_log("=== GOOGLE SHEETS FUNCTION FAILED (0 cells) ===");
        return false;
        
    } catch (\Google_Service_Exception $e) {
        $error = "Google Sheets API Error: " . $e->getMessage();
        if ($e->getErrors()) {
            $error .= " | Errors: " . json_encode($e->getErrors());
        }
        error_log("✗ " . $error);
        error_log("Google Service Exception caught");
        error_log("Exception code: " . $e->getCode());
        error_log("Exception details: " . print_r($e->getErrors(), true));
        if ($e->getErrors()) {
            foreach ($e->getErrors() as $err) {
                error_log("  - Error: " . ($err['message'] ?? 'N/A') . " | Domain: " . ($err['domain'] ?? 'N/A') . " | Reason: " . ($err['reason'] ?? 'N/A'));
            }
        }
        error_log("=== GOOGLE SHEETS FUNCTION FAILED (API Exception) ===");
        return false;
    } catch (\Exception $e) {
        $error = "Google Sheets Error: " . $e->getMessage() . " | File: " . $e->getFile() . " | Line: " . $e->getLine();
        error_log("✗ " . $error);
        error_log("General Exception caught");
        error_log("Exception class: " . get_class($e));
        error_log("Exception code: " . $e->getCode());
        error_log("Exception trace: " . $e->getTraceAsString());
        error_log("=== GOOGLE SHEETS FUNCTION FAILED (General Exception) ===");
        return false;
    }
}

