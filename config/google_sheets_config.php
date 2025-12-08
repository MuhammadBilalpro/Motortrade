<?php
// Google Sheets Configuration
// Sheet ID from Google Sheets URL: https://docs.google.com/spreadsheets/d/[SHEET_ID]/edit

define('GOOGLE_SHEET_ID', '1CsHItFX0DNeljKmGejmN9ZCPdWxYjQXBFoxYqBWPcHM');
define('GOOGLE_CREDENTIALS_PATH', __DIR__ . '/google_credentials.json');

// Map service types to tab names (worksheet names in Google Sheets)
define('GOOGLE_SHEET_TABS', [
    'Home Page Referral' => 'Home Referral',
    'Motor Trade Insurance' => 'Motor Trade Insurance',
    'High-Risk Driver (Convicted)' => 'High-Risk Driver (Convicted)',
    'Road Risk & Combined' => 'Road Risk & Combined',
    'General Referral' => 'General Referral'
]);

