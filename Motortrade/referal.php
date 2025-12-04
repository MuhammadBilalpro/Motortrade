<?php include 'header.php'; ?>

<section style="background-color: #f4f6f8; padding: 40px 20px;">
    <div class="container">
        <h1 class="text-center">Get a Quick Quote</h1>
        <p class="text-center" style="margin-bottom: 30px;">Fill in the details below. Our partner broker will contact you shortly.</p>

        <div class="form-wrapper">
            
            <?php
            // PHP Logic to Handle Form
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Collect Data
                $fullname = htmlspecialchars($_POST['fullname']);
                $business = htmlspecialchars($_POST['business_type']);
                
                // Save to CSV (Database simulation)
                $file = fopen("enquiries.csv","a");
                $data = array(date("Y-m-d H:i:s"), $fullname, $_POST['dob'], $_POST['phone'], $_POST['email'], $business, $_POST['convictions']);
                fputcsv($file, $data);
                fclose($file);

                // Confirmation Notice
                echo '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; text-align: center; margin-bottom: 20px;">
                        <strong>Success!</strong> Thank you, ' . $fullname . '. Your details have been sent. Our partner broker will call you soon.
                      </div>';
            }
            ?>

            <form action="referral.php" method="POST">
                
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="fullname" required placeholder="e.g. John Smith">
                </div>

                <div class="form-group">
                    <label>Date of Birth *</label>
                    <input type="date" name="dob" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" name="phone" required placeholder="07700 900 000">
                    </div>
                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" required placeholder="john@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <label>Business Type *</label>
                    <select name="business_type" required>
                        <option value="">-- Select Option --</option>
                        <option value="Car Sales">Car Sales</option>
                        <option value="Mechanic">Mechanic / Repair</option>
                        <option value="Valeter">Valeter</option>
                        <option value="Recovery">Recovery</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Do you have any Convictions? (Optional)</label>
                    <textarea name="convictions" rows="3" placeholder="If yes, please list codes (e.g. DR10, IN10) and dates..."></textarea>
                </div>

                <div class="form-group" style="background: #f9f9f9; padding: 15px; border: 1px solid #eee; font-size: 0.9rem;">
                    <label style="font-weight: normal; display: flex; align-items: flex-start; gap: 10px;">
                        <input type="checkbox" required style="width: auto; margin-top: 5px;">
                        <span>I consent to my details being passed to a partner insurance broker for the purpose of a quote. I have read the Privacy Policy.</span>
                    </label>
                </div>

                <button type="submit" class="submit-btn">GET MY QUOTE <i class="fas fa-arrow-right"></i></button>

            </form>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>