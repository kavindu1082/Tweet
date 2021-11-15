<?php
session_start();

// Header Locations//
$indexlocation = '../index.php';
$signuplocation = '../signup.php';
$forgotpasswordlocation = '../forgotpassword.php';
$homelocation = '../home.php';
$mypostslocation = '../myposts.php';
$myaccountlocation = '../myaccount.php';
//Header Locations close//

if (!isset($_SESSION['user'])) {
    header('Location:' . $indexlocation);
}

//Database connection//
include('dbdata.php');
$con = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
//Database connections//

//login process (index.php)//
if (isset($_POST['login'])) {
    session_start();
    if (!isset($_POST['email'])) {
        header('Location:' . $indexlocation);
    }
    $e = $_POST['email'];
    $p = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE email='$e' AND password='$p' ";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $con->close();
        $_SESSION['user'] = $e;
        header('Location:' . $homelocation . '?success');
    } else {
        header('Location:' . $indexlocation . '?again');
    }

    $con->close();
}
//login process end//

//Signup process(signup.php)//
if (isset($_POST['signup'])) {
    if (!isset($_POST['email'])) {
        header('Location:' . $signuplocation);
    }
    $e = $_POST['email'];
    $p1 = $_POST['password1'];
    $p2 = $_POST['password2'];

    if ($p1 !== $p2) {
        header('Location:' . $signuplocation . '?matcherror');
    } else {
        $sql = "INSERT INTO users(email,password) VALUES('$e','$p1')";

        $result = $con->query($sql);

        if ($result !== false) {
            header('Location:' . $indexlocation . '?signupSuccess');
        } else {
            header('Location:' . $signuplocation . '?failed');
        }
    }
    $con->close();
}
//Signup process end//

//forgot password process(forgotpassword.php)//
if (isset($_POST['forgotPassword'])) {
    session_start();
    if (!isset($_POST['email'])) {
        header('Location:' . $forgotpasswordlocation);
    }
    $n = $_POST['name'];
    $e = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$e'";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $e;
        header('Location:' . $forgotpasswordlocation . '?sent');
    } else {
        header('Location:' . $forgotpasswordlocation . '?notsent');
    }

    $con->close();
}
//forgot password process end//

//details  process(myaccount.php)//
if (isset($_POST['detailId'])) {
    if (!isset($_POST['detailId'])) {
        header('Location:' . $myaccountlocation);
        die();
    }
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $id = $_POST['detailId'];

    $sql = "UPDATE users SET name='$name',address='$address',phone='$phone',country='$country' WHERE id=$id";

    $result = $con->query($sql);
    if ($result !== false) {
        header('Location:' . $myaccountlocation . '?detailsUpdated');
    } else {
        header('Location:' . $myaccountlocation . '?detailsfailedToUpdate');
    }
    $con->close();
}
//details  process end//

//changepassword  process (myaccount.php)//
if (isset($_POST['changepassId'])) {
    if (!isset($_POST['changepassId'])) {
        header('Location:' . $myaccountlocation);
        die();
    }
    $p1 = $_POST['changepassword'];
    $p2 = $_POST['changepassword1'];
    $id = $_POST['changepassId'];

    if ($p1 !== $p2) {
        header('Location:' . $myaccountlocation . '?matcherror');
    } else {
        $sql = "UPDATE users SET password='$p1' WHERE id=$id";
        $result = $con->query($sql);
        if ($result !== false) {
            header('Location:' . $myaccountlocation . '?Updated');
        } else {
            header('Location:' . $myaccountlocation . '?failedToUpdate');
        }
    }
    $con->close();
}
//changepassword  process end//

//Delete account  process(myaccount.php)//
if (isset($_POST['deleteaccId'])) {
    if (!isset($_POST['deleteaccId'])) {
        header('Location:' . $mypostslocation);
        die();
    }
    $id = $_POST['deleteaccId'];

    $email = $_SESSION['user'];

    $sql = "DELETE FROM users WHERE id=$id";
    $result = $con->query($sql);
    if ($result !== false) {
        header('Location:' . $indexlocation . '?accountDeleted');
    } else {
        header('Location:' . $myaccountlocation . '?failedTodeleteaccount');
    }

    $con->close();
}
//Delete account  process end//

//newpost process start(home.php)//
if (isset($_POST['newpost'])) {

    $email = $_SESSION['user'];
    $description = $con->real_escape_string($_POST['desc']);
    $target_dir = "../upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $sql = "INSERT INTO mask(description,email,uploads) VAlUES ('$description','$email','$target_file')";

    $result = $con->query($sql);

    if ($result !== false) {
        header('Location:' . $homelocation . '?success');
    } else {
        header('Location:' . $homelocation . '?failed');
    }

    //Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        header('Location:' . $homelocation);
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        header('Location:' . $homelocation . '?tooLarge');
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != ""
    ) {
        header('Location:' . $homelocation . '?wrongFormat');

        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        header('Location:' . $homelocation . '?filewasnotuploaded');
        // if everything is ok, try to upload file

    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            header('Location:' . $homelocation . '?fileUploaded');
            die();
        } else {
            header('Location:' . $homelocation);
            die();
        }
    }

    $con->close();
}
//newpost process end//

//Mypost process start (myposts.php)//
if (isset($_POST['mypost'])) {

    $email = $_SESSION['user'];
    $description = $con->real_escape_string($_POST['desc']);
    $target_dir = "../upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $sql = "INSERT INTO mask(description,email,uploads) VAlUES ('$description','$email','$target_file')";

    $result = $con->query($sql);

    if ($result !== false) {
        header('Location:' . $mypostslocation . '?success');
    } else {
        header('Location:' . $mypostslocation . '?failed');
    }

    //Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        header('Location:' . $mypostslocation);
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        header('Location:' . $mypostslocation . '?tooLarge');

        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != ""
    ) {
        header('Location:' . $mypostslocation . '?wrongFormat');

        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        header('Location:' . $mypostslocation . '?filewasnotuploaded');
        // if everything is ok, try to upload file

    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            header('Location:' . $mypostslocation . '?fileUploaded');
        } else {
            header('Location:' . $mypostslocation);
        }
    }

    $con->close();
}
//Mypost process end//

//Delete Post process(myposts.php)//
if (isset($_POST['deletepostId'])) {
    if (!isset($_POST['deletepostId'])) {
        header('Location:' . $mypostslocation);
        die();
    }
    $id = $_POST['deletepostId'];
    $email = $_SESSION['user'];

    $sql = "DELETE FROM mask WHERE id=$id";
    $result = $con->query($sql);
    if ($result !== false) {
        header('Location:' . $mypostslocation . '?deleted');
    } else {
        header('Location:' . $mypostslocation . '?failedToDelete');
    }
    $con->close();
}
//Delete Post  process end//

//Logout process start(navigation.php)//
if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header('Location:' . $homelocation);
}
//logout process end//

