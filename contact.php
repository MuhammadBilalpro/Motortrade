<?php include 'header.php'; ?>
<?php require_once 'includes/send_email.php'; ?>

<div class="container">
    <h1 class="text-center">Contact Us</h1>
    
    <div class="contact-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 40px;">
        
        <div>
            <h3>Get in Touch</h3>
            <p>Have a question about how our referral service works? Contact us below.</p>
            <br>
            <p><strong>Email:</strong> james@motortradeinsurancesra.co.uk</p>
            <p><strong>Phone:</strong> 0800 123 4567 (Optional)</p>
            <p><strong>Operating Hours:</strong><br>Monday - Friday: 9am - 5pm</p>
        </div>

        <div style="background: #f8f9fa; padding: 30px; border-radius: 5px;">
            <h3>Send an Enquiry</h3>
            
            <?php
            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_submit'])) {
                // Collect and sanitize data
                $formData = array(
                    'name' => htmlspecialchars(trim($_POST['contact_name'] ?? '')),
                    'email' => filter_var(trim($_POST['contact_email'] ?? ''), FILTER_SANITIZE_EMAIL),
                    'phone' => htmlspecialchars(trim($_POST['contact_phone'] ?? '')),
                    'message' => htmlspecialchars(trim($_POST['contact_message'] ?? ''))
                );
                
                // Validate
                $errors = array();
                if (empty($formData['name'])) $errors[] = "Name is required";
                if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Valid email is required";
                }
                if (empty($formData['message'])) $errors[] = "Message is required";
                
                if (empty($errors)) {
                    // Send email
                    $emailSent = sendContactEmail($formData);
                    
                    if ($emailSent) {
                        echo '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                                <strong>✓ Success!</strong> Your message has been sent. We will get back to you shortly.
                              </div>';
                        // Clear form data after successful submission
                        $formData = array('name' => '', 'email' => '', 'phone' => '', 'message' => '');
                    } else {
                        // Log error to console instead of displaying
                        echo '<script>logErrorToConsole("There was a problem sending your message. Please try again or contact us directly.", "error");</script>';
                    }
                } else {
                    // Log validation errors to console instead of displaying
                    echo '<script>logErrorToConsole(' . json_encode('Validation Errors: ' . implode(', ', $errors)) . ', "error");</script>';
                }
            } else {
                $formData = array('name' => '', 'email' => '', 'phone' => '', 'message' => '');
            }
            ?>
            
            <form method="POST" action="contact.php">
                <div class="form-group">
                    <label>Name *</label>
                    <input type="text" name="contact_name" required value="<?php echo htmlspecialchars($formData['name']); ?>">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="contact_email" required value="<?php echo htmlspecialchars($formData['email']); ?>">
                </div>
                <div class="form-group">
                    <label>Phone (Optional)</label>
                    <input type="tel" name="contact_phone" value="<?php echo htmlspecialchars($formData['phone']); ?>">
                </div>
                <div class="form-group">
                    <label>Message *</label>
                    <textarea name="contact_message" rows="4" required><?php echo htmlspecialchars($formData['message']); ?></textarea>
                </div>
                <button type="submit" name="contact_submit" class="submit-btn" style="padding: 10px;">Send Message</button>
            </form>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>