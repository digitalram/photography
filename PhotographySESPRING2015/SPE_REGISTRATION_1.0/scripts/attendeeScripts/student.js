// use regular expressions to restrict info inpu in text box
// Xin Yang, April,04,2014
//Purpose: function to check the correct format of the input text


function chkText(event){

var pos = event.currentTarget.value.search(/^[A-Z][a-z]+$/);

if(pos != 0){
	event.currentTarget.value = "";
	alert("Incorrect format: Upper case followed by lower case.");
}

}

function chkEmail(event){

var pos = event.currentTarget.value.search(/^[a-z0-9]+@[a-z0-9]+\.[a-z]+$/);

if(pos != 0){
	event.currentTarget.value = "";
	alert("Incorrect format: address@domain.end."
	+ "eg: ncut@gmail.com"
	);
}

}