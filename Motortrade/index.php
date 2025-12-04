<?php include 'header.php'; ?>

<section class="hero-split">
    
    <div class="hero-text-box">
        <h1>Motor Trade Insurance <span>Specialists</span></h1>
        <h2>Save up to 50% on your policy <i class="fas fa-arrow-right"></i></h2>
        
        <ul>
            <li><i class="fas fa-check"></i> Cover for All Motor Trade Occupations</li>
            <li><i class="fas fa-check"></i> Compare Your Quote to find savings</li>
            <li><i class="fas fa-check"></i> Free No-Obligation Quotes</li>
            <li><i class="fas fa-check"></i> Immediate Cover available</li>
            <li><i class="fas fa-check"></i> Over 25? Get a Cheap Road Risk Quote</li>
        </ul>
    </div>

    <div class="hero-form-box">
        <div class="form-header">
            Get Your Quote
        </div>
        <div class="form-body">
            <form action="referral.php" method="POST">
                
                <div class="form-row">
                    <div class="form-col-small">
                        <select name="title"><option>Mr</option><option>Mrs</option><option>Miss</option></select>
                    </div>
                    <div class="form-col">
                        <input type="text" name="firstname" placeholder="First Name" required>
                    </div>
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

<section class="container" style="background-color: var(--bg-light);">
    <div class="text-center">
        <h2 class="section-title">Our Insurance Services</h2>
        <p class="section-subtitle">Tailored protection for every aspect of your motor trade business.</p>
    </div>

    <div class="grid-3">
        <div class="card">
            <div class="card-icon"><i class="fas fa-car-crash"></i></div>
            <h3>Road Risk Policy</h3>
            <p>Essential cover for driving customer vehicles or stock cars. The minimum legal requirement for traders.</p>
        </div>

        <div class="card">
            <div class="card-icon"><i class="fas fa-warehouse"></i></div>
            <h3>Combined Premises</h3>
            <p>Comprehensive protection for your garage, tools, stock, and cash, combined with road risk cover.</p>
        </div>

        <div class="card">
            <div class="card-icon"><i class="fas fa-gavel"></i></div>
            <h3>Convicted Drivers</h3>
            <p>We help traders with adverse history (DR10, IN10) find competitive cover where others can't.</p>
        </div>

        <div class="card">
            <div class="card-icon"><i class="fas fa-tools"></i></div>
            <h3>Part-Time Traders</h3>
            <p>Flexible policies designed for mechanics and dealers operating from home as a second income.</p>
        </div>
        
    </section>

<?php include 'footer.php'; ?>