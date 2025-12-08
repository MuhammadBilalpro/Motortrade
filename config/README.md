# Email Configuration

## Setup Instructions

1. **Install PHPMailer** (see INSTALLATION.md in root directory)
2. Open `email_config.php`
3. Replace `YOUR_EMAIL_PASSWORD_HERE` with your actual Hostinger email password
4. The email will be sent to: `james@motortradeinsurancesra.co.uk`

## Hostinger SMTP Settings (Exact)

The configuration uses Hostinger's exact server settings:

### Outgoing Server (SMTP)
- **Host**: smtp.hostinger.com
- **Port**: 465
- **Encryption**: SSL

### Incoming Server (IMAP)
- **Host**: imap.hostinger.com
- **Port**: 993
- **Encryption**: SSL

### Incoming Server (POP)
- **Host**: pop.hostinger.com
- **Port**: 995
- **Encryption**: SSL

## Email Access

- **Webmail**: https://mail.hostinger.com/v2/
- **Email**: james@motortradeinsurancesra.co.uk
- **Password**: (Your Hostinger email password)

## Testing

After updating the password and installing PHPMailer, test by submitting a form on the website. Check the email inbox at https://mail.hostinger.com/v2/

