var subtotal = 0; 
var totalItems = 0;
var index = 0;
var table_cart = document.getElementById("product-list");

for(var i = 1; i < table_cart.rows.length; i++){ 
 var quantity = parseInt(table_cart.rows[i].cells[1].innerHTML.match(/(\d+)/));
 totalItems = totalItems + quantity;

 var currentPrice = table_cart.rows[i].cells[2].innerHTML.replace('$','');
 subtotal = subtotal + parseFloat(currentPrice * quantity);
}

updateBill();

function updateBill(){
  var gst = 0.05 * subtotal;
  var qst = 0.09975 * subtotal;
  var total = subtotal + qst + gst;
  
  document.getElementById("totalItems").innerHTML = totalItems;
  document.getElementById("subtotal").innerHTML = subtotal.toFixed(2) + "$";
  document.getElementById("gst").innerHTML = (0.05 * subtotal).toFixed(2) + "$";
  document.getElementById("qst").innerHTML = (0.09975 * subtotal).toFixed(2) + "$";
  document.getElementById("total").innerHTML = total.toFixed(2) + "$";
}

function updateCart(){
  subtotal = 0; 
  totalItems = 0;

  for(var i = 1; i < table_cart.rows.length; i++){
    var quantity = parseInt(table_cart.rows[i].cells[1].innerHTML.match(/(\d+)/));
 totalItems = totalItems + quantity;

 var currentPrice = table_cart.rows[i].cells[2].innerHTML.replace('$','');
 subtotal = subtotal + parseFloat(currentPrice * quantity);
   }
}


function substract(element){
  
  var row = element.parentNode.parentNode.rowIndex;
  var column = element.parentNode.cellIndex;
  var quantity = parseInt(table_cart.rows[row].cells[column].innerHTML.match(/(\d+)/));

  if ((quantity - 1) == 0){
    if(confirm('Are you sure to delete this item?')){
      table_cart.deleteRow(row);
      updateCart();
      updateBill();
    }
    else{
      return;
    }
  }

  var cell = table_cart.rows[row].cells[column].innerHTML;
  table_cart.rows[row].cells[column].innerHTML = cell.replace(quantity, (quantity - 1));
  updateCart();
  updateBill();
}

function add(element){
  var row = element.parentNode.parentNode.rowIndex;
  var column = element.parentNode.cellIndex;
  var quantity = parseInt(table_cart.rows[row].cells[column].innerHTML.match(/(\d+)/));

  var cell = table_cart.rows[row].cells[column].innerHTML;
  table_cart.rows[row].cells[column].innerHTML = cell.replace(quantity, (quantity + 1));

  updateCart();
  updateBill();
}

function deleteRow(element){
  var row = element.parentNode.parentNode.rowIndex;
  if(confirm('Are you sure to delete this item?')){
    table_cart.deleteRow(row);
    updateCart();
    updateBill();
  }
}