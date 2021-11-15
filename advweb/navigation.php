<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"> <img src="SVG/twitter.png" style="height: 35px;"><br />
      <h6>Tweet</h6>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo ($homelink); ?> text-center" aria-current="page" href="home.php">
            <h5>Home</h5>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($mypostslink); ?> text-center" href="myposts.php">
            <h5>My Posts</h5>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?php echo ($myaccountlink); ?> text-center" href="myaccount.php">
            <h5>My Account</h5>
          </a>
        </li>


      </ul>

      <form class="d-flex justify-content-center"><img src="SVG/profile.png" style="height: 35px;">
        <div class="welcome text-dark d-flex mt-1 m-2">

          <?php
          echo "$u";
          ?>
        </div>

      </form>
      <form method="POST" action="dbh/process.php">
        <div class="btn d-flex justify-content-end">
          <button type="submit" name="logout" style="border:none;padding:0px;"><img src="SVG/logoutGIF.gif" style="height: 35px;"> </button>
        </div>
      </form>
    </div>
  </div>
</nav>