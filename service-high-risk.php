<?php include 'header.php'; ?>

<section class="hero-split" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://jensteninsurance.co.uk/wp-content/uploads/2023/12/Motor-Trade-Combined-Insurance.jpg'); background-size: cover; background-position: center;">
    
    <div class="hero-text-box">
        <h1>Convicted Driver <span>Insurance</span></h1>
        <h2>DR10, IN10, TT99? We Can Help.</h2>
        <ul>
            <li><i class="fas fa-check"></i> Specialist "High Risk" Brokers</li>
            <li><i class="fas fa-check"></i> Drink Driving & Bans Covered</li>
            <li><i class="fas fa-check"></i> Fair Prices for Past Mistakes</li>
            <li><i class="fas fa-check"></i> Instant Cover Available</li>
        </ul>
    </div>

    <div class="hero-form-3d">
        <div class="form-3d-header" style="background: linear-gradient(135deg, #333 0%, #000 100%);"> Confidential Quote
        </div>
        <div class="form-3d-body">
            <form action="referal.php" method="POST">
                <input type="hidden" name="service_type" value="High-Risk Driver (Convicted)">
                <div class="form-row">
                    <input type="text" name="name" class="input-3d" placeholder="Full Name" required>
                </div>
                <div class="form-row">
                    <input type="tel" name="phone" class="input-3d" placeholder="Phone Number" required>
                </div>
                <div class="form-row">
                    <select name="conviction_code" class="input-3d">
                        <option>Conviction Type?</option>
                        <option>DR10 (Drink/Drug)</option>
                        <option>IN10 (No Insurance)</option>
                        <option>TT99 (Points Ban)</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-row">
                    <input type="text" name="details" class="input-3d" placeholder="Date of Conviction (Approx)">
                </div>
                <button type="submit" class="btn-3d">Get Help Now</button>
            </form>
            <p style="text-align:center; font-size:0.75rem; color:#888; margin-top:15px;">Your data is treated with 100% confidentiality.</p>
        </div>
    </div>
</section>

<section class="container">
    <div class="text-center">
        <h2 class="section-title">Convicted Driver Insurance for Motor Traders</h2>
        
        <p class="section-subtitle">We believe everyone with <strong>driving convictions</strong> deserves a second chance to earn a living.</p>
    </div>

    <div class="grid-3" style="margin-top:40px;">
        <div class="card">
            <h3><i class="fas fa-beer" style="color:#951F20;"></i> Drink Driving Insurance (DR10/DG10)</h3>
            <p>If you have a DR10 or DG10 code, mainstream insurers might reject you. Our partners specialize in <strong>drink driving insurance</strong> to get you back on the road legally.</p>
        </div>
        <div class="card">
            <h3><i class="fas fa-ban" style="color:#951F20;"></i> Disqualified Drivers Cover</h3>
            <p>Returning from a ban? We help you find <strong>motor trade insurance</strong> that acknowledges your ban is over and helps you rebuild your No Claims Bonus.</p>
        </div>
        <div class="card">
            <h3><i class="fas fa-file-invoice-dollar" style="color:#951F20;"></i> No Insurance Conviction (IN10)</h3>
            <p>An <strong>IN10 conviction</strong> can be costly, but as a motor trader, you need cover. We compare specialist underwriters to lower your premiums.</p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
