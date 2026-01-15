<!DOCTYPE html>
<html lang="en">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17810625990"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'AW-17810625990');
    </script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="shortcut icon" href="assets/logo.png" type="image/png">

    <?php
    // Get current filename without extension
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    $baseUrl = 'https://motortradeinsurancesra.co.uk/';
    
    // Construct Current URL (Safe Method)
    if ($currentPage == 'index') {
        $currentUrl = $baseUrl;
    } else {
        $currentUrl = $baseUrl . $currentPage . '.php';
    }
    
    // SEO Data - Updated for Google Content & Keywords
    $seoData = array(
        'index' => array(
            'title' => 'Convicted Motor Trade Insurance | DR10, IN10 & Banned Driver Quotes', 
            'description' => 'Specialist Motor Trade Insurance for convicted drivers (DR10, IN10, DR80). Refused, banned or declined elsewhere? Get competitive high-risk trader quotes.', 
            'keywords' => 'motor trade insurance convicted, dr10 insurance, banned driver insurance, in10, refused motor trade insurance'
        ),
        'about' => array(
            'title' => 'About Us | High Risk Motor Trade Insurance Specialists', 
            'description' => 'We connect motor traders with trusted insurance brokers, specializing in hard-to-place and convicted driver policies.', 
            'keywords' => 'motor trade insurance introducer, high risk insurance'
        ),
        'service-motor-trade' => array(
            'title' => 'Motor Trade Insurance | Comprehensive Cover', 
            'description' => 'Motor trade insurance for car dealers, mechanics & traders. Save on road risk and combined policies.', 
            'keywords' => 'car dealer insurance, mechanic insurance'
        ),
        'service-high-risk' => array(
            'title' => 'Convicted Driver Insurance | DR10, IN10 & Bans', 
            'description' => 'Motor trade insurance for convicted drivers. We help with DR10, drug driving bans, and refused insurance.', 
            'keywords' => 'convicted driver insurance, DR10 insurance, drug driving insurance'
        ),
        'service-road-risk' => array(
            'title' => 'Road Risk & Combined Motor Trade Insurance', 
            'description' => 'Road risk only or combined motor trade insurance quotes.', 
            'keywords' => 'road risk insurance'
        ),
        'contact' => array(
            'title' => 'Contact Us | Motor Trade Insurance Referral Specialists', 
            'description' => 'Contact our motor trade insurance referral service for a free quote.', 
            'keywords' => 'contact motor trade insurance'
        ),
        'referral' => array(
            'title' => 'Get a Motor Trade Insurance Quote', 
            'description' => 'Get your free motor trade insurance quote today.', 
            'keywords' => 'motor trade insurance quote'
        ),
        'referal' => array(
            'title' => 'Get a Motor Trade Insurance Quote', 
            'description' => 'Get your free motor trade insurance quote today.', 
            'keywords' => 'motor trade insurance quote'
        ),
        'privacy' => array(
            'title' => 'Privacy Policy', 
            'description' => 'Privacy policy and GDPR compliance.', 
            'keywords' => 'privacy policy'
        )
    );

    // Safe Logic to select page data
    if (isset($seoData[$currentPage])) {
        $page = $seoData[$currentPage];
    } else {
        $page = $seoData['index'];
    }
    ?>
    
    <title><?php echo htmlspecialchars($page['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page['keywords']); ?>">
    <meta name="author" content="Motor Trade Referral Specialists">
    <link rel="canonical" href="<?php echo $currentUrl; ?>">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $currentUrl; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($page['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta property="og:image" content="<?php echo $baseUrl; ?>assets/logo.png">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo $currentUrl; ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta name="twitter:image" content="<?php echo $baseUrl; ?>assets/logo.png">
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "InsuranceAgency",
      "name": "Motor Trade Insurance Specialists",
      "description": "Specialist insurance for motor traders with convictions (DR10, IN10), bans, or high-risk profiles.",
      "url": "<?php echo $currentUrl; ?>",
      "logo": "<?php echo $baseUrl; ?>assets/logo.png",
      "image": "<?php echo $baseUrl; ?>assets/logo.png", 
      "serviceType": "Motor Trade Insurance Referral",
      "address": { "@type": "PostalAddress", "streetAddress": "85-87 Station Rd", "addressLocality": "Countesthorpe, Leicester", "postalCode": "LE8 5TD", "addressCountry": "UK" },
      "contactPoint": { "@type": "ContactPoint", "telephone": "0118 370 1701", "contactType": "Customer Service", "email": "info@motortradeinsurancesra.co.uk" },
      "priceRange": "$$"
    }
    </script>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* General Resets */
        body { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Arial', sans-serif; }
        
        /* Top Bar Styles */
      /* --- Professional Top Bar Styling --- */
.top-bar {
    background-color: #951f20; /* Aapka Red Color */
    color: white;
    padding: 0px 10%; /* Thora vertical padding diya taake text chipke nahi */
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.9rem;
    flex-wrap: wrap;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Subtle divider line */
}

/* Har item ke liye styling */
.top-item {
    display: flex;
    align-items: center;
    padding: 5px 0;
}

/* Links ki styling */
.top-bar a {
    color: white;
    text-decoration: none;
    font-weight: 500; /* Thora bold taake red par saaf dikhe */
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease; /* Smooth effect */
}

/* Icons ki spacing */
.top-bar i {
    margin-right: 8px;
    color: rgba(255, 255, 255, 0.8); /* Icon thora sa light taake text highlight ho */
}

/* Hover Effect (Jab mouse upar layenge) */
.top-bar a:hover {
    color: #ffcc00; /* Yellow tint on hover */
    text-decoration: none;
    transform: translateY(-1px); /* Slight lift effect */
}
.top-bar a:hover i {
    color: #fff;
}

/* Mobile Responsiveness ke liye */
@media screen and (max-width: 960px) {
    .top-bar {
        padding: 10px 5%;
        justify-content: center;
        gap: 10px;
        text-align: center;
    }
    .top-item {
        width: 100%; /* Mobile pe har item alag line mein */
        justify-content: center;
    }
    .address-hide {
        display: none; /* Mobile pe address chupa dein taake crowd na ho (Optional) */
    }
}
        /* Header & Nav Styles */
        header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 8vh;
            padding: 0 5%;
        }
        .logo img {
            height: 50px;
            width: auto;
        }
        
        /* Navigation Links (Desktop) */
        .nav-links {
            display: flex;
            justify-content: space-around;
            width: 60%;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .nav-links li a {
            color: #333;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.3s ease;
        }
        .nav-links li a:hover { color: #004aad; }
        
        /* CTA Button */
        .cta-btn {
            background-color: #951f20;
            color: white !important;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .cta-btn:hover { background-color: #e65c00; }

        /* Dropdown Menu (Desktop) */
        .dropdown { position: relative; }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            list-style: none;
            padding: 10px 0;
            width: 250px;
            display: none;
            z-index: 999;
        }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-menu li { padding: 0; }
        .dropdown-menu li a {
            display: block;
            padding: 10px 20px;
            font-weight: 400;
        }
        .dropdown-menu li a:hover { background-color: #f1f1f1; }

        /* Burger Menu (Hidden on Desktop) */
        .burger {
            display: none;
            cursor: pointer;
        }
        .burger i { font-size: 1.5rem; color: #333; }

        /* MOBILE RESPONSIVENESS */
        @media screen and (max-width: 960px) {
            .top-bar {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
            .top-bar span { margin: 0; display: block; }
            
            .nav-links {
                position: absolute;
                right: 0px;
                height: 92vh;
                top: 8vh;
                background-color: white;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                width: 100%;
                transform: translateX(100%);
                transition: transform 0.4s ease-in;
                padding-top: 30px;
                border-top: 1px solid #eee;
            }
            
            /* Main Menu Items Spacing */
            .nav-links > li { 
                margin: 20px 0; /* Gap between main items */
                width: 100%;
                text-align: center;
            }
            
            .nav-links.active {
                transform: translateX(0%);
            }
            
            .burger { display: block; }
            .logo img { height: 40px; }

            /* --- FIXED DROPDOWN STYLING FOR MOBILE --- */
            .dropdown-menu {
                position: relative; /* Not absolute on mobile */
                box-shadow: none;
                background: #f4f4f4; /* Slightly grey background */
                width: 100%; /* Full width */
                padding: 0;
                margin-top: 15px; /* Space between "Services" and list */
            }
            
            /* Remove the big margin from dropdown list items */
            .dropdown-menu li {
                margin: 0 !important; /* Force remove margin */
                border-bottom: 1px solid #e0e0e0;
                width: 100%;
            }
            
            /* Style the links inside dropdown */
            .dropdown-menu li a {
                padding: 15px 0; /* Good touch target */
                display: block;
                font-size: 0.95rem;
                color: #555;
            }
            
            /* Remove border from last item */
            .dropdown-menu li:last-child {
                border-bottom: none;
            }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="top-item">
        <a href="mailto:info@motortradeinsurancesra.co.uk">
            <i class="fas fa-envelope"></i> info@motortradeinsurancesra.co.uk
        </a>
    </div>

    <div class="top-item">
        <a href="tel:01183701701">
            <i class="fas fa-phone-alt"></i> Call Us: 0118 370 1701
        </a>
    </div>

    <div class="top-item address-hide">
        <a href="https://www.google.com/maps/search/?api=1&query=85-87+Station+Rd,+Countesthorpe,+Leicester+LE8+5TD" target="_blank">
            <i class="fas fa-map-marker-alt"></i> 85-87 Station Rd, Countesthorpe, Leicester LE8 5TD
        </a>
    </div>
</div>

<header>
    <nav>
        <a href="index.php" class="logo">
            <img src="assets/logo.png" alt="MotorTrade Specialists">
        </a>
        
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            
            <li class="dropdown" onclick="toggleDropdown(this)">
                <a href="#" onclick="return false;">Services <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 5px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="service-motor-trade.php">Motor Trade Insurance</a></li>
                    <li><a href="service-high-risk.php">High-Risk Drivers</a></li>
                    <li><a href="service-road-risk.php">Road Risk & Combined</a></li>
                </ul>
            </li>

            <li><a href="contact.php">Contact</a></li>
            <li><a href="referal.php" class="cta-btn">Get a Quote</a></li>
        </ul>

        <div class="burger" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header>

<script>
    function toggleMenu() {
        const nav = document.getElementById("navLinks");
        const burger = document.querySelector(".burger i");
        
        nav.classList.toggle("active");
        
        if (nav.classList.contains("active")) {
            burger.classList.remove("fa-bars");
            burger.classList.add("fa-times");
        } else {
            burger.classList.remove("fa-times");
            burger.classList.add("fa-bars");
        }
    }
    
    // Toggle Dropdown on Mobile
    function toggleDropdown(element) {
        if (window.innerWidth <= 960) {
            const menu = element.querySelector('.dropdown-menu');
            // Toggle block/none
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }
    }
</script>
