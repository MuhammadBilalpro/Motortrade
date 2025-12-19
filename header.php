<?php
// Set up error handler to log PHP errors to JavaScript console
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    // Only log if errors are not suppressed
    if (!(error_reporting() & $errno)) {
        return false;
    }
    
    $errorType = 'Unknown';
    switch($errno) {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
            $errorType = 'Error';
            break;
        case E_WARNING:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_USER_WARNING:
            $errorType = 'Warning';
            break;
        case E_NOTICE:
        case E_USER_NOTICE:
            $errorType = 'Notice';
            break;
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
            $errorType = 'Deprecated';
            break;
    }
    
    // Output JavaScript to log error to console
    $errorMsg = htmlspecialchars($errstr, ENT_QUOTES, 'UTF-8');
    $errorFile = htmlspecialchars(basename($errfile), ENT_QUOTES, 'UTF-8');
    echo "<script>console.error('[PHP {$errorType}] {$errorMsg} in {$errorFile} on line {$errline}');</script>\n";
    
    // Don't execute PHP internal error handler
    return true;
}, E_ALL & ~E_DEPRECATED & ~E_STRICT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="assets/logo.png">
    <?php
    // Get current page name for dynamic meta tags
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    $baseUrl = 'https://motortradeinsurancesra.co.uk/';
    $currentUrl = $baseUrl . ($currentPage == 'index' ? '' : $currentPage . '.php');
    
    // Page-specific SEO data
    $seoData = [
        'index' => [
            'title' => 'Motor Trade Insurance Quotes | Save Up to 50% | Free Quotes UK',
            'description' => 'Get competitive motor trade insurance quotes. Save up to 50% on road risk, combined policies & convicted driver insurance. Free quotes from specialist brokers.',
            'keywords' => 'motor trade insurance, motor trade insurance quotes, road risk insurance, motor trade insurance UK'
        ],
        'about' => [
            'title' => 'About Us | Motor Trade Insurance Referral Specialists',
            'description' => 'We connect motor traders with trusted insurance brokers. GDPR compliant introducer service. No fees, no advice - just expert referrals to specialist insurers.',
            'keywords' => 'motor trade insurance introducer, insurance referral service, motor trade brokers'
        ],
        'service-motor-trade' => [
            'title' => 'Motor Trade Insurance | Comprehensive Cover for Dealers & Mechanics',
            'description' => 'Motor trade insurance for car dealers, mechanics & traders. Cover for buying, selling & repairing vehicles. Get competitive quotes from specialist brokers.',
            'keywords' => 'motor trade insurance, car dealer insurance, mechanic insurance, motor trader insurance'
        ],
        'service-high-risk' => [
            'title' => 'Convicted Driver Insurance | DR10, IN10 Motor Trade Cover',
            'description' => 'Motor trade insurance for convicted drivers. Specialist cover for DR10, IN10, TT99 convictions. Get quotes from high-risk insurance brokers.',
            'keywords' => 'convicted driver insurance, DR10 insurance, IN10 insurance, high risk motor trade insurance'
        ],
        'service-road-risk' => [
            'title' => 'Road Risk & Combined Motor Trade Insurance | Compare Quotes',
            'description' => 'Road risk only or combined motor trade insurance. Cover for premises, tools, stock & vehicles. Compare quotes from UK specialist brokers.',
            'keywords' => 'road risk insurance, combined motor trade insurance, motor trade premises insurance'
        ],
        'contact' => [
            'title' => 'Contact Us | Motor Trade Insurance Referral Specialists',
            'description' => 'Contact our motor trade insurance referral service. Get in touch for quotes, enquiries or support. We connect you with specialist UK brokers.',
            'keywords' => 'motor trade insurance contact, insurance referral contact'
        ],
        'referral' => [
            'title' => 'Get a Motor Trade Insurance Quote | Free No-Obligation Quotes',
            'description' => 'Get your free motor trade insurance quote. Fill in our quick form and we\'ll connect you with specialist brokers. No obligation, competitive rates.',
            'keywords' => 'motor trade insurance quote, free insurance quote, motor trade insurance application'
        ],
        'referal' => [
            'title' => 'Get a Motor Trade Insurance Quote | Free No-Obligation Quotes',
            'description' => 'Get your free motor trade insurance quote. Fill in our quick form and we\'ll connect you with specialist brokers. No obligation, competitive rates.',
            'keywords' => 'motor trade insurance quote, free insurance quote, motor trade insurance application'
        ],
        'privacy' => [
            'title' => 'Privacy Policy | Motor Trade Insurance Referral Specialists',
            'description' => 'Privacy policy and GDPR compliance information for Motor Trade Insurance Referral Specialists. Learn how we protect your data.',
            'keywords' => 'privacy policy, GDPR compliance, data protection'
        ]
    ];
    
    $page = $seoData[$currentPage] ?? $seoData['index'];
    ?>
    
    <!-- Primary Meta Tags -->
    <title><?php echo htmlspecialchars($page['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page['keywords']); ?>">
    <meta name="author" content="Motor Trade Referral Specialists">
    <link rel="canonical" href="<?php echo $currentUrl; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $currentUrl; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($page['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta property="og:image" content="<?php echo $baseUrl; ?>assets/logo.png">
    <meta property="og:site_name" content="Motor Trade Insurance Referral Specialists">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo $currentUrl; ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page['description']); ?>">
    <meta name="twitter:image" content="<?php echo $baseUrl; ?>assets/logo.png">
    
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FinancialService",
      "name": "Motor Trade Insurance Referral Specialists",
      "description": "<?php echo htmlspecialchars($page['description']); ?>",
      "url": "<?php echo $currentUrl; ?>",
      "logo": "<?php echo $baseUrl; ?>assets/logo.png",
      "serviceType": "Motor Trade Insurance Referral",
      "areaServed": {
        "@type": "Country",
        "name": "United Kingdom"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+44-800-123-4567",
        "contactType": "Customer Service",
        "email": "james@motortradeinsurancesra.co.uk"
      }
    }
    </script>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="top-bar">
    <span><i class="fas fa-envelope"></i> james@motortradeinsurancesra.co.uk</span>
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
                <a href="#" onclick="return false;">Services <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 5px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="service-motor-trade.php">Motor Trade Insurance</a></li>
                    <li><a href="service-high-risk.php">High-Risk Drivers (Convicted)</a></li>
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
        nav.classList.toggle("active");
    }
    
    // Global error handler - log all errors to console, never display on page
    window.addEventListener('error', function(e) {
        console.error('JavaScript Error:', e.error);
        e.preventDefault(); // Prevent default error display
        return true;
    });
    
    // Catch unhandled promise rejections
    window.addEventListener('unhandledrejection', function(e) {
        console.error('Unhandled Promise Rejection:', e.reason);
        e.preventDefault();
    });
    
    // Function to log PHP errors to console
    function logErrorToConsole(message, type) {
        if (type === 'error') {
            console.error('[PHP Error]', message);
        } else if (type === 'warning') {
            console.warn('[PHP Warning]', message);
        } else {
            console.log('[PHP Info]', message);
        }
    }
</script>
