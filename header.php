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
    
    <?php
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    $baseUrl = 'https://motortradeinsurancesra.co.uk/';
    $currentUrl = ($currentPage == 'index') ? $baseUrl : $baseUrl . $currentPage . '.php';

    // SEO Data (Kept same as your previous request)
    $seoData = array(
        'index' => array('title' => 'Convicted Motor Trade Insurance | DR10, IN10 & Banned Driver Quotes', 'description' => 'Specialist Motor Trade Insurance for convicted drivers (DR10, IN10, DR80). Refused, banned or declined elsewhere? Get competitive high-risk trader quotes.', 'keywords' => 'motor trade insurance convicted, dr10 insurance, banned driver insurance'),
        // ... (Baki pages ka data same rahega) ...
    );
    $page = isset($seoData[$currentPage]) ? $seoData[$currentPage] : $seoData['index'];
    ?>
    
    <title><?php echo htmlspecialchars($page['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <link rel="canonical" href="<?php echo $currentUrl; ?>">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* --- GLOBAL RESETS --- */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Arial', sans-serif; overflow-x: hidden; }

        /* --- TOP BAR STYLING (Mobile Optimized) --- */
        .top-bar {
            background-color: #951f20;
            color: white;
            padding: 8px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            flex-wrap: wrap;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .top-item a {
            color: white; text-decoration: none; font-weight: 500;
            display: flex; align-items: center; transition: 0.3s;
        }
        .top-item i { margin-right: 8px; color: rgba(255,255,255,0.9); }
        .top-item a:hover { color: #ffeb3b; }

        /* --- HEADER & NAV STYLING --- */
        header { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        nav { display: flex; justify-content: space-between; align-items: center; min-height: 70px; padding: 0 5%; }
        .logo img { height: 50px; width: auto; }
        
        /* Desktop Menu */
        .nav-links { display: flex; list-style: none; gap: 25px; align-items: center; }
        .nav-links li a { color: #333; text-decoration: none; font-weight: 600; font-size: 1rem; transition: 0.3s; }
        .nav-links li a:hover { color: #951f20; }
        
        /* CTA Button */
        .cta-btn { background-color: #951f20; color: white !important; padding: 10px 20px; border-radius: 4px; }
        .cta-btn:hover { background-color: #7a1819; }

        /* Dropdown Desktop */
        .dropdown { position: relative; }
        .dropdown-menu {
            position: absolute; top: 100%; left: 0; background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); list-style: none;
            width: 240px; display: none; padding: 10px 0; border-top: 3px solid #951f20;
        }
        .dropdown:hover .dropdown-menu { display: block; }
        .dropdown-menu li a { display: block; padding: 10px 20px; font-weight: 400; font-size: 0.95rem; }
        .dropdown-menu li a:hover { background: #f8f9fa; }

        /* Burger Icon */
        .burger { display: none; cursor: pointer; font-size: 1.5rem; color: #333; }

        /* --- MOBILE RESPONSIVENESS (The Fix) --- */
        @media screen and (max-width: 960px) {
            /* Top Bar Mobile */
            .top-bar { justify-content: center; gap: 10px; padding: 10px; text-align: center; }
            .top-item { margin: 2px 5px; font-size: 0.85rem; }
            .address-hide { display: none; } /* Hide address on mobile to save space */

            /* Mobile Nav */
            .nav-links {
                position: absolute; right: 0; top: 70px;
                background: white; height: calc(100vh - 70px);
                width: 70%; max-width: 300px;
                flex-direction: column; align-items: flex-start;
                padding: 30px; gap: 20px;
                transform: translateX(100%); transition: transform 0.3s ease-in-out;
                box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            }
            .nav-links.active { transform: translateX(0%); }
            
            /* Burger Visible */
            .burger { display: block; }

            /* Mobile Dropdown Fix */
            .dropdown { width: 100%; }
            .dropdown-menu {
                position: static; display: none; width: 100%;
                box-shadow: none; border: none; background: #f9f9f9; padding-left: 15px;
            }
            .dropdown.active .dropdown-menu { display: block; } /* Show on click */
            .nav-links li { width: 100%; border-bottom: 1px solid #eee; padding-bottom: 10px; }
            .nav-links li:last-child { border: none; }
            .cta-btn { display: block; text-align: center; margin-top: 10px; width: 100%; }
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="top-item">
        <a href="mailto:info@motortradeinsurancesra.co.uk"><i class="fas fa-envelope"></i> info@motortradeinsurancesra.co.uk</a>
    </div>
    <div class="top-item">
        <a href="tel:01183701701"><i class="fas fa-phone-alt"></i> 0118 370 1701</a>
    </div>
    <div class="top-item address-hide">
        <a href="https://www.google.com/maps/search/?api=1&query=85-87+Station+Rd,+Countesthorpe,+Leicester+LE8+5TD" target="_blank"><i class="fas fa-map-marker-alt"></i> Leicester, UK</a>
    </div>
</div>

<header>
    <nav>
        <a href="index.php" class="logo"><img src="assets/logo.png" alt="MotorTrade Logo"></a>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li class="dropdown" onclick="toggleMobileDropdown(this)">
                <a href="#" onclick="return false;">Services <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="service-motor-trade.php">Motor Trade Insurance</a></li>
                    <li><a href="service-high-risk.php">High-Risk Drivers</a></li>
                    <li><a href="service-road-risk.php">Road Risk & Combined</a></li>
                </ul>
            </li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="referal.php" class="cta-btn">Get a Quote</a></li>
        </ul>
        <div class="burger" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
    </nav>
</header>

<script>
    function toggleMenu() {
        const nav = document.getElementById("navLinks");
        nav.classList.toggle("active");
        const icon = document.querySelector(".burger i");
        icon.classList.toggle("fa-bars");
        icon.classList.toggle("fa-times");
    }
    function toggleMobileDropdown(element) {
        if (window.innerWidth <= 960) {
            element.classList.toggle('active');
        }
    }
</script>
