<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUI</title>
    <link rel="stylesheet" href="style_cart.css">
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
                    <li id="sh-bag"><a class="active" href="cart.php"> <i class="bi bi-bag"></i></a></li>
                    <a href="#" id="close"><i class="bi bi-x"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <a class="active" href="cart.php"> <i class="bi bi-bag"></i></a>
                <i id="bar" class="bi bi-list"></i>
            </div>
</section>
    
    <div class="listing">
        <h1>Shopping Cart</h1>
        
     <table id= "product-list">
        <thead>
			<tr>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Option</th>
			</tr>
		</thead>
         <tbody>
        
    </tbody>
    </table> 
    </div>
   
    <div class="total">
        <h1><u>Order Summary</u></h1>
        <table id = "bill">
            <tr>
                <td>Number of Items:</td>
                <td id = "totalItems"></td>
            </tr>
            <tr>
                <td>Subtotal:</td>
                <td id = "subtotal"></td>
            </tr>
            <tr>
                <td>Estimated QST:</td>
                <td id = "qst">5.00$</td>
            </tr>
            <tr>
                <td>Estimated GST:</td>
                <td id = "gst"></td>
            </tr>
            <tr>
                <td>Order Total:</td>
                <td id = "total"></td>
            </tr>
        </table>    
    </div>

    <script src="script.js"></script>
    <script>
        var subtotal = 0; 
        var index = 0;
        var table_cart = document.getElementById("product-list");
        var tbodyRef = table_cart.getElementsByTagName('tbody')[0];
        function cart(){
            for (i = 0; i <= localStorage.length-1; i++) {

                var key = localStorage.key(i);

                data = JSON.parse(localStorage.getItem(key));
                var quantity = data[0];
                var price = data[1];
                var img = data[2];

                var newRow = tbodyRef.insertRow(table_cart.length),

                cellName = newRow.insertCell(0),
                cellQuantity = newRow.insertCell(1),
                cellPrice = newRow.insertCell(2),
                cellOption = newRow.insertCell(3);

                cellName.innerHTML = '<td data-label="Name"> <img src="img/'+ img +'" alt=""/>'+ key + '</td>';
                cellQuantity.innerHTML = '<td data-label="Quantity"> <button id = "substract" onclick="substract(this)">-</button> ' + quantity + ' <button id = "add" onclick="add(this)">+</button> </td>';
                cellPrice.innerHTML = '<td data-label="Price">' + price + '</td>	';
                cellOption.innerHTML = '<td data-label="Option"> <button id = "delete" onclick="deleteRow(this)">Delete</button></td>';
         }
        }

        function updateBill(){

            subtotal = 0; 
            totalItems = 0;

            for(var i = 1; i < table_cart.rows.length; i++){
                var quantity = parseInt(table_cart.rows[i].cells[1].innerHTML.match(/(\d+)/));
                totalItems = totalItems + quantity;

                var currentPrice = table_cart.rows[i].cells[2].innerHTML.replace('$','');
                subtotal = subtotal + parseFloat(currentPrice * quantity);
            }
            var gst = 0.05 * subtotal;
            var qst = 0.09975 * subtotal;
            var total = subtotal + qst + gst;

            document.getElementById("totalItems").innerHTML = totalItems;
            document.getElementById("subtotal").innerHTML = subtotal.toFixed(2) + "$";
            document.getElementById("gst").innerHTML = (0.05 * subtotal).toFixed(2) + "$";
            document.getElementById("qst").innerHTML = (0.09975 * subtotal).toFixed(2) + "$";
            document.getElementById("total").innerHTML = total.toFixed(2) + "$";
            }

        function substract(element){

            var row = element.parentNode.parentNode.rowIndex;
            var column = element.parentNode.cellIndex;

            var quantity = parseInt(table_cart.rows[row].cells[column].innerHTML.match(/(\d+)/));
            var nameCellInfo = table_cart.rows[row].cells[0].innerHTML
            var name = nameCellInfo.substring(nameCellInfo.indexOf('">') + 2);

            if ((quantity - 1) == 0){
            if(confirm('Are you sure to delete this item?')){
                table_cart.deleteRow(row);
                updateBill();
            }
            else
                return;
            }
            var data = [quantity-1,JSON.parse(localStorage.getItem(name))[1],JSON.parse(localStorage.getItem(name))[2]];
            localStorage.setItem(name,JSON.stringify(data));

            var cell = table_cart.rows[row].cells[column].innerHTML;
            table_cart.rows[row].cells[column].innerHTML = cell.replace(quantity,quantity - 1);

            updateBill();
            }

            function add(element){
                var row = element.parentNode.parentNode.rowIndex;
                var column = element.parentNode.cellIndex;

                var quantity = parseInt(table_cart.rows[row].cells[column].innerHTML.match(/(\d+)/));
                var nameCellInfo = table_cart.rows[row].cells[0].innerHTML
                var name = nameCellInfo.substring(nameCellInfo.indexOf('">') + 2);

                var data = [quantity+1,JSON.parse(localStorage.getItem(name))[1],JSON.parse(localStorage.getItem(name))[2]];
                localStorage.setItem(name,JSON.stringify(data));

                var cell = table_cart.rows[row].cells[column].innerHTML;
                table_cart.rows[row].cells[column].innerHTML = cell.replace(quantity,quantity+1);
            
                updateBill();
            }
            function deleteRow(element){
                var row = element.parentNode.parentNode.rowIndex;
                var nameCellInfo = table_cart.rows[row].cells[0].innerHTML
                var name = nameCellInfo.substring(nameCellInfo.indexOf('">') + 2);

                if(confirm('Are you sure to delete this item?')){
                    localStorage.removeItem(name);
                    table_cart.deleteRow(row);
                    updateBill();
                }
            }

        cart();
        updateBill(); 
     
    </script>
    </body>
</html>