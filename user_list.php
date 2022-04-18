<?php
    session_start();
    if ($_SESSION["usertype"] !== "admin") {
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
                    <li><a href="includes/logout.inc.php">Logout</a></li>
                    <li id="sh-bag"><a href="cart.php"> <i class="bi bi-bag"></i></a></li>
                    <a href="#" id="close"><i class="bi bi-x"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <a href="cart.html"> <i class="bi bi-bag"></i></a>
                <i id="bar" class="bi bi-list"></i>
            </div>
        </section>

        <?php require_once 'includes/process.inc.php';?>

        <?php
        
            if (isset($_SESSION['message'])): ?>

            <div class="<?=$_SESSION['msgtype']?>">

                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
            <?php endif ?>
        <div id="user_list">
            <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo '<p>Fill in all fields!<p>';
                    }
                    else if ($_GET["error"] == "none"){
                        echo '<p>Action successful<p>';
                    }
                }
                require_once 'includes/dbh.inc.php';
                $result = $conn->query("SELECT * FROM users");
            ?>
            
            <div class="row">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                        while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['usersFName']; ?></td>
                                <td><?php echo $row['usersEmail']; ?></td>
                                <td><?php echo $row['userType']; ?></td>
                                <td>
                                    <a href="profile_edit.php?edit=<?php echo $row['usersId']; ?>" class="normal">Edit</a>
                                    <a href="includes/process.inc.php?delete=<?php echo $row['usersId']; ?>" class="danger">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                </table>
            </div>

            <?php
                function pre_r($array) {
                    echo '<pre>';
                    print_r($array);
                    echo '<pre>';
                }
            
            ?>

            <div id="form-details">
                <form action="includes/process.inc.php" method="post">
                    <div>
                        <label>NAME</label>
                        <input type="text" name="name" placeholder="Enter Name">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Enter email">
                    </div>
                    <div>
                        <label>Type</label>
                        <select name="type" aria-placeholder="USER TYPE">
                            <option value="none" selected disabled hidden>Choose User Type</option>
                            <option>user</option>
                            <option>admin</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="normal" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div>


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