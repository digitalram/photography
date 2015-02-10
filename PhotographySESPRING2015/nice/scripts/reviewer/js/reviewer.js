boolPhone = false;

function checkFirstName(){
    var FN = document.getElementById("firstName").value;
    var firstcharF = FN.charAt(0);
    
    // Conditional for if the first character entered is not
    // a letter
    if (FN.length >= 1 && !isNaN(firstcharF)){
        alert('Your first name cannot start with a number');
    }

    if (FN && FN.length >= 1){
        var firstchar1 = FN.charAt(0);
        var remaining = FN.slice(1);
        var FNfixed = firstchar1.toUpperCase() + remaining;
    }
    
    // This if statement is necessary for the placeholder to
    // remain 'First' if the user altered the input and then
    // deleted it.
    if (FN.length > 1){ 
        document.getElementById("firstName").value = FNfixed;
    }
    
}

function checkLastName(){
    var lastname = document.getElementById("lastName").value;
    var firstcharL = lastname.charAt(0);
    
    // Conditional for if the first character entered is not
    // a letter
    if (lastname.length >= 1 && !isNaN(firstcharL)){
        alert('Your last name cannot start with a number');
    }
    if (lastname && lastname.length >= 1){
        var firstchar2 = lastname.charAt(0);
        var remaininglast = lastname.slice(1);
        var lastnamefixed = firstchar2.toUpperCase() + remaininglast;
    }
    
    // This if statement is necessary for the placeholder to
    // remain 'Last' if the user altered the input and then
    // deleted it.
    if (lastname.length >= 1){
        document.getElementById("lastName").value = lastnamefixed;
    }
}

function checkPhone(input){
    var phoneNum = document.getElementById("phoneNumber").value;
    
    var correct1 = phoneNum.search(/^\d{3}-\d{3}-\d{4}$/);
    var correct2 = phoneNum.search(/[(]\d{3}[)] \d{3}-\d{4}$/);
    var correct3 = phoneNum.search(/^\d{10}?/);

    if(/^\d{10}?/.test(phoneNum) || /[(]\d{3}[)] \d{3}-\d{4}$/.test(phoneNum) || /^\d{3}-\d{3}-\d{4}$/.test(phoneNum)){
        input.setCustomValidity('');
    }
    else{
        input.setCustomValidity("Phone number convention: 555-555-5555");
    }
}


function checkEmail(mailvar){
    var theEM = document.getElementById("email").value;

    if(/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(theEM)){
        mailvar.setCustomValidity('');
    }
    else{
        mailvar.setCustomValidity("Invalid Email");
    }
}





/*
// use regular expressions to restrict info input in text box

function chkText(event) {

    var pos = event.currentTarget.value.search(/^[A-Z][a-z]+$/);

    if (pos != 0) {
        event.currentTarget.value = "";
        alert("Incorrect format: Upper case followed by lower case.");
    }
}


function chkTextTwo(event) {

    var pos = event.currentTarget.value.search(/^[A-Z][a-z]+$|^[A-Z][a-z]+ [A-Z][a-z]+$|^[A-Z][a-z]+ [A-Z][a-z]+ [A-Z][a-z]+$/);

    if (pos != 0) {
        event.currentTarget.value = "";
        alert("Incorrect format: Upper case followed by lower case with three words.");
    }
}


function chkEmail(event) {

    var pos = event.currentTarget.value.search(/^[a-z0-9]+@[a-z0-9]+\.[a-z]+$/);

    if (pos != 0) {
        event.currentTarget.value = "";
        alert("Incorrect format: address@domain.end : address consists of"
        + " lowercase letters and or numbers, rest have to be letters.");
    }
}

function chkWeb(event) {

    var pos = event.currentTarget.value.search(/^[w]{3}\.[a-z0-9]+\.[a-z]{3}$/);

    if (pos != 0) {
        event.currentTarget.value = "";
        alert("Incorrect format: www.address.com : address consists"
        + " of lowercase letters and numbers.");
    }
}

function chkAddr(event) {

    var pos = event.currentTarget.value.search(/^[a-zA-Z0-9. #]+$/);

    if (pos != 0) {
        event.currentTarget.value = "";
        alert("Incorrect format: includes: periods, pound, spaces,"
        + " lowercase letters, uppercase letters, and numbers.");
    }
}


function chkZip(event) {

    var pos = event.currentTarget.value.search(/^[0-9]+$/);

    if (pos != 0) {
        event.currentTarget.value = "";
        alert("Incorrect format: Please enter your zipcode.");
    }   
}


function chkPhone(event) {

    var pos = event.currentTarget.value.search(/^\d{3}-\d{3}-\d{4}$|^\(\d{3}\) \d{3}-\d{4}$/);

    if (pos != 0) {
        event.currentTarget.value = "";
        alert("Incorrect format: (111) 111-1111 or 111-111-1111");
    }
}*/