<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
}
$u = $_SESSION['user'];
?>

<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- BootstrapCSS -->

    <title>Home Page</title>

    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="main.js"></script>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>

    <?php
    $homelink = "text-danger";
    include('navigation.php');
    ?>
    <div class="home text-center">
        <h5>Home</h5>
    </div>

    <div class="heading  text-center">
        <?php
        if (isset($_GET['success'])) {
            echo ("<div class='alert2 alert-success m-2 text-center' id='fade' role='alert'>
                   Welcome!
                </div>");
        }
        ?>
    </div>

    <!--User Posts Starts-->
    <div class="card  border-primary m-2">
        <div class="card-body">
            <form action="dbh/process.php" method="POST" enctype="multipart/form-data">
                <div class="lets_get_connected">
                    <label for="exampleFormControlTextarea1" class="form-label fw-bold">Let's Get Connected</label>
                    <textarea class="form-control border-success" id="exampleFormControlTextarea1" rows="2" name="desc"></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-center mt-2 justify-content-lg-end">
                    <input type="file" name="fileToUpload" id="fileToUpload" class="uploadbox">
                    <button type="submit" class="btn me-2" name="newpost">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!--User Posts end-->


    <?php
    include('dbh/dbdata.php');
    $con = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
    $sql = "SELECT id,description,date,email,uploads FROM mask ORDER BY date DESC";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $email = $row['email'];
    ?>

        <div class="card m-2">
            <div class="card-header">
                <img src="SVG/calendar.png" style="height: 30px;">
                <?php echo ($row['date']); ?>
            </div>
            <div class="card-body"><img src="SVG/comment.png" style="height: 30px;">
                <blockquote class="blockquote">
                    <p><?php echo ($row['description']); ?></p>
                    <div class="upload d-flex justify-content-center">
                        <img src="<?php echo ($row['uploads']); ?>" onerror="this.style.display='none'" style="height:175px;">
                    </div><br />
                    <footer class="blockquote-footer">Posted by &nbsp<img src="SVG/profile.png" style="height: 30px;">&nbsp&nbsp<?php echo ($row['email']); ?><citetitle="Source Title">
                            </citetitle>
                    </footer>
                </blockquote>
               
            </div>
        </div>
    <?php
    }
    $con->close();
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


</body>

</html>