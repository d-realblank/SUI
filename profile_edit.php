<?php
    session_start();
    if ($_SESSION["usertype"] != "admin") {
		header("location: index.php");
	}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Login Page</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
		
	
    </head>
    <body>

        <section id="header">
            <a id="logo" href="index.php"><i class="bi bi-shop"></i>SUI</a>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Front Store</a></li>
                    <li><a href="backstore.php">Inventory</a></li>
                    <li><a class="active" href="user_list.php">User List</a></li>
                    <li id="sh-bag"><a href="cart.php"> <i class="bi bi-bag"></i></a></li>
                    <a href="#" id="close"><i class="bi bi-x"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <a href="cart.php"> <i class="bi bi-bag"></i></a>
                <i id="bar" class="bi bi-list"></i>
            </div>
        </section>

        <?php 

            include_once 'includes/dbh.inc.php';
            if (isset($_GET['edit'])) {
                $id = $_GET['edit'];
                $query = "SELECT * FROM users WHERE usersId= '{$id}'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $fname = $row['usersFName'];
                $lname = $row['usersLName'];
                $add = $row['usersAdd'];
                $app = $row['usersApp'];
                $ct = $row['usersCT'];
                $cntry = $row['usersCntry'];
                $pcode = $row['usersPcode'];
                $province = $row['usersProv'];
                $phone = $row['usersPhone'];
                $mobile = $row['usersMob'];
                $email = $row['usersEmail'];
                $type = $row['userType'];
            }
        ?>

        <section id="form-details">
            <form action="includes/process.inc.php?edit=<?php echo $id ?>" method="post">
                <h2>Enter new details here:</h2>
				<label for="text">Enter new Name</label><br>
                <input type="text" name="fname" value="<?php echo $fname; ?>" placeholder="FIRST NAME">
				<input type="text" name="lname" value="<?php echo $lname; ?>" placeholder="LAST NAME">
				<label for="text">Enter new address</label><br>
				<input type="text" name="add" value="<?php echo $add; ?>" placeholder="ADDRESS (NO,STREET)">
				<input type="text" name="app" value="<?php echo $app; ?>" placeholder="APARTEMENT">
				<input type="text" name="ct" value="<?php echo $ct; ?>" placeholder="CITY">
				<input type="text" name="cntry" value="<?php echo $cntry; ?>" placeholder="COUNTRY">
				<input type="text" name="pcode" value="<?php echo $pcode; ?>" placeholder="POSTAL CODE">
				<label for="text">Enter new province</label><br>
                <select name = "province" placeholder="PROVINCE">
                    <option value="<?php echo $province ?>" selected="selected"><?php echo $province ?></option>
                    <option value='Alberta' > Alberta </option>
                    <option value='British Columbia'> British Columbia </option>
                    <option value='Prince Edward Island'> Prince Edward Island </option>
                    <option value='Manitoba'> Manitoba </option>
                    <option value='New Brunswick'> New Brunswick </option>
                    <option value='Nova Scotia'> Nova Scotia </option>
                    <option value='Nunavut'> Nunavut </option>
                    <option value='Ontario'> Ontario </option>
                    <option value='Quebec'> Quebec </option>
                    <option value='Saskatchewan'> Saskatchewan </option>
                    <option value='Newfoundland and Labrador'> Newfoundland and Labrador </option>
                    <option value='Northwest Territories'> Northwest Territories </option>
                    <option value='Yukon'> Yukon </option>
                </select> 

				<input type="number" name="phone" value="<?php echo $phone; ?>" placeholder="PHONE NUMBER">
				<input type="number" name="mobile" value="<?php echo $mobile; ?>" placeholder="MOBILE NUMBER">
                <input type="email" name="email" value="<?php echo $email; ?>" placeholder="EMAIL">
                <select name="type" placeholder="USER TYPE">
                    <option value="<?php echo $type; ?>" selected disabled hidden><?php echo $type; ?></option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
                
                <button type="submit" name="submit" class="normal">Save</button>
            </form>
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

        <script src="script.js"></script>
    </body>
</html>