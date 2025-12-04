<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center">Contact Us</h1>
    
    <div class="contact-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 40px;">
        
        <div>
            <h3>Get in Touch</h3>
            <p>Have a question about how our referral service works? Contact us below.</p>
            <br>
            <p><strong>Email:</strong> email@motortrade-referrals.co.uk</p>
            <p><strong>Phone:</strong> 0800 123 4567 (Optional)</p>
            <p><strong>Operating Hours:</strong><br>Monday - Friday: 9am - 5pm</p>
        </div>

        <div style="background: #f8f9fa; padding: 30px; border-radius: 5px;">
            <h3>Send an Enquiry</h3>
            <form>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea rows="4" required></textarea>
                </div>
                <button type="submit" class="submit-btn" style="padding: 10px;">Send Message</button>
            </form>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>