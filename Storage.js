//add new key=>value to the HTML5 storage
function SaveItem() {
			
	var name2 = document.forms.ShoppingList.name.value;
	var data2 = document.forms.ShoppingList.data.value;
	localStorage.setItem(name2, data2);
	doShowAll(arguments[0],arguments[1]);
	
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
		
	
	doShowAll(arguments[0],arguments[1]);
}
//-------------------------------------------------------------------------
function RemoveItem() {
	var name = document.forms.ShoppingList.name.value;
	document.forms.ShoppingList.data.value = localStorage.removeItem(name);
	doShowAll(arguments[0],arguments[1]);
}
//-------------------------------------------------------------------------------------
//restart the local storage
function ClearAll() {
	localStorage.clear();
	doShowAll(arguments[0],arguments[1]);
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
		if (key==Potatoe){
			p = 3.49;
		}
		if (key==Carrot){
			p = 4.99;
		}
		if (key==Apple){
			p = 7.99;			}
		list += "<tr><td>" + key + "</td><td>\n"
			+ localStorage.getItem(key) + "</td>"+"<td>" + localStorage.getItem(key)*w + "</td><td>"
			+ localStorage.getItem(key)*p + "</td></tr>\n";
	}
	document.getElementById('list').innerHTML = list;
	
}