<?php include('server.php') ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <title>Lab Act 2 Finals</title>
 	

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
    }
    
	body{
		width: 100%;
	    height: calc(100%);
        font-family: Tahoma, sans-serif;
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: 100%;
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: 100%;
		background:#59b6ec61;
		display: flex;
		align-items: center;
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	#login-right .card{
		margin: auto;
		z-index: 1
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
    z-index: 10;
}
div#login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100%);
    height: calc(100%);
    background: #000000e0;
}
.white-box {
    background-color: white;
    color: black;
}

.container {
  width: 300px;
  clear: both;
}

.container input {
  width: 50%;
  clear: both;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
}

input[type=text] {
  width: 80%;
  padding: 10px 5px;
  margin: 8px 0;
  box-sizing: border-box;
}

input[type=password] {
  width: 80%;
  padding: 10px 5px;
  margin: 8px 0;
  box-sizing: border-box;
}

</style>

<body>
  <main id="main" class=" bg-dark">
  		<div id="login-left">
  		</div>
  		<div id="login-right">
  			<div class="card col-md-8">
  				<div class="white-box">	
  					<form id="login-form" form method="POST" action="login.php" >
  						<div class="form-group">
              <div class="input-group">
                          <div class="container">
                              <br>
  							<label for="username" >&emsp; Username</label>
  							<center><input type="text" id="username" name="username" ></center>
                           </div>
              </div>
  						</div>
  						<div class="form-group">
              <div class="input-group">
                          <div class="container">
                            <br>
  							<label for="password" >&emsp; Password</label>
  							<center><input type="password" id="password" name="password"></center>
                            </div>
              </div>
                        </div>
              <div class="input-group">
                          <br>

  						<center><input type="submit" name="login_user" value="Login"></button></center>
              </div>
						<br>
            <p>
  	          	<center>Not yet a member? <a href="register.php">Sign up</a></center>
  	        </p>
            <br>
  					</form>
  				</div>
  			</div>
  		</div>
  </main>
</body>

</html>