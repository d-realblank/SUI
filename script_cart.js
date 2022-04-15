var subtotal = 0; 
var totalItems = 0;
var index = 0;
var table_cart = document.getElementById("product-list");
var tbodyRef = table_cart.getElementsByTagName('tbody')[0];

cart();

updateBill();

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

function cart(){

  for (i = 0; i <= localStorage.length-1; i++) {

    var imgLocation, price;
		key = localStorage.key(i);

		if (key=="Potatoes"){
			price = 3.49;
      imgLocation = '<img src="img/potate.png" alt="Picture of potatoes">'
		}
		if (key=="Carrots"){
			price = 4.99;
      imgLocation = '<img src="https://i.ndtvimg.com/mt/cooks/2014-11/carrots.jpg" alt="Picture of carrots"/>';
		}
		if (key=="Apples"){
			price = 7.99;	
      imgLocation = '<img src="img/apple.jpg" alt= "Picture of apples"></img>';
		}
   
    var newRow = tbodyRef.insertRow(table_cart.length),

    cellName = newRow.insertCell(0),
    cellQuantity = newRow.insertCell(1),
    cellPrice = newRow.insertCell(2),
    cellOption = newRow.insertCell(3);

    cellName.innerHTML = '<td data-label="Name">' + imgLocation + key + '</td>';
    cellQuantity.innerHTML = '<td data-label="Quantity"> <button id = "substract" onclick="substract(this)">-</button> ' + localStorage.getItem(key) + ' <button id = "add" onclick="add(this)">+</button> </td>';
    cellPrice.innerHTML = '<td data-label="Price">' + price + '</td>	';
    cellOption.innerHTML = '<td data-label="Option"> <button id = "delete" onclick="deleteRow(this)">Delete</button></td>';

  }
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

  localStorage.setItem(name,quantity - 1);
  
  var cell = table_cart.rows[row].cells[column].innerHTML;
  table_cart.rows[row].cells[column].innerHTML = cell.replace(quantity, localStorage.getItem(name));
 
  updateBill();
}

function add(element){
  var row = element.parentNode.parentNode.rowIndex;
  var column = element.parentNode.cellIndex;

  var quantity = parseInt(table_cart.rows[row].cells[column].innerHTML.match(/(\d+)/));
  var nameCellInfo = table_cart.rows[row].cells[0].innerHTML
  var name = nameCellInfo.substring(nameCellInfo.indexOf('">') + 2);

  localStorage.setItem(name,quantity + 1);
  var cell = table_cart.rows[row].cells[column].innerHTML;
  table_cart.rows[row].cells[column].innerHTML = cell.replace(quantity, localStorage.getItem(name));

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

