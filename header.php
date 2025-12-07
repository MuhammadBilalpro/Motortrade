<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Trade Insurance Referral Specialists</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="top-bar">
    <span><i class="fas fa-envelope"></i> email@motortrade-referrals.co.uk</span>
    <span><i class="fas fa-phone-alt"></i> Call Us: 0800 123 4567</span>
</div>

<header>
    <nav>
       <a href="index.php" class="logo">
    <img src="assets/logo.png" alt="MotorTrade Specialists Logo">
</a>
        
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            
            <li class="dropdown">
                <a href="services.php">Services <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 5px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="service-motor-trade.php">Motor Trade Insurance</a></li>
                    <li><a href="service-high-risk.php">High-Risk Drivers (Convicted)</a></li>
                    <li><a href="service-road-risk.php">Road Risk & Combined</a></li>
                </ul>
            </li>

            <li><a href="contact.php">Contact</a></li>
            <li><a href="referral.php" class="cta-btn">Get a Quote</a></li>
        </ul>

        <div class="burger" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
</header>

<script>
    function toggleMenu() {
        const nav = document.getElementById("navLinks");
        nav.classList.toggle("active");
    }
</script>