
function check_all(){
	if(check_username()&&check_email()){
        return true;
    }

	else{
        return false;

    }

}

function check_email(){

	var mail=$("#email").val();

    var $mailMsg=$("#email_check");

    var pattern="^[_/.a-z0-9]+@[a-z0-9]+[/.][a-z0-9]{2,}$";
    var check=new RegExp(pattern);
	if(!check.test(mail)){
		$mailMsg.html("<font color='blue'>Email is invalid</font>");
		return false;
	}else{
		$mailMsg.html("<font color='black'>valid</font>");
		return true;

	}
}
function check_username(){
    var $username = $('#username').val();
    console.log("user name: " + $username);

    var pattern="^[0-9a-zA-Z_.-]+$";
	var check=new RegExp(pattern);

	if(!check.test($username)){
		$('#username_check').html("<font color='blue'>user name is invalid</font>");
                return false;
	} 
    else{
        $('#username_check').html("<font color='black'>username valid</font>");
    }
}