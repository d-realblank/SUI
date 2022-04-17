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
            <a id="logo" href="#"><i class="bi bi-shop"></i>SUI</a>

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
            <h2>REGISTER!</h2>
            <p>Already have an account?<a href="login.html"> <b>Login </b></a> here.</p>
        </section>

        <section id="form-details">
            <form action="includes/signup.inc.php" method="post">
                <h2 style="text-decoration: underline">Enter your details here:</h2>
				<h3>Personal Information </h3>
				<label for="text">Enter your name</label><br>
                <input type="text" name="fname" placeholder="FIRST NAME" require>
				<input type="text" name="lname" placeholder="LAST NAME" require>
				<h3>Contact Information </h3>
				<label for="text">Enter your address details</label><br>
				<input type="text" name="addres" placeholder="ADDRESS (NO,STREET)">
				<input type="text" name="aprt" placeholder="APARTEMENT">
				<input type="text" name="ct" placeholder="CITY">
				<input type="text" name="cntry" placeholder="COUNTRY">
				<input type="text" name="pcode" placeholder="POSTAL CODE">
				<label for="text">Enter your province</label><br>
                <select name = "province" placeholder="PROVINCE">
                    <option value="none" selected disabled hidden>PROVINCE</option>
                    <option value='Alberta' > Alberta </option>
                    <option value='British'> British Columbia </option>
                    <option value='Prince'> Prince Edward Island </option>
                    <option value='Manitoba'> Manitoba </option>
                    <option value='Brunswick'> New Brunswick </option>
                    <option value='Nova'> Nova Scotia </option>
                    <option value='Nunavut'> Nunavut </option>
                    <option value='Ontario'> Ontario </option>
                    <option value='Quebec'> Quebec </option>
                    <option value='Saskatchewan'> Saskatchewan </option>
                    <option value='Newfoundland'> Newfoundland and Labrador </option>
                    <option value='Northwest'> Northwest Territories </option>
                    <option value='Yukon'> Yukon </option>
                </select> 

				<input type="number" name="PHONE" placeholder="PHONE NUMBER" require>
				<input type="number" name="MOBILE" placeholder="MOBILE NUMBER">
                <input type="email" name="EMAIL" placeholder="EMAIL" require>
				<input type="password" name="pass" placeholder= "PASSWORD" size = "30"  require/>
				<button type="submit" name="submit" class="normal">Create Account</button>
            </form>

            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                }
                else if ($_GET["error"] == "invalidemail") {
                    echo "<p>Enter a proper email!</p>";
                }
                else if ($_GET["error"] == "emailexists") {
                    echo "<p>That email is already taken!</p>";
                }
                else if ($_GET["error"] == "stmtfailed") {
                    echo "<p>Something went wrong, try again...</p>";
                }
                else if ($_GET["error"] == "none") {
                    echo "<p>You hav signed up.</p>";
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