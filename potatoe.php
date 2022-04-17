<!DOCTYPE HTML>
<head>
    <script src="Storage.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="StorageStyle.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="aisle_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>SUI</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        html, body {
            background-color: aliceblue;
  height: 100%;
  width: 100%;
  margin: 0;
  font-family: 'Roboto', sans-serif;
}
.column {
  width: 100%;
  margin-top: 60px;
  justify-content: center;
}

img {
  z-index: 1;
  width: 100%;
  max-width: 500px;
  height: auto;
}
button{
	z-index: 2;
        float: left;
        float: top;
        position:relative;
        width: 198px;
    }
    button ul{
        display: none;
        position:absolute;
        background-color: rgb(172, 172, 172);
        padding: 0;
        float: left;
        border-radius: 0px 0px 4px 4px ;
    }
    button:hover ul{
        display:block;
    }
    button ul li{
        padding: 5px;
        text-align: left;
        width: 180px;
    }
    </style>
<body onload="doShowAll()">
    <section id="header">
        <a id="logo" href="index.php"><i class="bi bi-shop"></i>SUI</a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
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
       
    <form name=ShoppingList>

		<div class="column">
                
			<table>
				<tr>

					<td><b>Item:</b><input type=text name=name value="Potatoes"></td>
					<td><b>Quantity:</b><input type=text name=data></td>

				</tr>

				<tr>
					<td>
					    <input type=button value="Save"   onclick="SaveItem()"> 
					    <input type=button value="Update" onclick="ModifyItem()"> 
					    <input type=button value="Delete" onclick="RemoveItem()">
					</td>
				</tr>
			</table>
		

		<div id="items_table">
			<h3>cart details</h3>
			<table id=list></table>
			<p>
				<label><input type=button value="Clear" onclick="ClearAll()">
					<i>* Delete all items</i></label>
			</p>
		</div>
    </div>
	</form>
    <button>
        item description
        <ul>
            <li>
                5 lbs bag of russet Potatoes
            </li>
            <li>
                $3.49
            </li>
        </ul>
    </button>
    
	<img src="img/potate.png" alt="">

    <footer class="section-p1" style="background-color: whitesmoke;">
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