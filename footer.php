<footer class="section-p1">
            <div class="col">
                <i class="bi bi-shop"></i>
                <h4>Contact</h4>
                <p><strong>Address: </strong> 420 Hardwood Street, Los Santos, San Andreas</p>
                <p><strong>Phone: </strong> +1 (420) 690-2020</p>
                <div class="follow">
                    <h4>Follow us</h4>
                    <div class="icon">
                        <i class="bi bi-facebook"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-pinterest"></i>
                        <i class="bi bi-youtube"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4>My Account</h4>
                <?php
                
                    if (!isset($_SESSION["useremail"])) {
                        echo "<a href='myaccount.php'>Sign in</a>";
                    }
    
                ?>
                <a href="cart.php">View Cart</a>
                <a href="#">My Wishlist</a>
                <a href="#">Track My Order</a>
            </div>

            <div class="col pay">
                <p>Secured Payment Gateways</p>
                <div class="row">
                    <i class="bi bi-credit-card"></i>
                    <i class="bi bi-paypal"></i>
                </div>
            </div>
</footer>