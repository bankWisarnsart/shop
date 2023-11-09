<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function(){
		function validateLogin(){
			var username = $("#username").val();
			var password = $("#password").val();
			username == "" ? $("#userWarn").text("*Please fill out username.*") : $("#userWarn").text("");
			password == "" ? $("#passWarn").text("*Please fill out password.*") : $("#passWarn").text("");

			if(username != "" && password != ""){

        		var action = $("#loginBtn").val();
        		var url = "./api/user-service.php";
        		var json = 
        		{
        			"action": action,
        			"username": username,
        			"password": password
        		};

       			$.post(url, json, function(data, status){
      				if(data.check === "success0"){
       					window.location.href = 'admin.php';
       				}
					if(data.check === "success1"){
       					window.location.href = 'news.php';
      				}
       				else{
       					$("#valText").text("Invalid username or password.").show().fadeOut(1500);
       				}
       			});

			}
		}
		
		$("#loginBtn").click(function(){
			validateLogin();
  		});

	});
	</script>
	<style type="text/css">
		:root {
		--w: 800px;
		--h: 700px;
		--wHf: -400px;
		--hHf: -350px;
		}
		body {font-family: Arial, Helvetica, sans-serif;}
		body {
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: 100% 100%;
}
		.loginForm{
			text-align: center;
			position: absolute;
			width: 500px;
			height: 540px;
			top: 55%;
			left: 50%;
			margin-left: -250px;
			margin-top: -270px;
		}
		.loginForm *{
			margin: 5px;
		}
		span{
			color: red;
			position: absolute;
			width: 180px;
		}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: orange;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}
.center-form{
		background-color: rgba(255,255,255,0.6);
		border-radius: 5px;		
		position: absolute;
		width: var(--w);
		height: var(--h);
		left: 50%;
		top: 50%;
		margin-left: var(--wHf);
		margin-top: var(--hHf);
		text-align: center;
		box-sizing: border-box;
		padding: 15px 0px 15px 0px;
		border-radius: 10px 10px 10px 10px;
	}
	.center-form > input{
		background-color: rgba(255,255,255,.75);
		border-radius: 25px;
		width: 300px;
		outline: none;
		text-align: center;
		font-size: 18px;
		margin-left: 0;
		border: 0;
		margin-bottom: 14px;
		padding: 8px 8px 8px 8px;
	}
	

	.center-form > input::-webkit-input-placeholder  {
  		-webkit-transition: opacity 0.75s linear; 
  		color: #6b7a85;
	}

	.center-form > input:focus::-webkit-input-placeholder{
  		opacity: 0.4;
  		color: #317db5;
	}
	</style>
</head>
<body bgcolor="#CD9798">
	<div class="center-form">
<form method="post" action="login.php" class="loginForm">
	<img src="img/toys/Product3.jpg" width="72px" height="72px"><br>
	<h1>Welcome to TOYSHOP</h1>
	Username: <input type="text" name="username" id="username"><span id="userWarn"></span><br>
	Password: <input type="password" name="password" id="password"><span id="passWarn"></span><br>
	<section>
	<button type="button" id="loginBtn" value="login">Login</button>
	<button onclick="location.href='register.php'" type="button">Register</button>
	</section>
	<br>
	<h3 id="valText"></h3>
	</div>
</form>
</body>
</html>