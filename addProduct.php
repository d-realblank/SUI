<?php
  require_once 'dbConfig.php'; 
  
  if(isset($_POST['edit'])){
    $getID = $_POST["id"];
    
    $result = mysqli_query($conn,"SELECT * FROM aisle");

    while($row = mysqli_fetch_array($result)){
      if($row['id'] == $getID){
        $nameUpdate = $row['name'];
        $typeUpdate = $row['type'];
        $priceUpdate = $row['price'];
        $weightUpdate = $row['weight'];
        $descriptionUpdate = $row['description'];
        $imageUpdate = 'img/'.$row['image'];
        $idUpdate = $row['id'];
        break;
        } 
      }
  }
  else{
    $nameUpdate = '';
    $typeUpdate = '';
    $priceUpdate = '';
    $weightUpdate = '';
    $descriptionUpdate = '';
    $idUpdate = '';
    $imageUpdate = '';
  }

 //Send info in databse
 if(isset($_POST['add'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $description= $_POST['description'];

    $filename = basename($_FILES["image"]["name"]);
    $tempname = $_FILES["image"]["tmp_name"];    
    $folder = "img/".$filename;

    $sql_insert = "INSERT INTO aisle (name,type,weight,price,description,image)
          VALUES (?,?,?,?,?,?)";

    $stmt = mysqli_stmt_init($conn);
    if(! mysqli_stmt_prepare($stmt,$sql_insert)){
      die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssddss",
    $name,
    $type,
    $weight,
    $price,
    $description,
    $filename);

    move_uploaded_file($tempname, $folder);

    mysqli_stmt_execute($stmt);
    header("refresh:0.1; url=backstore.php");
  }

  if(isset($_POST['update'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $description= $_POST['description'];
    $id= $_POST['id'];

    $sql_upatde = "UPDATE `aisle` SET name= '$name', type= '$type', price= $price, weight= $weight, description = '$description' WHERE id= $id;";
    $result = mysqli_query($conn, $sql_upatde);

    header("refresh:0.1; url=backstore.php");
  }

  $conn->close();
?>

<link rel="stylesheet" href="style_addProduct.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

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
  

<div class="add-page">
  <h1 id= "goback"> <a href="backstore.php" id="back-arrow"><i class="fas fa-arrow-left"></i></a>
    Add Product:</h1>
  <div class = "form">
  <form action= "" method= "post" enctype="multipart/form-data">
    <label for="name"> <u>Name</u>  <br/></label> 
    <input type= "text" name="name" id="name" placeholder="Enter name of the product..." value="<?php echo $nameUpdate ?>" required>

    <label for="type"> <u>Type of Aisles</u> <br/></label> 
      <select name = "type" value="<?php echo $typeUpdate ?>" >
      <option>fruits/vegetables</option>
      <option>meats</option>
      <option>snacks</option>
      </select>

    <label for="price"> <u></br> Price</u> <br/></label> 
    <input type = "number" min= "0" step="0.01" name="price" id="price" placeholder="Enter price of the product ..." value="<?php echo $priceUpdate ?>"  required> 
    
  </br>
    <label for="weight"> <u>Item Weight</u> <br/></label> 
    <input type= "number" min= "0" step="0.01" name="weight" id="weight" placeholder="Enter weight of the product in kg ..." value="<?php echo $weightUpdate ?>"  required>

  </br>
    <label for="description"> <u>Description</u> <br/></label> 
    <textarea name="description" id="description" cols="30" rows="10"placeholder="Enter brief description of the product..." required><?php echo htmlspecialchars($descriptionUpdate); ?></textarea>

    <label for="image"> <u>Image</u> <br/></label> 
    <input type="file" name="image" accept="image/png, image/GIF, image/jpeg" value="<?php echo $imageUpdate ?>" required>

    <input name='id' type=hidden value= <?php echo $idUpdate ?>>
    <input type="submit" value= <?php if(isset($_POST['edit'])) echo "update"; else echo "add";?> id = "submit" name = <?php if(isset($_POST['edit'])) echo "update"; else echo "add";?> >
  </form>
  </div>
 </div>
 <script src="script.js"></script>
 <script src="script_addProcduct.js"></script>
</body>