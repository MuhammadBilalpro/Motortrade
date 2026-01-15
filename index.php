<?php include 'header.php'; ?>

<section class="hero-split" style="background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=1600&q=80'); background-size: cover; background-position: center;">
    <div class="hero-text-box">
        <h1>High Risk & Convicted <span>Motor Trade Insurance</span></h1>
        <p>Specialist insurance for motor traders with convictions (DR10, IN10), bans, or refused insurance. We get you covered when others won't.</p>
        
        <ul>
            <li><i class="fas fa-check-circle"></i> Specialist DR10 & IN10 Insurance</li>
            <li><i class="fas fa-check-circle"></i> Cover After Driving Bans</li>
            <li><i class="fas fa-check-circle"></i> Road Risk & Premises Cover</li>
            <li><i class="fas fa-check-circle"></i> Instant Online Quotes</li>
        </ul>
    </div>

    <div class="hero-form-box">
        <div class="form-header">Get A Quote Today</div>
        <div class="form-body">
            <form action="referal.php" method="POST">
                <div class="form-row">
                    <select name="title" style="flex: 0 0 80px;"><option>Mr</option><option>Mrs</option><option>Ms</option><option>Miss</option></select>
                    <input type="text" name="firstname" placeholder="First Name" required>
                </div>
                <div class="form-row">
                    <input type="text" name="surname" placeholder="Last Name" required>
                </div>
                <div class="form-row">
                    <input type="tel" name="mobile" placeholder="Mobile Number" required>
                </div>
                <div class="form-row">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-row">
                    <select name="trade_ncb">
                        <option value="">Trade NCB</option>
                        <option>0 Years</option>
                        <option>1 Year</option>
                        <option>2 Years</option>
                        <option>3+ Years</option>
                    </select>
                </div>
                <button type="submit" class="hero-submit-btn">GET MY QUOTE</button>
            </form>
            <p style="font-size: 0.8rem; text-align: center; color: #777; margin-top: 10px;">Your data is secure and confidential.</p>
        </div>
    </div>
</section>

<section class="services-section" style="background: linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.85)), url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=1600&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <h2 class="section-title" style="color: #333; margin-bottom: 10px;">Our Insurance Services</h2>
        <p style="color: #666; margin-bottom: 40px;">Tailored policies for high-risk and convicted motor traders.</p>

        <div class="grid-3">
            <div class="card">
                <i class="fas fa-car-crash"></i>
                <h3>Road Risk Insurance</h3>
                <p>Essential cover for driving customer vehicles. Minimum requirement for traders operating from home.</p>
            </div>
            
            <div class="card">
                <i class="fas fa-gavel"></i>
                <h3>Convicted Driver Cover</h3>
                <p>We specialize in helping traders with DR10, IN10, and other convictions get affordable cover.</p>
            </div>

            <div class="card">
                <i class="fas fa-store"></i>
                <h3>Combined Premises</h3>
                <p>Protect your garage, tools, stock, and vehicles under one comprehensive policy.</p>
            </div>

            <div class="card">
                <i class="fas fa-tools"></i>
                <h3>Part-Time Traders</h3>
                <p>Flexible policies for those who trade vehicles or repair cars as a second income.</p>
            </div>
            
            <div class="card">
                <i class="fas fa-ban"></i>
                <h3>Banned Drivers</h3>
                <p>Recently unbanned? We help you get back on the road with fair insurance premiums.</p>
            </div>

            <div class="card">
                <i class="fas fa-user-friends"></i>
                <h3>Young Traders</h3>
                <p>Insurance solutions for motor traders under 25 who struggle to find cover elsewhere.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
