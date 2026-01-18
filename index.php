<?php include 'header.php'; ?>

<section class="hero-split">
    
    <div class="hero-text-box">
       <h1>Motor Trade Insurance SRA Specialist </h1>
           <p class="hero-intro">
Motor Trade Insurance SRA is a UK specialist helping motor traders, including
DR10, IN10 and banned drivers, get insured even when declined elsewhere.
</p>

        
        <ul>
            <li><i class="fas fa-check"></i> Motor Trade Insurance with Convictions</li>
            <li><i class="fas fa-check"></i> DR10 & Drink Driving Insurance</li>
            <li><i class="fas fa-check"></i> Banned Driver & High Risk Cover</li>
            <li><i class="fas fa-check"></i> Motor Trade Insurance After Ban</li>
            <li><i class="fas fa-check"></i> Cheap Motor Trade Insurance Quotes</li>
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

<section class="services-section" style="background: linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.85)), url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=1600&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
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

            <div class="card">
                <div class="card-icon"><i class="fas fa-ban"></i></div>
                <h3>Banned Drivers</h3>
                <p>Recently unbanned? We help you get back on the road with fair insurance premiums.</p>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-user-friends"></i></div>
                <h3>Young Traders</h3>
                <p>Insurance solutions for motor traders under 25 who struggle to find cover elsewhere.</p>
            </div>
        </div>
    </div>
</section>

<section class="faq-section" style="background: linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.85)), url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=1600&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">Find answers to common questions about Motor Trade Insurance.</p>
        </div>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can I get Motor Trade Insurance with a DR10 conviction?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes, we specialize in helping motor traders with DR10 (drink driving) convictions get insured. While many insurers decline applications with convictions, we work with specialist brokers who understand your situation and can find competitive cover.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>What is the difference between Road Risk and Combined Insurance?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Road Risk Only covers you for driving customer vehicles and stock cars on public roads - it's the minimum legal requirement. Combined Insurance includes Road Risk plus protection for your premises, tools, stock, and cash. Combined is recommended if you operate from a garage or forecourt.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How long after a driving ban can I get Motor Trade Insurance?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>You can typically get Motor Trade Insurance immediately after your ban ends, provided your license is valid. We work with brokers who specialize in recently unbanned drivers and can help you find cover even if you've been declined elsewhere.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Do I need Trade NCB (No Claims Bonus) for Motor Trade Insurance?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Trade NCB is not always required, but having 1+ years of Trade NCB can significantly reduce your premium. If you're new to motor trading, you can still get insured - we'll help you find the best rates available for your situation.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can part-time traders get Motor Trade Insurance?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Absolutely. Many of our customers are part-time traders, mechanics, or dealers operating from home as a second income. We offer flexible policies designed specifically for part-time motor traders.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>What if I've been declined by other insurers?</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>Being declined elsewhere doesn't mean you can't get insured. We specialize in high-risk cases and work with a network of specialist brokers who understand complex situations including convictions, bans, and adverse history.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="reviews-section">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Real feedback from motor traders we've helped get insured.</p>
        </div>

        <div class="reviews-carousel-wrapper">
            <button class="carousel-btn carousel-prev" aria-label="Previous review">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="reviews-carousel">
                <div class="reviews-track">
                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"After being declined by three other insurers due to my DR10 conviction, I was losing hope. These guys found me a competitive quote within 24 hours. Professional service and they really understand the challenges traders face."</p>
                        <div class="review-author">
                            <strong>James M.</strong>
                            <span>Motor Trader, Birmingham</span>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"Excellent service from start to finish. As a part-time trader working from home, I needed flexible cover. They understood my needs and found the perfect policy at a great price. Highly recommend!"</p>
                        <div class="review-author">
                            <strong>Sarah K.</strong>
                            <span>Part-Time Dealer, Manchester</span>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"I was recently unbanned and struggling to find insurance. The team here made the process simple and stress-free. Got my quote quickly and the premium was much better than I expected. Thank you!"</p>
                        <div class="review-author">
                            <strong>David R.</strong>
                            <span>Mechanic, London</span>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"Fast, efficient, and knowledgeable. They helped me understand the difference between road risk and combined policies, and found me the right cover for my garage. Great customer service throughout."</p>
                        <div class="review-author">
                            <strong>Michael T.</strong>
                            <span>Garage Owner, Leeds</span>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"As a young trader under 25, I was getting quoted ridiculous prices everywhere. These specialists found me a fair deal and explained everything clearly. Couldn't be happier with the service."</p>
                        <div class="review-author">
                            <strong>Tom L.</strong>
                            <span>Young Trader, Bristol</span>
                        </div>
                    </div>

                    <div class="review-card">
                        <div class="review-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"Professional, friendly, and they really know their stuff. I had multiple convictions and thought I'd never get insured. They worked with specialist brokers and got me covered. Outstanding service!"</p>
                        <div class="review-author">
                            <strong>Robert H.</strong>
                            <span>Car Dealer, Sheffield</span>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-btn carousel-next" aria-label="Next review">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
