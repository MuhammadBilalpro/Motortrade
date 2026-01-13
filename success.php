<?php include 'header.php'; ?>

<!-- Event snippet for Book appointment conversion page -->
<script>
gtag('event', 'conversion', {'send_to': 'AW-17810625990/9fqNCLXWytIbEMar4qxC'});
</script>

<section style="background-color: #f4f6f8; padding: 80px 20px; min-height: 60vh; display: flex; align-items: center;">
    <div class="container" style="max-width: 600px; margin: 0 auto; text-align: center;">
        <?php
        $name = isset($_GET['name']) ? htmlspecialchars(urldecode($_GET['name'])) : 'there';
        ?>
        
        <div style="background: #d4edda; color: #155724; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="font-size: 64px; margin-bottom: 20px;">✓</div>
            <h1 style="color: #155724; margin-bottom: 20px; font-size: 28px;">Success!</h1>
            <p style="color: #155724; font-size: 18px; line-height: 1.6; margin-bottom: 30px;">
                Thank you, <strong><?php echo $name; ?></strong>. Your details have been sent. Our partner broker will contact you shortly.
            </p>
            <a href="index.php" style="display: inline-block; background: #dc3545; color: white; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: bold; transition: background 0.3s;">
                Return to Home
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

