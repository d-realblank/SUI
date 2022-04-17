

const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

if (bar){
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close){
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}
//add new key=>value to the HTML5 storage
function SaveItem(a,b,c,d) {	
	var name = a;
	var quantity = b;
	var price = c;
	var img = d;
	if(b>0&&(b%1==0)){
	var data = [quantity,price,img];	
	localStorage.setItem(name,JSON.stringify(data));
	}
	else{
		alert("please enter a positive integer")
	}

}
//------------------------------------------------------------------------------
function ModifyItem() {
	var name1 = document.forms.ShoppingList.name.value;
	var data1 = document.forms.ShoppingList.data.value;

			if (localStorage.getItem(name1) !=null)
			{
			  localStorage.setItem(name1,data1,);
			  document.forms.ShoppingList.data.value = localStorage.getItem(name1);
			}
		
	
	doShowAll();
}
//-------------------------------------------------------------------------
function RemoveItem() {
	var name = document.forms.ShoppingList.name.value;
	document.forms.ShoppingList.data.value = localStorage.removeItem(name);
	doShowAll();
}
//-------------------------------------------------------------------------------------
//restart the local storage
function ClearAll() {
	localStorage.clear();
	doShowAll();
}
//-------------------------------------------------------------------------------------
function doShowAll() {
	var key = "";
	var w = 5;
	var p=0;
	var list = "<tr><th>Item</th><th>#</th><th>weight (lb)</th><th>price ($)</th></tr>\n";
	var i = 0;
	for (i = 0; i <= localStorage.length-1; i++) {
		key = localStorage.key(i);
		if (key=="Potatoes"){
			p = 3.49;
		}
		if (key=="Carrots"){
			p = 4.99;
		}
		if (key=="Apples"){
			p = 7.99;		
		}
		list += "<tr><td>" + key + "</td><td>\n"
			+ localStorage.getItem(key) + "</td>"+"<td>" + localStorage.getItem(key)*w + "</td><td>"
			+ localStorage.getItem(key)*p.toFixed(2) + "</td></tr>\n";
	}
	document.getElementById('list').innerHTML = list;
	
}
