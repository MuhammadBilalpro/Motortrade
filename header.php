<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17810625990"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-17810625990');
    </script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="apple-touch-icon" href="assets/logo.png">
    
    <?php
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    $baseUrl = 'https://motortradeinsurancesra.co.uk/';
    $currentUrl = ($currentPage == 'index') ? $baseUrl : $baseUrl . $currentPage . '.php';

    // SEO Data for ALL Pages
    $seoData = array(
        'index' => array(
            'title' => 'Motor Trade Insurance UK | DR10, IN10 Convicted Driver & Banned Driver Quotes',
            'description' => 'Specialist Motor Trade Insurance for convicted drivers with DR10, IN10, DR80, TT99. Motor trade insurance drink driving, after ban, declined elsewhere. Cheap motor trade insurance quotes UK.',
            'keywords' => 'motor trade insurance drink driving, motor trade insurance with conviction, dr10 motor trade insurance, motor trade insurance banned driver, motor trade insurance high risk, motor trade insurance after ban, motor trade insurance declined elsewhere, cheap motor trade insurance convictions, convicted motor trader insurance'
        ),
        'about' => array(
            'title' => 'About Us | Motor Trade Insurance Specialists UK',
            'description' => 'Learn about Motor Trade Insurance Specialists - connecting motor traders with trusted insurance brokers since 2010. We help convicted drivers, high-risk traders find affordable cover.',
            'keywords' => 'motor trade insurance company, insurance broker uk, convicted driver specialists'
        ),
        'contact' => array(
            'title' => 'Contact Us | Motor Trade Insurance Quotes | Call 0118 370 1701',
            'description' => 'Contact Motor Trade Insurance Specialists for a free quote. Call 0118 370 1701 or fill our online form. Based in Leicester, UK. Fast response for motor traders.',
            'keywords' => 'motor trade insurance contact, insurance quote uk, leicester insurance broker'
        ),
        'service-motor-trade' => array(
            'title' => 'Motor Trade Insurance | Car Dealers & Mechanics Cover UK',
            'description' => 'Comprehensive Motor Trade Insurance for car dealers, mechanics, valeters and traders. Protect your business with road risk, stock cover and liability insurance. Get instant quotes!',
            'keywords' => 'motor trade insurance, car dealer insurance, mechanic insurance, valeter insurance, trader insurance uk'
        ),
        'service-high-risk' => array(
            'title' => 'Convicted Driver Insurance | DR10, IN10, DR80 Motor Trade Insurance UK',
            'description' => 'Motor trade insurance drink driving, DR10 motor trade insurance, motor trade insurance after drink drive ban. Specialist convicted motor trader insurance for high risk drivers.',
            'keywords' => 'motor trade insurance dr10, motor trade policy with drink driving conviction, motor trade insurance after drink drive ban, motor trade insurance convicted drink driver, dr80 motor trade insurance, motor trade insurance drug driving, motor trade insurance declined drug driving, high risk motor trade insurance'
        ),
        'service-road-risk' => array(
            'title' => 'Road Risk & Combined Insurance | Premises & Vehicle Cover UK',
            'description' => 'Road Risk Only or Combined Motor Trade Insurance. Protect your garage, tools, stock and vehicles. Perfect for mechanics, MOT stations and car sales forecourts.',
            'keywords' => 'road risk insurance, combined motor trade insurance, garage insurance, premises cover, mot station insurance'
        ),
        'referal' => array(
            'title' => 'Get a Free Motor Trade Insurance Quote | Fast & Easy',
            'description' => 'Request a free Motor Trade Insurance quote in minutes. Fill our simple form and our partner brokers will contact you with competitive rates. No obligation quotes.',
            'keywords' => 'motor trade insurance quote, free insurance quote, motor trader quote uk'
        ),
        'privacy' => array(
            'title' => 'Privacy Policy | Motor Trade Insurance Specialists',
            'description' => 'Read our Privacy Policy and GDPR compliance statement. Learn how we protect your data and handle your information securely.',
            'keywords' => 'privacy policy, gdpr compliance, data protection'
        ),
        'success' => array(
            'title' => 'Quote Request Received | Motor Trade Insurance Specialists',
            'description' => 'Thank you for your quote request. Our partner broker will contact you shortly with competitive motor trade insurance rates.',
            'keywords' => 'insurance quote submitted, motor trade quote'
        )
    );
    
    $page = isset($seoData[$currentPage]) ? $seoData[$currentPage] : $seoData['index'];
    ?>
    
    <!-- Primary Meta Tags -->
    <title><?php echo htmlspecialchars($page['title']); ?></title>
    <meta name="title" content="<?php echo htmlspecialchars($page['title']); ?>">
    <meta name="description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page['keywords']); ?>">
    <meta name="author" content="Motor Trade Insurance Specialists">
    <meta name="robots" content="index, follow">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo $currentUrl; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $currentUrl; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($page['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta property="og:image" content="<?php echo $baseUrl; ?>assets/logo.png">
    <meta property="og:site_name" content="Motor Trade Insurance Specialists">
    <meta property="og:locale" content="en_GB">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo $currentUrl; ?>">
    <meta property="twitter:title" content="<?php echo htmlspecialchars($page['title']); ?>">
    <meta property="twitter:description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta property="twitter:image" content="<?php echo $baseUrl; ?>assets/logo.png">
    
    <!-- Geo Tags -->
    <meta name="geo.region" content="GB-LEC">
    <meta name="geo.placename" content="Leicester">
    
    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "InsuranceAgency",
        "name": "Motor Trade Insurance Specialists",
        "url": "<?php echo $baseUrl; ?>",
        "logo": "<?php echo $baseUrl; ?>assets/logo.png",
        "description": "Specialist Motor Trade Insurance for convicted drivers, high-risk traders, and motor trade businesses across the UK.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "85-87 Station Rd, Countesthorpe",
            "addressLocality": "Leicester",
            "postalCode": "LE8 5TD",
            "addressCountry": "GB"
        },
        "telephone": "+441183701701",
        "email": "info@motortradeinsurancesra.co.uk",
        "openingHours": "Mo-Fr 09:00-18:00",
        "priceRange": "££",
        "areaServed": {
            "@type": "Country",
            "name": "United Kingdom"
        },
        "sameAs": []
    }
    </script>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
