function checkpass1(passvar){
	if (passvar.value.length < 8){
		passvar.setCustomValidity("Passwords must be at least 8 characters long");
	}
	else{
		passvar.setCustomValidity('');
	}
}

function confirmpass(passvar){
	var email1 = document.getElementById("ipass").value;
	var email2 = document.getElementById("cpass").value;

	if (email1 == email2){
		passvar.setCustomValidity('');
	}
	else{
		passvar.setCustomValidity("Passwords do not match");
	}
}

function confirmemail(mailvar){
	var firstEmail = document.getElementById("iemail").value;
	var secondEmail = mailvar.value;

	if (firstEmail == secondEmail){
		mailvar.setCustomValidity('');
	}
	else{
		mailvar.setCustomValidity("Email does not match");
	}
}

function checkemail(mailvar){
	var theEM = document.getElementById("iemail").value;

	if(/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(theEM)){
		mailvar.setCustomValidity('');
	}
	else{
		mailvar.setCustomValidity("Invalid Email");
	}
}