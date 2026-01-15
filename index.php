<?php include 'header.php'; ?>

<section class="hero-split">
    
    <div class="hero-text-box">
        <h1>Specialist <span>Motor Trade Insurance</span></h1>
        
        <h2>Competitive Convicted Driver Insurance for <strong>DR10, IN10 & Banned Traders</strong> <i class="fas fa-arrow-right"></i></h2>
        
        <p>
            We specialize in <strong>high-risk motor trade insurance</strong> for drivers with <strong>DR10, IN10</strong> convictions or previous bans. If you have been <strong>refused or declined elsewhere</strong>, we can help you find the right cover.
        </p>
        
        <ul>
            <li><i class="fas fa-check"></i> <strong>Hard to Place</strong> & Convicted Motor Trader Insurance</li>
            <li><i class="fas fa-check"></i> Cover available <strong>after Driving Ban</strong> or Disqualification</li>
            <li><i class="fas fa-check"></i> Specialist Rates for <strong>DR10, IN10</strong> & Points</li>
            <li><i class="fas fa-check"></i> <strong>Refused Insurance?</strong> We Quote Non-Standard Risks</li>
            <li><i class="fas fa-check"></i> <strong>Cheap Motor Trade Insurance</strong> for Convictions</li>
        </ul>
    </div>

    <div class="hero-form-box">
        <div class="form-header">
            Get Your Quote
        </div>
        <div class="form-body">
            <form action="referal.php" method="POST">
                
                <div class="form-row">
                    <div class="form-col-small">
                        <select name="title"><option>Mr</option><option>Mrs</option><option>Miss</option></select>
                    </div>
                    <div class="form-col">
                        <input type="text" name="firstname" placeholder="First Name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <input type="text" name="surname" placeholder="Surname" required>
                    </div>
                </div>

                <div class="form-row">
                    <input type="tel" name="mobile" placeholder="Mobile No" required>
                </div>

                <div class="form-row">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <input type="text" name="house_number" placeholder="House No">
                    </div>
                    <div class="form-col">
                        <input type="text" name="postcode" placeholder="Postcode" required>
                    </div>
                </div>

                <div class="form-row dob-row">
                    <select name="dob_day" class="form-col"><option value="">DD</option><?php for($i=1;$i<=31;$i++) echo "<option>$i</option>"; ?></select>
                    <select name="dob_month" class="form-col"><option value="">MM</option><?php for($i=1;$i<=12;$i++) echo "<option>$i</option>"; ?></select>
                    <select name="dob_year" class="form-col"><option value="">YYYY</option><?php for($i=2006;$i>=1950;$i--) echo "<option>$i</option>"; ?></select>
                </div>

                <div class="form-row">
                    <select name="trade_ncb" class="form-col"><option value="">Trade NCB</option><option>0 Years</option><option>1+ Years</option></select>
                </div>

                <div class="form-row">
                    <select name="occupation" class="form-col"><option value="">Occupation</option><option>Sales</option><option>Mechanic</option><option>Valeter</option></select>
                </div>

                <div class="form-row">
                    <select name="convictions"><option value="">Convictions in last 5 years?</option><option>None</option><option>Yes</option></select>
                </div>

                <button type="submit" class="hero-submit-btn">Get Quote Now</button>
            </form>
            <p style="text-align:center; font-size:0.7rem; color:#888; margin-top:10px;"><i class="fas fa-lock"></i> SSL Secured & GDPR Compliant</p>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="container-inner">
        
        <div class="text-center" style="margin-bottom: 50px;">
            <h2 class="section-title" style="color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">Our Motor Trade Insurance Services</h2>
            <p class="section-subtitle" style="color: #f0f0f0;">
                Tailored protection for <strong style="color:#fff; background: #951f20; padding: 2px 5px; border-radius: 3px;">Motor Traders</strong> with previous convictions, bans, or high-risk profiles.
            </p>
        </div>

        <div class="grid-3">
            <div class="card">
                <div class="card-icon"><i class="fas fa-car-crash"></i></div>
                <h3>Road Risks Insurance</h3>
                <p>Essential cover for driving customer vehicles. The minimum legal requirement for <strong>motor traders</strong> operating from home.</p>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-warehouse"></i></div>
                <h3>Combined Premises Insurance</h3>
                <p>Comprehensive protection for your garage, tools, stock, and cash, combined with <strong>trade vehicle insurance</strong>.</p>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-gavel"></i></div>
                <h3>Convicted Driver Insurance</h3>
                <p>We help traders with adverse history (<strong>DR10, IN10</strong>) find <strong>competitive convicted driver insurance</strong>. Even if you have been <strong>declined</strong> elsewhere.</p>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-tools"></i></div>
                <h3>Part-Time Motor Trade Insurance</h3>
                <p>Flexible policies designed for mechanics and dealers operating as a second income. Perfect for <strong>part-time traders</strong>.</p>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-wrench"></i></div>
                <h3>Mobile Mechanic Insurance</h3>
                <p>Specialist cover for mechanics on the move. Includes Public Liability and <strong>Road Risk</strong> in one package.</p>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-user-clock"></i></div>
                <h3>Young Trader Insurance (Under 25)</h3>
                <p>Struggling to get covered? We compare quotes for <strong>high-risk young motor traders</strong> under 25 to help you start your career.</p>
            </div>
        </div>
        
    </div>
</section>

<?php include 'footer.php'; ?>
