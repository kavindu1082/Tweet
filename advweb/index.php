<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="main.js"></script>

  <title>Test Website</title>
</head>

<body>


  <div class="container-sm w-50 mt-3 text-dark ">

    <form method="POST" action="dbh/process.php">
      <div class="text-center mb-4">
        <img src="SVG/twitter.png" style="height: 100px;">
        <h5>Tweet</h5>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="pass" class="form-control" id="exampleInputPassword1" required>
      </div>
      <div class="d-grid gap-2 col-6 mx-auto mt-2">
        <button type="submit" class="btn btn-outline-success" name="login">Login</button><br />
      </div>
      <div class="d-grid gap-2 d-md-flex ">
        <a href="signup.php" class="btn btn-outline-info mt-2">Sign up</a>
      </div>
      <div class="d-grid gap-2 d-md-flex">
        <a href="forgotpassword.php" class="btn btn-outline-danger mt-2">Forgot password?</a>
      </div>
      <?php
      if (isset($_GET['signupSuccess'])) {
        echo ("<div class='alert alert-success mt-1 text-center' id='fade' role='alert'>
                User Registered Login to Continue...
            </div>");
      }

      if (isset($_GET['again'])) {
        echo ("<div class='alert alert-danger mt-1 text-center' id='fade' role='alert'>
                    Login Incorrect!
                </div>");
      }
      if (isset($_GET['accountDeleted'])) {
        echo ("<div class='alert alert-danger mt-1 text-center' id='fade' role='alert'>
                    Account deleted successfully!
                </div>");
      }
      ?>

    </form>
  </div>



  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</body>

</html>