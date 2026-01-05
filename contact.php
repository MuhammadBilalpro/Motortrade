<?php include 'header.php'; ?>
<?php require_once 'includes/send_email.php'; ?>

<div class="container">
    <h1 class="text-center">Contact Us</h1>
    
    <div class="contact-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; margin-top: 40px;">
        
        <div>
            <h3>Get in Touch</h3>
            <p>Have a question about how our referral service works? Contact us below.</p>
            <br>
            
            <p style="margin-bottom: 15px;">
                <i class="fas fa-map-marker-alt" style="color: #333; width: 20px;"></i> 
                <strong>Address:</strong><br>
                <a href="https://www.google.com/maps?q=Leicester+LE1+1AA" target="_blank" style="color: inherit; text-decoration: none; margin-left: 25px;">
                    Street15, Leicester LE1 1AA
                </a>
            </p>

            <p style="margin-bottom: 15px;">
                <i class="fas fa-envelope" style="color: #333; width: 20px;"></i> 
                <strong>Email:</strong><br>
                <a href="mailto:james@motortradeinsurancesra.co.uk" style="color: inherit; text-decoration: none; margin-left: 25px;">
                    james@motortradeinsurancesra.co.uk
                </a>
            </p>

            <p style="margin-bottom: 15px;">
                <i class="fas fa-phone-alt" style="color: #333; width: 20px;"></i> 
                <strong>Phone:</strong><br>
                <a href="tel:01183701701" style="color: inherit; text-decoration: none; margin-left: 25px;">
                    0118 370 1701
                </a> (Optional)
            </p>

            <p style="margin-bottom: 25px;">
                <i class="fas fa-clock" style="color: #333; width: 20px;"></i> 
                <strong>Operating Hours:</strong><br>
                <span style="margin-left: 25px;">Monday - Friday: 9am - 5pm</span>
            </p>

            <div style="width: 100%; height: 300px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    scrolling="no" 
                    marginheight="0" 
                    marginwidth="0" 
                    src="https://maps.google.com/maps?q=Leicester%20LE1%201AA&t=&z=15&ie=UTF8&iwloc=&output=embed">
                </iframe>
            </div>
        </div>

        <div style="background: #f8f9fa; padding: 30px; border-radius: 5px; height: fit-content;">
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
                        echo '<script>console.error("Mail Error: There was a problem sending your message.");</script>';
                        echo '<div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                                <strong>! Error:</strong> There was a problem sending your message. Please try again.
                              </div>';
                    }
                } else {
                    // Display validation errors nicely
                    echo '<div style="background: #fff3cd; color: #856404; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                            <strong>! Please fix the following:</strong><br>' . implode('<br>', $errors) . '
                          </div>';
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
                <button type="submit" name="contact_submit" class="submit-btn" style="padding: 10px; width: 100%;">Send Message</button>
            </form>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>
