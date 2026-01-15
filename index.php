<?php include 'header.php'; ?>

<style>
    /* --- HERO SECTION STYLES (Fixed Gap & Mobile) --- */
    .hero-split {
        display: flex;
        align-items: center; /* Center vertically */
        justify-content: space-between;
        padding: 60px 5%;
        background: #fdfdfd;
        min-height: 85vh;
        gap: 40px; /* Space between text and form */
    }

    /* Left Side Text */
    .hero-text-box {
        flex: 1;
        max-width: 600px;
    }
    .hero-text-box h1 {
        font-size: 2.8rem;
        color: #333;
        line-height: 1.2;
        margin-bottom: 15px;
    }
    .hero-text-box h1 span { color: #951f20; }
    
    .hero-text-box h2 {
        font-size: 1.2rem;
        color: #555;
        font-weight: 600;
        margin-bottom: 20px;
        border-left: 4px solid #951f20;
        padding-left: 15px;
    }

    /* Paragraph Gap Fix */
    .hero-text-box p {
        font-size: 1rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 25px; /* Controlled spacing before bullets */
    }

    /* Bullet Points Styling */
    .hero-text-box ul {
        list-style: none;
        padding: 0;
    }
    .hero-text-box ul li {
        margin-bottom: 12px;
        font-size: 1.05rem;
        display: flex;
        align-items: flex-start;
    }
    .hero-text-box ul li i {
        color: #951f20;
        margin-right: 12px;
        margin-top: 5px; /* Align icon with text */
    }

    /* Right Side Form */
    .hero-form-box {
        flex: 0 0 400px; /* Fixed width on desktop */
        background: white;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
        border-top: 5px solid #951f20;
    }
    .form-header {
        background: #f8f9fa;
        padding: 15px;
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
        color: #333;
        border-bottom: 1px solid #eee;
    }
    .form-body { padding: 25px; }
    
    .form-row { margin-bottom: 15px; display: flex; gap: 10px; }
    .form-col { flex: 1; }
    .form-col-small { flex: 0 0 70px; } /* For Title Mr/Mrs */
    
    input, select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 0.9rem;
        background: #fff;
    }
    input:focus, select:focus { border-color: #951f20; outline: none; }
    
    .hero-submit-btn {
        width: 100%;
        padding: 12px;
        background: #951f20;
        color: white;
        border: none;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        border-radius: 4px;
        transition: 0.3s;
    }
    .hero-submit-btn:hover { background: #7a1819; }

    /* --- MOBILE RESPONSIVENESS MEDIA QUERIES --- */
    @media screen and (max-width: 960px) {
        .hero-split {
            flex-direction: column; /* Stack vertically */
            padding: 40px 5%;
            gap: 40px;
            text-align: center; /* Center text on mobile */
        }
        
        .hero-text-box { width: 100%; }
        .hero-text-box h1 { font-size: 2rem; }
        .hero-text-box h2 { border-left: none; padding-left: 0; border-bottom: 3px solid #951f20; padding-bottom: 10px; display: inline-block;}
        .hero-text-box ul li { justify-content: flex-start; text-align: left; } /* Keep bullets left aligned */
        
        .hero-form-box {
            width: 100%; /* Full width form on mobile */
            flex: none;
        }
        
        /* Grid for Services Section */
        .grid-3 {
            grid-template-columns: 1fr !important; /* Force 1 column on mobile */
        }
    }
</style>

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
        <div class="form-header">Get Your Quote</div>
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

<section style="
    width: 100%;
    background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url('https://www.tradex.com/images/default-source/default-album/man-with-brown-hair-stands-in-a-garage-wth-a-clipboard.png?sfvrsn=f2d95112_1');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding: 80px 0;
">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        
        <div class="text-center" style="margin-bottom: 50px; text-align: center;">
            <h2 class="section-title" style="color: #fff; text-shadow: 0 2px 4px rgba(0,0,0,0.5); font-size: 2.5rem; margin-bottom: 15px;">Our Motor Trade Insurance Services</h2>
            <p class="section-subtitle" style="color: #ddd; font-size: 1.1rem; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                Tailored protection for <strong style="color:#fff; background-color:#951f20; padding: 2px 6px; border-radius: 3px;">Motor Traders</strong> with previous convictions, bans, or high-risk profiles.
            </p>
        </div>

        <style>
            .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
            .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: transform 0.3s; border-bottom: 4px solid #951f20; }
            .card:hover { transform: translateY(-5px); }
            .card-icon { font-size: 2.5rem; color: #951f20; margin-bottom: 20px; }
            .card h3 { color: #333; margin-bottom: 15px; font-size: 1.25rem; }
            .card p { color: #666; line-height: 1.6; font-size: 0.95rem; }
        </style>

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
