
<?php include 'header.php'; ?>
<?php require_once 'includes/send_email.php'; ?>

<style>
  /* Store Locator styling */
  .map-container {
      height: 500px;
      width: 100%;
  }
  @media screen and (max-width: 768px) {
      .map-container {
          height: 400px;
      }
  }
  
  /* Store Locator component styling */
  gmpx-store-locator {
      width: 100%;
      height: 100%;
      --gmpx-color-surface: #fff;
      --gmpx-color-on-surface: #212121;
      --gmpx-color-on-surface-variant: #757575;
      --gmpx-color-primary: #1967d2;
      --gmpx-color-outline: #e0e0e0;
      --gmpx-fixed-panel-width-row-layout: 28.5em;
      --gmpx-fixed-panel-height-column-layout: 65%;
      --gmpx-font-family-base: "Roboto", sans-serif;
      --gmpx-font-family-headings: "Roboto", sans-serif;
      --gmpx-font-size-base: 0.875rem;
      --gmpx-hours-color-open: #188038;
      --gmpx-hours-color-closed: #d50000;
      --gmpx-rating-color: #ffb300;
      --gmpx-rating-color-empty: #e0e0e0;
  }
</style>

<div class="container" style="padding-bottom: 60px;">
    
    <div class="text-center" style="margin-bottom: 40px; margin-top: 20px;">
        <h1>Contact Us</h1>
        <p style="color: #666; font-size: 1.1rem;">Send us a message and we will connect you with a specialist broker.</p>
    </div>

    <div style="max-width: 800px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); border: 1px solid #eee;">
        
        <h3 style="margin-bottom: 25px; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px;">Send an Enquiry</h3>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_submit'])) {
            $formData = array(
                'name' => htmlspecialchars(trim($_POST['contact_name'] ?? '')),
                'email' => filter_var(trim($_POST['contact_email'] ?? ''), FILTER_SANITIZE_EMAIL),
                'phone' => htmlspecialchars(trim($_POST['contact_phone'] ?? '')),
                'message' => htmlspecialchars(trim($_POST['contact_message'] ?? ''))
            );
            
            $errors = array();
            if (empty($formData['name'])) $errors[] = "Name is required";
            if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
            if (empty($formData['message'])) $errors[] = "Message is required";
            
            if (empty($errors)) {
                $emailSent = sendContactEmail($formData);
                if ($emailSent) {
                    echo '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px;"><strong>✓ Success!</strong> Your message has been sent.</div>';
                    $formData = array('name' => '', 'email' => '', 'phone' => '', 'message' => '');
                } else {
                    echo '<div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;"><strong>! Error:</strong> Problem sending message.</div>';
                }
            } else {
                echo '<div style="background: #fff3cd; color: #856404; padding: 15px; border-radius: 4px; margin-bottom: 20px;"><strong>! Please fix:</strong><br>' . implode('<br>', $errors) . '</div>';
            }
        } else {
            $formData = array('name' => '', 'email' => '', 'phone' => '', 'message' => '');
        }
        ?>
        
        <form method="POST" action="contact.php">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label style="font-weight: 600; color: #333;">Name *</label>
                    <input type="text" name="contact_name" required value="<?php echo htmlspecialchars($formData['name']); ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div class="form-group">
                    <label style="font-weight: 600; color: #333;">Phone (Optional)</label>
                    <input type="tel" name="contact_phone" value="<?php echo htmlspecialchars($formData['phone']); ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label style="font-weight: 600; color: #333;">Email *</label>
                <input type="email" name="contact_email" required value="<?php echo htmlspecialchars($formData['email']); ?>" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label style="font-weight: 600; color: #333;">Message *</label>
                <textarea name="contact_message" rows="5" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"><?php echo htmlspecialchars($formData['message']); ?></textarea>
            </div>

            <button type="submit" name="contact_submit" class="cta-btn" style="margin-top: 20px; width: 100%; border: none; font-size: 1rem; cursor: pointer;">Send Message</button>
        </form>
    </div>

    <div style="margin-top: 60px; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
        
        <div style="background: #f9f9f9; padding: 30px; border-radius: 8px; height: fit-content;">
            <h3 style="margin-bottom: 20px;">Contact Information</h3>
            
            <div style="margin-bottom: 20px; display: flex; align-items: start;">
                <div style="background: #004aad; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <strong>Our Location:</strong><br>
                    <a href="https://www.google.com/maps/search/?api=1&query=85-87+Station+Rd,+Countesthorpe,+Leicester+LE8+5TD" target="_blank" style="color: #666; text-decoration: none;">
                        85-87 Station Rd, Countesthorpe, Leicester LE8 5TD
                    </a>
                </div>
            </div>

            <div style="margin-bottom: 20px; display: flex; align-items: start;">
                 <div style="background: #004aad; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <strong>Email Us:</strong><br>
                    <a href="mailto:info@motortradeinsurancesra.co.uk" style="color: #666; text-decoration: none;">
                        info@motortradeinsurancesra.co.uk
                    </a>
                </div>
            </div>

            <div style="margin-bottom: 20px; display: flex; align-items: start;">
                 <div style="background: #004aad; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div>
                    <strong>Call Us:</strong><br>
                    <a href="tel:01183701701" style="color: #666; text-decoration: none;">
                        0118 370 1701
                    </a>
                </div>
            </div>

            <div style="display: flex; align-items: start;">
                 <div style="background: #004aad; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <strong>Working Hours:</strong><br>
                    <span style="color: #666;">Mon - Fri: 9:00 AM - 5:00 PM</span>
                </div>
            </div>
        </div>

        <script type="module" src="https://ajax.googleapis.com/ajax/libs/@googlemaps/extended-component-library/0.6.11/index.min.js"></script>
        
        <div class="map-container" style="box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
            <gmpx-api-loader key="YOUR_API_KEY_HERE" solution-channel="GMP_QB_locatorplus_v11_c"></gmpx-api-loader>
            <gmpx-store-locator map-id="DEMO_MAP_ID"></gmpx-store-locator>
        </div>
        <script>
            const CONFIGURATION = {
                "locations": [
                    {
                        "title": "85-87 Station Rd",
                        "address1": "85-87 Station Rd",
                        "address2": "Countesthorpe, Leicester LE8 5TD, UK",
                        "coords": {
                            "lat": 52.5538309373601,
                            "lng": -1.1471998950717954
                        },
                        "placeId": "ChIJZdhKP7pnd0gRdwPR-IqyF4A"
                    }
                ],
                "mapOptions": {
                    "center": {
                        "lat": 52.5538309373601,
                        "lng": -1.1471998950717954
                    },
                    "fullscreenControl": true,
                    "mapTypeControl": false,
                    "streetViewControl": false,
                    "zoom": 15,
                    "zoomControl": true,
                    "maxZoom": 17,
                    "mapId": ""
                },
                "mapsApiKey": "YOUR_API_KEY_HERE",
                "capabilities": {
                    "input": false,
                    "autocomplete": false,
                    "directions": false,
                    "distanceMatrix": false,
                    "details": false,
                    "actions": false
                }
            };
        </script>
        <script type="module">
            document.addEventListener('DOMContentLoaded', async () => {
                await customElements.whenDefined('gmpx-store-locator');
                const locator = document.querySelector('gmpx-store-locator');
                if (locator) {
                    locator.configureFromQuickBuilder(CONFIGURATION);
                }
            });
        </script>

    </div>
</div>

<?php include 'footer.php'; ?>
