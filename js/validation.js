


function validation()
{
	var name = document.registration.name ;
	var email = document.registration.email ;
	var uname = document.registration.uname ;
	var psw = document.registration.psw ;
	var cpsw = document.registration.cpsw ;

	if(valid_name(name))
	if(valid_user(uname))
	if(valid_email(email))	
	if(valid_pass(psw,cpsw))

		return false;
}

function valid_name(name)  //d
{  
	var letters = /[^[A-Za-z ]+$/
	if(name.value.match(letters)) 
	return true ;
    else
	alert('Sorry ! Use only alphabets for Name')
	name.focus();
	return false;
}
function valid_user(uname)		//d
{
	var letters = /^[-_a-zA-Z0-9]+$/
	if(uname.value.match(letters)) 
	return true ;
    else
	alert('Make your username with Alphanumeric or underscore or hyphen');
	uname.focus();
	return false;
}
function valid_email(email)
{
	var letters = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/  
	if(email.value.match(letters)) 
	return true ;
    else
	alert('Enter a valid email address')
	email.focus();
	return false;
}
function valid_pass(psw,cpsw)
{   
   
		
	var letters = /[^[A-Za-z ]+$/
	if(name.value.match(letters)) 
    if(psw.value == cpsw.value)
	return true ;
    else
	alert('Password should contain 8 characters atleast');
	psw.focus();
	return false;
}