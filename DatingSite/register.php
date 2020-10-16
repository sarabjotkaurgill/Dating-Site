<!-- header -->
<?php
require_once "header.php";
?>

<!-- session start -->
<?php
ob_start();
session_start();
?>

<!-- configuration with database and register user -->
<?php
require_once "config.php";
if (isset($_POST['register'])) {
    print_r($_POST);

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    $dir = "assets/images/";
    $target = $dir . basename($_FILES['picture']['name']);
    move_uploaded_file($_FILES['picture']['tmp_name'], $target);
    $picture = basename($_FILES['picture']['name']);

    $data = [
        'name' => $name,
        'email' => $email,
        'phonenumber' => $phonenumber,
        'password' => $password,
        'about' => $about,
        'picture' => "assets/images/" . $picture
    ];
    $sql = "INSERT INTO users (name, email, phonenumber, password, about, picture) VALUES (:name, :email, :phonenumber, :password, :about, :picture)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    $userid = $conn->lastInsertId();

    if ($userid) {
        $_SESSION['userid'] = $userid;
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['about'] = $_POST['about'];
        $_SESSION['picture'] = "assets/images/" . $picture;
        header("location: index.php");
    } else {
        echo 'Failure';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/css/register.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Register</title>
    </head>

    <body>

        <h1 class="heading">Register</h1>

        <!-- main content -->
        <!--form-->
        <section class="form-div">
            <form action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div><label>Select your profile picture: </label>
                    <input type="file" name="picture" required />
                </div><br>
                <label>Name:</label><br>
                <input type="text" placeholder="User Name" name="name" autocomplete="off" required /><br>
                <label>Email:</label><br>
                <input type="email" placeholder="Email" name="email" autocomplete="off" required /><br>
                <label>Phone Number:</label><br>
                <input type="tel" placeholder="Phone Number" name="phonenumber" autocomplete="off" required /><br>
                <label>Password:</label><br>
                <input type="password" placeholder="Password" name="password" autocomplete="off" required /><br><br>
                <textarea name="about" id="ts" cols="30" rows="10" placeholder="Tell us about yourself" autocomplete="off" required></textarea>
                <br><br><input type="submit" value="Register" name="register">
            </form>
        </section>

        <!-- login if already have account -->
    <center>
        <label>Already have account?</label><br><br>
        <label><a style="color: blue;" href="login.php">Login!</a></label><br>
    </center>

</body>
</html>

<!-- footer -->
<?php
require_once "footer.php";
?>
    


