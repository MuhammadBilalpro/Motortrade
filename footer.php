<footer>
    <div class="footer-container">
        
        <div class="footer-col">
            <h4>Contact Us</h4>
            <ul>
                <li>
                    <i class="fas fa-map-marker-alt"></i> 
                    <a href="https://www.google.com/maps/search/?api=1&query=85-87+Station+Rd,+Countesthorpe,+Leicester+LE8+5TD" target="_blank">
                        85-87 Station Rd, Countesthorpe, Leicester LE8 5TD
                    </a>
                </li>
                <li>
                    <i class="fas fa-envelope"></i> 
                    <a href="mailto:info@motortradeinsurancesra.co.uk">
                        info@motortradeinsurancesra.co.uk
                    </a>
                </li>
                <li>
                    <i class="fas fa-phone"></i> 
                    <a href="tel:01183701701">
                        0118 370 1701
                    </a>
                </li>
                <li style="color: #bbb; margin-top: 10px;">
                    <i class="fas fa-clock"></i> Mon - Fri: 9:00 AM - 6:00 PM
                </li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="referal.php">Get a Quote</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Important Notice</h4>
            <p style="color: #bbb; font-size: 0.9rem; line-height: 1.6;">
                <strong>Introducer Only:</strong> We do not offer insurance advice. We act solely as an introducer to authorized insurance brokers who will provide your quote.
            </p>
        </div>

    </div>
    
    <div class="copyright">
        &copy; <?php echo date("Y"); ?> Motor Trade Referral Specialists. All Rights Reserved.
    </div>
</footer>

<script>
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    
    if(burger){
        burger.addEventListener('click', () => {
            nav.classList.toggle('active');
            
            // Icon animation
            const icon = burger.querySelector('i');
            if (nav.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
</script>

</body>
</html>
