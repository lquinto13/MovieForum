<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Lab Act 2 Finals</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- MDB Style -->
  <link rel="stylesheet" href="mdb-bootstrap-3.10.1/css/mdb.min.css" />
  <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Custom Styles -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <main id="main" class="vh-100 bg-dark">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-8 px-0 d-none d-sm-block vh-100 gradient-background">
        </div>

        <div class="col-sm-4 text-white bg-dark">
          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <form id="login-form" form method="POST" action="login.php" style="width: 25rem;">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log In</h3>

              <div class="form-outline form-white mb-4">
                <input type="text" id="username" name="username" class="form-control form-control-lg" />
                <label class="form-label" for="username">Username</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                <label class="form-label" for="password">Password</label>
              </div>

              <?php if (count($errors) > 0) : ?>
                  <?php foreach ($errors as $error) : ?>
                    <p style="color: #F93154;"><i class="fas fa-exclamation-circle"></i> <?php echo $error ?></p>
                  <?php endforeach ?>
              <?php endif ?>

              <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="submit" name="login_user">Login</button>
              </div>
              <p>Don't have an account? <a href="register.php" class="link-info">Register here</a></p>
            </form>

          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- Bootstrap Script -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- MDB Script -->
  <script type="text/javascript" src="mdb-bootstrap-3.10.1/js/mdb.min.js"></script>
</body>

</html>