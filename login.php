<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Lab Act 2 Finals</title>

  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <main id="main" class=" bg-dark">
    <div id="login-left">
    </div>
    <div id="login-right">
      <div class="card col-md-8">
        <div class="white-box">
          <form id="login-form" form method="POST" action="login.php">
            <?php include('errors.php'); ?>

            <div class="form-group">
              <div class="input-group">
                <div class="container">
                  <br>
                  <label for="username">&emsp; Username</label>
                  <center><input type="text" id="username" name="username"></center>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="container">
                  <br>
                  <label for="password">&emsp; Password</label>
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