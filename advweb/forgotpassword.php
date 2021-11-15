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
  <div class="container-sm  w-50 mt-3 border-danger rounded-3" id="fp">

    <form method="POST" action="dbh/process.php">
      <div class="text-center mb-4">
        <img src="SVG/twitter.png" style="height: 100px;">
        <h5>Tweet</h5>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">First Name and Last Name</label>
        <input type="text" name="name" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp">
      </div>
      <div class="mb-3 rounded-pill">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="d-grid gap-2 col-6 mx-auto mt-2 ">
        <button type="submit" class="btn btn-outline-danger" name="forgotPassword">Submit</button><br />
      </div>
      <div class="d-grid gap-2 col-6 mx-auto mt-1">
        <a href="signup.php" class="btn btn-outline-info">Sign up</a>
        <a href="index.php" class="btn btn-outline-success">Login</a>

      </div>
      <?php
      if (isset($_GET['sent'])) {
        echo ("<div class='alert alert-success mt-2 text-center' id='fade' role='alert'>
                Check Mails for the Password...
            </div>");
      }

      if (isset($_GET['notsent'])) {
        echo ("<div class='alert alert-danger mt-2 text-center' id='fade' role='alert'>
                    Invalid Email!  Tryagain
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