<?php
  require_once 'dbConfig.php';
	
	if ($_SESSION["usertype"] !== "admin") {
		header("location: index.php");
	}

  if(isset($_POST['delete'])){
    $id = $_POST["id"];
    
    $result = mysqli_query($conn,"SELECT * FROM aisle");
			 $sql_upatde = "delete from `aisle` where id='$id'";
    $result = mysqli_query($conn, $sql_upatde);
  }

?>
<head>
	<meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Backstore </title>
<link rel="stylesheet" href="style_backstore.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">


</head>

<body>
<section id="header">
            <a id="logo" href="#"><i class="bi bi-shop"></i>SUI</a>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Front Store</a></li>
                    <li><a class="active" href="backstore.php">Inventory</a></li>
                    <li><a href="user_list.php">User List</a></li>
                    <li><a href="includes/logout.inc.php">Logout</a></li>
                    <li id="sh-bag"><a href="cart.php"> <i class="bi bi-bag"></i></a></li>
                    <a href="#" id="close"><i class="bi bi-x"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <a href="cart.php"> <i class="bi bi-bag"></i></a>
                <i id="bar" class="bi bi-list"></i>
            </div>
</section>
	
<div class="backstore-content">
	<h1>Product List:</h1>
	<a href="addProduct.php" id = "add"> <i class="fas fa-plus-circle"></i> Add product</a>
	
 	<table class = "product-list">
			<thead>
			<tr>
				<th>Name</th>
				<th>Type of Aisle</th>
				<th>Price</th>
				<th>Item Weight</th>
				<th>Options</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$result = mysqli_query($conn,"SELECT * FROM aisle");

		while($row = mysqli_fetch_array($result))
				{
				echo '<tr>';
				echo "<td data-label= \"name\"> <img src='img/".$row['image']."' alt=\"\" />".$row['name']."</td>";
				echo "<td data-label =\"type\">".$row['type']."</td>";
				echo "<td data-label =\"price\">".$row['price']."</td>";
				echo "<td data-label = \"Item Weight\">".$row['weight']."</td>";
				echo "<td data-label = \"description\" id = \"descrption\">".$row['description']."</td>";
				echo "<td data-label = \"Options\">
				<form action='addProduct.php' method = \"post\">
				<input name='id' type=hidden value='".$row['id']."'><button type=\"submit\" id = \"edit\" name = \"edit\" >edit</button></form>
				<form action='' method = \"post\" onsubmit=\"return confirm('Are you sure you want to delete this item?');\">
				<input name='id' type=hidden value='".$row['id']."'><button type=\"submit\" id = \"delete\" name = \"delete\">delete</button></td></form>";
				echo '<tr>';
				}
				
$conn->close();
?>

	</tbody>
</table> 

</div>
<script src="script.js"></script>
</body>
</html>
