<?php include 'header.php'; ?>

<section class="hero-split" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://www.iexpats.com/wp-content/uploads/2023/03/motor-trade-iexpats.jpg'); background-size: cover; background-position: center;">
    
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
            <form action="referral.php" method="POST">
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
                <li><strong>Material Damage:</strong> Protection for your tools and stock.</li>
                <li><strong>Road Risks:</strong> Driving customer cars for testing.</li>
                <li><strong>Demonstration:</strong> Allowing customers to test drive.</li>
            </ul>
        </div>
        <div class="about-image">
            
            <img src="https://img.freepik.com/free-photo/young-couple-talking-sales-person-car-showroom_1303-15135.jpg?semt=ais_hybrid&w=740&q=80" alt="Car Dealer" style="width:100%; border-radius:10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>