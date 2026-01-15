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

    $seoData = array(
        'index' => array('title' => 'Convicted Motor Trade Insurance | DR10, IN10 & Banned Driver Quotes', 'description' => 'Specialist Motor Trade Insurance for convicted drivers (DR10, IN10). Refused or banned? We provide competitive quotes for high-risk traders.', 'keywords' => 'motor trade insurance convicted, dr10 insurance, banned driver insurance'),
        // Add other pages here as needed
    );
    $page = isset($seoData[$currentPage]) ? $seoData[$currentPage] : $seoData['index'];
    ?>
    
    <title><?php echo htmlspecialchars($page['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <link rel="canonical" href="<?php echo $currentUrl; ?>">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="top-bar">
    <div class="top-item">
        <a href="mailto:info@motortradeinsurancesra.co.uk"><i class="fas fa-envelope"></i> info@motortradeinsurancesra.co.uk</a>
    </div>
    <div class="top-item">
        <a href="tel:01183701701"><i class="fas fa-phone-alt"></i> Call Us: 0118 370 1701</a>
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
    // FIX: Menu Toggle Script
    function toggleMenu() {
        const nav = document.getElementById("navLinks");
        nav.classList.toggle("active"); // Slide in/out
        
        const icon = document.querySelector(".burger i");
        if(nav.classList.contains("active")) {
            icon.classList.remove("fa-bars");
            icon.classList.add("fa-times");
        } else {
            icon.classList.remove("fa-times");
            icon.classList.add("fa-bars");
        }
    }
    
    // FIX: Mobile Dropdown Toggle
    function toggleMobileDropdown(element) {
        if (window.innerWidth <= 960) {
            element.classList.toggle('active'); // Shows sub-menu
        }
    }
</script>
