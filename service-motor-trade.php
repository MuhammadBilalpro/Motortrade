<?php include 'header.php'; ?>

<section class="hero-split" style="background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=1600&q=80'); background-size: cover; background-position: center;">
    
    <div class="hero-text-box">
        <h1>Motor Trade <span>Insurance</span></h1>
        <h2>Comprehensive Cover for Dealers & Mechanics</h2>
        <ul>
            <li><i class="fas fa-check"></i> Buying & Selling Vehicles</li>
            <li><i class="fas fa-check"></i> Mechanics & Servicing</li>
            <li><i class="fas fa-check"></i> Customer Vehicles Covered</li>
            <li><i class="fas fa-check"></i> Liability Protection Included</li>
        </ul>
    </div>

    <div class="hero-form-3d">
        <div class="form-3d-header">
            Get Trade Quote
        </div>
        <div class="form-3d-body">
            <form action="referal.php" method="POST">
                <input type="hidden" name="service_type" value="Motor Trade Insurance">
                <div class="form-row">
                    <input type="text" name="name" class="input-3d" placeholder="Full Name" required>
                </div>
                <div class="form-row">
                    <input type="tel" name="phone" class="input-3d" placeholder="Phone Number" required>
                </div>
                <div class="form-row">
                    <input type="email" name="email" class="input-3d" placeholder="Email Address">
                </div>
                <div class="form-row">
                    <select name="trade_type" class="input-3d">
                        <option>Business Type?</option>
                        <option>Car Sales</option>
                        <option>Mechanic</option>
                        <option>Valeter</option>
                        <option>Recovery</option>
                    </select>
                </div>
                <button type="submit" class="btn-3d">Get Quote Now</button>
            </form>
            <p style="text-align:center; font-size:0.75rem; color:#888; margin-top:15px;">Compare top UK brokers in minutes.</p>
        </div>
    </div>
</section>

<section class="container">
    <div class="text-center">
        <h2 class="section-title">Who is this for?</h2>
        <p class="section-subtitle">Designed for anyone buying, selling, or repairing cars for profit.</p>
    </div>

    <div class="about-wrapper" style="margin-top:40px;">
        <div class="about-text">
            <h3>Protect Your Business Assets</h3>
            <p>Whether you trade from home, a small unit, or a large forecourt, Motor Trade Insurance is the backbone of your business. It allows you to legally drive vehicles you don't own (Road Risks) and protects your stock.</p>
            
            <br>
            <h4>What we cover:</h4>
            <ul style="margin-left:20px; margin-top:10px; line-height:1.8;">
                <li><strong>Material Damage:</strong> Protection for your tools, stock, and premises.</li>
                
                <li><strong>Specialist Vehicles:</strong> We provide quotes for <strong>recovery truck insurance</strong> and <strong>courier van insurance</strong>.</li>
                
                <li><strong>Passenger Transport:</strong> Looking for <strong>cheap private hire insurance</strong> or the <strong>cheapest taxi insurance</strong>? We compare the market for you.</li>
                
                <li><strong>Modern Fleets:</strong> Policies suitable for hybrids and electric car models.</li>
                
                <li><strong>Flexible Work:</strong> Coverage available for specific <strong>contract work insurance</strong> needs.</li>
            </ul>

            <br>
            <p style="font-size: 0.95rem; color: #555;">
                <strong>Get the Best Rates:</strong> We understand that every penny counts. Contact us to find the best <strong>trade insurance price</strong> or request a specific <strong>private hire insurance quote</strong> today. 
                Our partners also assist with the <strong>MID update</strong> (Motor Insurance Database) to keep your vehicles legal on the road.
            </p>

        </div>
        
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=600&q=80" alt="Car Dealer & Insurance" style="width:100%; border-radius:10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
