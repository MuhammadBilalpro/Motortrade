<?php include 'header.php'; ?>

<section class="hero-split" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://internationalfireandsafetyjournal.com/wp-content/uploads/2024/04/road-traffic-collision.jpg'); background-size: cover; background-position: center;">
    
    <div class="hero-text-box">
        <h1>Road Risk & <span>Combined</span></h1>
        <h2>Premises, Tools, and Vehicle Cover in One.</h2>
        <ul>
            <li><i class="fas fa-check"></i> Buildings & Contents Insurance</li>
            <li><i class="fas fa-check"></i> Public & Employers Liability</li>
            <li><i class="fas fa-check"></i> Stock of Vehicles on Premises</li>
            <li><i class="fas fa-check"></i> Road Risk (Driving) Included</li>
        </ul>
    </div>

    <div class="hero-form-3d">
        <div class="form-3d-header">
            Combined Quote
        </div>
        <div class="form-3d-body">
            <form action="referal.php" method="POST">
                <input type="hidden" name="service_type" value="Road Risk & Combined">
                <div class="form-row">
                    <input type="text" name="name" class="input-3d" placeholder="Business Name" required>
                </div>
                <div class="form-row">
                    <input type="tel" name="phone" class="input-3d" placeholder="Phone Number" required>
                </div>
                <div class="form-row">
                    <select name="policy_type" class="input-3d">
                        <option>What do you need?</option>
                        <option>Road Risk Only</option>
                        <option>Combined (Premises + Road)</option>
                    </select>
                </div>
                <div class="form-row">
                    <input type="text" name="stock_value" class="input-3d" placeholder="Est. Stock Value (£)">
                </div>
                <button type="submit" class="btn-3d">Calculate Savings</button>
            </form>
            <p style="text-align:center; font-size:0.75rem; color:#888; margin-top:15px;">Protecting your livelihood, tools, and premises.</p>
        </div>
    </div>
</section>

<section class="container">
    <div class="text-center">
        <h2 class="section-title">Which Policy Do You Need?</h2>
        <p class="section-subtitle">Understanding the difference between Road Risk and Combined Policies.</p>
    </div>

    <div class="about-wrapper" style="margin-top:40px; align-items:flex-start;">
        
        <div class="about-text" style="background:#fff; padding:30px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
            <h3 style="color:#951F20;">Road Risk Only</h3>
            <p><strong>Best for:</strong> Mobile mechanics, part-time traders working from home, or valeters.</p>
            <hr style="margin:15px 0; border:0; border-top:1px solid #eee;">
            <p>This covers you to drive vehicles you don't own for business purposes. It also covers your own stock vehicles while they are on the road.</p>
            <br>
            <ul style="list-style:none;">
                <li><i class="fas fa-check" style="color:green;"></i> Cheapest Option</li>
                <li><i class="fas fa-times" style="color:red;"></i> No Premises Cover</li>
                <li><i class="fas fa-times" style="color:red;"></i> Tools not covered at base</li>
            </ul>
        </div>

        <div class="about-text" style="background:#fff; padding:30px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.05); border-top:4px solid #951F20;">
            <h3 style="color:#951F20;">Combined Policy</h3>
            <p><strong>Best for:</strong> Garages, MOT stations, Car Sales Forecourts.</p>
            <hr style="margin:15px 0; border:0; border-top:1px solid #eee;">
            <p>This is the "All-in-One" package. It includes everything in Road Risk, PLUS protection for your building, tools, cash on site, and office equipment.</p>
            <br>
            <ul style="list-style:none;">
                <li><i class="fas fa-check" style="color:green;"></i> Covers Buildings & Tools</li>
                <li><i class="fas fa-check" style="color:green;"></i> Liability on Premises</li>
                <li><i class="fas fa-check" style="color:green;"></i> Theft from Garage covered</li>
            </ul>
        </div>

    </div>
</section>

<?php include 'footer.php'; ?>