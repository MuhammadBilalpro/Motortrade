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
    // DEBUG MODE - Set to true to see detailed errors
    $debugMode = isset($_GET['debug']) || isset($_POST['debug']);
    
    // Check if credentials file exists
    $credentialsPath = GOOGLE_CREDENTIALS_PATH;
    if (!file_exists($credentialsPath)) {
        $error = "Google Sheets: Credentials file not found at " . $credentialsPath;
        error_log($error);
        if ($debugMode) {
            error_log("DEBUG: Credentials path checked: " . $credentialsPath);
            error_log("DEBUG: File exists check: " . (file_exists($credentialsPath) ? 'YES' : 'NO'));
        }
        return false;
    }
    
    // Try to load Google API client
    $autoloadPath = __DIR__ . '/../vendor/autoload.php';
    if (!file_exists($autoloadPath)) {
        $error = "Google Sheets: Autoload file not found at " . $autoloadPath;
        error_log($error);
        if ($debugMode) {
            error_log("DEBUG: Autoload path: " . $autoloadPath);
            error_log("DEBUG: Autoload exists: " . (file_exists($autoloadPath) ? 'YES' : 'NO'));
        }
        return false;
    }
    
    require_once $autoloadPath;
    
    // Get service type and map to tab name
    $serviceType = $formData['service_type'] ?? 'General Referral';
    $tabName = GOOGLE_SHEET_TABS[$serviceType] ?? 'General Referral';
    
    if ($debugMode) {
        error_log("DEBUG: Google API client loaded successfully");
        error_log("DEBUG: Sheet ID: " . GOOGLE_SHEET_ID);
        error_log("DEBUG: Service Type: " . $serviceType);
        error_log("DEBUG: Tab Name: " . $tabName);
    }
    
    try {
        // Create Google Client
        $client = new \Google_Client();
        $client->setApplicationName('Motor Trade Insurance Referrals');
        $client->setScopes(\Google_Service_Sheets::SPREADSHEETS);
        $client->setAuthConfig($credentialsPath);
        $client->setAccessType('offline');
        
        // Fix SSL certificate issue on Windows/localhost
        // For local development: disable SSL verification (NOT for production!)
        if (strpos($_SERVER['HTTP_HOST'] ?? '', 'localhost') !== false || 
            strpos($_SERVER['HTTP_HOST'] ?? '', '127.0.0.1') !== false) {
            $httpClient = new \GuzzleHttp\Client([
                'verify' => false // Disable SSL verification for localhost only
            ]);
            $client->setHttpClient($httpClient);
        }
        
        if ($debugMode) {
            error_log("DEBUG: Google Client created successfully");
        }
        
        // Create Sheets service
        $service = new \Google_Service_Sheets($client);
        
        if ($debugMode) {
            error_log("DEBUG: Google Sheets service created successfully");
        }
        
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
        
        if ($debugMode) {
            error_log("DEBUG: Prepared values: " . json_encode($values));
            error_log("DEBUG: Range: " . $range);
        }
        
        // Prepare the request
        $body = new \Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        
        // Append the row to the sheet (appends after the last row with data)
        $params = [
            'valueInputOption' => 'RAW'
        ];
        
        if ($debugMode) {
            error_log("DEBUG: Attempting to append to range: " . $range);
        }
        
        $result = $service->spreadsheets_values->append(
            GOOGLE_SHEET_ID,
            $range,
            $body,
            $params
        );
        
        if ($debugMode) {
            error_log("DEBUG: Append result received");
            error_log("DEBUG: Updated cells: " . $result->getUpdates()->getUpdatedCells());
        }
        
        // Check if successful
        if ($result->getUpdates()->getUpdatedCells() > 0) {
            if ($debugMode) {
                error_log("DEBUG: Google Sheets update successful!");
            }
            return true;
        }
        
        if ($debugMode) {
            error_log("DEBUG: Google Sheets update returned 0 cells updated");
        }
        return false;
        
    } catch (\Google_Service_Exception $e) {
        $error = "Google Sheets API Error: " . $e->getMessage();
        if ($e->getErrors()) {
            $error .= " | Errors: " . json_encode($e->getErrors());
        }
        error_log($error);
        if ($debugMode) {
            error_log("DEBUG: Google Service Exception caught");
            error_log("DEBUG: Exception details: " . print_r($e->getErrors(), true));
        }
        return false;
    } catch (\Exception $e) {
        $error = "Google Sheets Error: " . $e->getMessage() . " | File: " . $e->getFile() . " | Line: " . $e->getLine();
        error_log($error);
        if ($debugMode) {
            error_log("DEBUG: General Exception caught");
            error_log("DEBUG: Exception class: " . get_class($e));
            error_log("DEBUG: Exception trace: " . $e->getTraceAsString());
        }
        return false;
    }
}

