# Email Setup Instructions

## PHPMailer Installation

The email system uses PHPMailer to send emails through Hostinger's SMTP server with exact server settings.

### Option 1: Install via Composer (Recommended)

1. Navigate to the `Motortrade` directory in your terminal/command prompt
2. Run the following command:
   ```bash
   composer install
   ```
3. This will install PHPMailer in the `vendor` folder

### Option 2: Manual Installation

If Composer is not available:

1. Download PHPMailer from: https://github.com/PHPMailer/PHPMailer/releases
2. Extract the files
3. Place the `PHPMailer` folder inside the `vendor` directory:
   ```
   Motortrade/
   └── vendor/
       └── PHPMailer/
           ├── src/
           │   ├── Exception.php
           │   ├── PHPMailer.php
           │   └── SMTP.php
   ```

## Email Configuration

1. Open `config/email_config.php`
2. Replace `YOUR_EMAIL_PASSWORD_HERE` with your actual Hostinger email password
3. The configuration uses Hostinger's exact SMTP settings:
   - **SMTP Host**: smtp.hostinger.com
   - **SMTP Port**: 465
   - **Encryption**: SSL

## Fallback Behavior

If PHPMailer is not installed, the system will automatically fall back to PHP's `mail()` function. However, for best results and to use Hostinger's exact SMTP settings, PHPMailer is recommended.

## Testing

After installation and configuration:

1. Submit a test form on the website
2. Check the email inbox at: https://mail.hostinger.com/v2/
3. Verify the email was received

## Troubleshooting

- If emails don't send, check the PHP error logs
- Verify the email password is correct in `config/email_config.php`
- Ensure PHPMailer is properly installed in the `vendor` folder
- Check that port 465 (SSL) is not blocked by your hosting provider

