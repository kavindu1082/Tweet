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

    <title>My Details</title>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="main.js"></script>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>
    <?php
    $homelink = "";
    $myaccountlink = "text-danger";
    include_once('navigation.php');
    ?>
    <div class="home text-center">
        <h5>My Details</h5>
    </div>


    <?php
    include('dbh/dbdata.php');
    $con = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

    $sql = "SELECT email,password,id,date,name,address,phone,country FROM users WHERE email='$u' ORDER BY date DESC";
    $result = $con->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];

    ?>
        <!-- divides page into 2 -->
        <!--part one  -->
        <!--Main  -->
        <div class="row m-2">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#changepassword_<?php echo ($id); ?>">
                    Change Password
                </button>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#details_<?php echo ($id); ?>">
                    Update Info
                </button>
            </div>
            <div class="col-sm-6">
                <?php
                if (isset($_GET['detailsUpdated'])) {
                    echo ("<div class='alert2 alert-success m-2 text-center' id='fade' role='alert'>
           Your Details Updated!
                </div>");
                }
                ?>
                <div class="card border-primary m-1">
                    <div class="card-header text-center">
                        Your Email
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo ($row['email']); ?></h5>
                    </div>
                </div>
                <div class="card border-primary m-1">
                    <div class="card-header text-center">
                        Your Password
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo ($row['password']); ?></h5>

                        <?php
                        if (isset($_GET['Updated'])) {
                            echo ("<div class='alert2 alert-success m-2 text-center' id='fade' role='alert'>
                   Password Changed!
                        </div>");
                        }
                        if (isset($_GET['failedToUpdated'])) {
                            echo ("<div class='alert2 alert-danger m-2 text-center' id='fade' role='alert'>
                   Failed to Change Password!
                </div>");
                        }
                        if (isset($_GET['matcherror'])) {
                            echo ("<div class='alert2 alert-danger m-2 text-center' id='fade' role='alert'>
                   Passwords do not match! TRY AGAIN
                        </div>");
                        }

                        ?>
                    </div>

                </div>
                <div class="card border-primary m-1">
                    <div class="card-header text-center">
                        User Id
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo ($row['id']); ?></h5>
                    </div>
                </div>
                <div class="card border-primary m-1">
                    <div class="card-header text-center">
                        Date and Time Account created
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo ($row['date']); ?></h5>
                    </div>
                </div>
            </div>


            <!-- Modal for change password-->
            <div class=" modal fade" id="changepassword_<?php echo ($id); ?>" data-bs-backdrop=" static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <form action="dbh/process.php" method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <fieldset>
                                        <label for="exampleInputEmail1" class="form-label">Enter New Password</label>
                                        <input type="password" name="changepassword" class="form-control" id="pass1" value="<?php echo $row['password'] ?>" />
                                        <label for="exampleInputEmail1" class="form-label">Retype</label>
                                        <input type="password" name="changepassword1" class="form-control" id="pass2" value="<?php echo $row['password'] ?>" />

                                    </fieldset>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" name="changepassId" value="<?php echo ($id); ?>">Confirm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <!--part 2-->

            <div class="col-sm-6">

                <div class="card border-primary m-1">
                    <div class="card-header text-center">
                        Your Name
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo ($row['name']); ?></h5>

                    </div>
                </div>
                <div class="card border-primary m-1">
                    <div class="card-header text-center">
                        Your Address
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo ($row['address']); ?></h5>


                    </div>
                </div>
                <div class="card border-primary m-1">
                    <div class="card-header text-center">
                        Phone Number
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo ($row['phone']); ?></h5>

                    </div>
                </div>
                <div class="card border-primary m-1">
                    <div class="card-header text-center">
                        Country
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo ($row['country']); ?></h5>

                    </div>
                </div>
            </div>
            <!-- Modal for Update info-->
            <div class=" modal fade" id="details_<?php echo ($id); ?>" data-bs-backdrop=" static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <form action="dbh/process.php" method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <fieldset>
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>" />
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" value="<?php echo $row['address'] ?>" />
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'] ?>" />
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" name="country" class="form-control" value="<?php echo $row['country'] ?>" />

                                    </fieldset>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" name="detailId" value="<?php echo ($id); ?>">Confirm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Modal for deleteaccount account-->
            <div class="modal fade" id="deactivate_<?php echo ($id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="dbh/process.php" method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete your account? You can't undo this action.

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger" name="deleteaccId" value="<?php echo ($id); ?>">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-grid mt-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deactivate_<?php echo ($id); ?>">
                    Delete Account
                </button>
            </div>

        </div>


    <?php

    }

    $con->close();

    ?>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</body>

</html>