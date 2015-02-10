// event registering for text boxes
// Xin Yang, April,04,2014
//Purpose: call the function to check the correct format of the input text


document.getElementById("firstName").addEventListener("change",chkText,false);

document.getElementById("lastName").addEventListener("change",chkText,false);

document.getElementById("email").addEventListener("change",chkEmail,false);