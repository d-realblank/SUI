<?php
  require_once 'dbConfig.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head> <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SUI</title>
  <link rel="stylesheet" href="aisle_style.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <style>
  .table button{
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
</head>
<script src="script.js"></script>
  <body>

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

  <section id="aisle1" class="section-p1">
      <h2>Fruits & Veggies</h2>
      <p>Only these for Now</p>
      <div class="container">
      <?php
	    $result = mysqli_query($conn,"SELECT * FROM aisles");

      $name= 'name0';
      $data= 'data0'; 

      while($row = mysqli_fetch_array($result))
        {

          if($row['type'] == 'fruits/vegetables'){
            echo '<div class="pro">';
            echo "<img src='img/".$row['image']."' alt=\"\" />";
            echo '<div class="des">';
            echo '<span>'.$row['type'].'</span>';
            echo '<h5>'.$row['name'].'</h5>';
            echo '<form name=ShoppingList>';
            echo '<div class="column">';      
            echo '<table>';
            echo '<tr>';
            echo '<input type="hidden" id="'.++$name.'" name="'.$name.'" value='.$row['name'].'>';
            echo '<td><b>Quantity:</b><input type=number id="'.++$data.'" name="'.$data.'"></td>';
            echo '</tr>';
            echo "<tr><td>\n";
            echo "<button type=submit name=\"Save\" value=\"Save\" onclick=\"SaveItem(document.getElementById('".$name."').value,document.getElementById('".$data."').value,".$row['price'].",'".$row['image']."')\">Save</button>\n"; 
            echo "</td></tr>";
            echo '</table>';
                
            echo '<div id="table">';
            echo '<button>';
            echo 'items description';
            echo '<ul><li>'.$row['description'].'</li>';
            echo '<li>Item weight: '.$row['weight'].' lbs</li>';
            echo '<li>Price: $'.$row['price'].'</li></ul>';
            echo '</button>';
            echo '</div></div></div></div>';
          }
      }
        $conn->close();
      ?>
       
      </div>
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