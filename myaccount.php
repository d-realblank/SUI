<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Login Page</title>
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
		
	
    </head>
    <body>

    <section id="header">
            <a id="logo" href="index.php"><i class="bi bi-shop"></i>SUI</a>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <?php
                        if (isset($_SESSION["useremail"])) {
                            echo "<li><a href='profile.php'>Sign up</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
                        }
                        else {
                            echo "<li><a href='signup.php'>Sign up</a></li>";
                            echo "<li><a href='myaccount.php'>Log in</a></li>";
                        }
                        if ($_SESSION["usertype"] === "admin") {
                            echo "<li><a href='backstore.php'>Backstore</a></li>";
                        }
                    ?>
                    <li id="sh-bag"><a href="cart.php"> <i class="bi bi-bag"></i></a></li>
                    <a href="#" id="close"><i class="bi bi-x"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <a href="cart.php"> <i class="bi bi-bag"></i></a>
                <i id="bar" class="bi bi-list"></i>
            </div>
    </section>

        <section id="page-header">
            <h2>SIGN IN!</h2>
            <p>Hi, Sign in to take advantage of all your personalized benefits!</p>
        </section>

        <section id="form-details">
            <form action="includes/login.inc.php" method="post">
                <h2 style="text-decoration: underline">Enter your details here:</h2>
				
				<label for="text">Enter your email id and password to Login</label><br>
				
                <input type="email" id="email" name = "email" placeholder="EMAIL">
				<input type="password" name="pwd" placeholder= "PASSWORD" size = "30" required/>
                <h4>Create an account?<a href="signup.php"> <b>Sign up </b></a> here.</h4>
                <button type = "submit" name="submit" class="normal">Log in</button>
				
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                }
                else if ($_GET["error"] == "wronglogin") {
                    echo "<p>Incorrect login information!</p>";
                }
            }
            ?>

        </section>
		
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

    </body>
</html>