</head>
<body>

<!-- Overlay for mobile menu -->
<div class="nav-overlay" id="navOverlay" onclick="closeMenu()"></div>

<div class="top-bar">
    <div class="top-item">
        <a href="mailto:info@motortradeinsurancesra.co.uk"><i class="fas fa-envelope"></i> info@motortradeinsurancesra.co.uk</a>
    </div>
    <div class="top-item">
        <a href="tel:01183701701"><i class="fas fa-phone-alt"></i> Call Us: 0118 370 1701</a>
    </div>
    <div class="top-item">
        <a href="https://www.google.com/maps/search/?api=1&query=85-87+Station+Rd,+Countesthorpe,+Leicester+LE8+5TD" target="_blank" rel="noopener"><i class="fas fa-map-marker-alt"></i> 85-87 Station Rd, Leicester LE8 5TD</a>
    </div>
</div>

<header>
    <nav>
        <a href="index.php" class="logo">
            <img src="assets/logo.png" alt="Motor Trade Insurance Specialists Logo" width="150" height="50">
        </a>
        
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            
            <li class="dropdown" id="servicesDropdown">
                <a href="#" onclick="toggleMobileDropdown(event)">Services <i class="fas fa-chevron-down" style="font-size: 0.75rem; margin-left: 5px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="service-motor-trade.php">Motor Trade Insurance</a></li>
                    <li><a href="service-high-risk.php">High-Risk Drivers</a></li>
                    <li><a href="service-road-risk.php">Road Risk & Combined</a></li>
                </ul>
            </li>

            <li><a href="contact.php">Contact</a></li>
            <li><a href="referal.php" class="cta-btn"><i class="fas fa-file-alt"></i> Get a Quote</a></li>
        </ul>

        <div class="burger" onclick="toggleMenu()" aria-label="Toggle Menu">
            <i class="fas fa-bars" id="burgerIcon"></i>
        </div>
    </nav>
</header>

<script>
    // Mobile Menu Toggle
    function toggleMenu() {
        const nav = document.getElementById("navLinks");
        const overlay = document.getElementById("navOverlay");
        const icon = document.getElementById("burgerIcon");
        
        nav.classList.toggle("active");
        overlay.classList.toggle("active");
        
        if(nav.classList.contains("active")) {
            icon.classList.remove("fa-bars");
            icon.classList.add("fa-times");
            document.body.style.overflow = "hidden";
        } else {
            icon.classList.remove("fa-times");
            icon.classList.add("fa-bars");
            document.body.style.overflow = "";
        }
    }
    
    // Close Menu
    function closeMenu() {
        const nav = document.getElementById("navLinks");
        const overlay = document.getElementById("navOverlay");
        const icon = document.getElementById("burgerIcon");
        
        nav.classList.remove("active");
        overlay.classList.remove("active");
        icon.classList.remove("fa-times");
        icon.classList.add("fa-bars");
        document.body.style.overflow = "";
    }
    
    // Mobile Dropdown Toggle
    function toggleMobileDropdown(event) {
        if (window.innerWidth <= 768) {
            event.preventDefault();
            const dropdown = document.getElementById("servicesDropdown");
            dropdown.classList.toggle('active');
        }
    }
    
    // Close menu when clicking nav links on mobile
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', function(e) {
            if(window.innerWidth <= 768 && !this.parentElement.classList.contains('dropdown')) {
                closeMenu();
            }
        });
    });
    
    // Close menu on window resize
    window.addEventListener('resize', function() {
        if(window.innerWidth > 768) {
            closeMenu();
            document.getElementById("servicesDropdown").classList.remove('active');
        }
    });
</script>
