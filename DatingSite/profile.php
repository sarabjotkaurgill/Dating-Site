<!-- header -->
<?php
require_once "header.php";
?>

<!-- session start and configuration with database, also fetch user information -->
<?php
session_start();
require_once "config.php";

if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
    $data = $conn->query("SELECT * FROM `users` WHERE userid=$id")->fetchAll();
    //echo $id;
    foreach ($data as $row) {
        $name = $row['name'];
        $email = $row['email'];
        $phonenumber = $row['phonenumber'];
        $about = $row['about'];
        $picture = $row['picture'];
    }
} else {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Profile</title>
    </head>

    <body>

        <!-- logout and edit profile -->
    <br><center>
        <h1 class="heading">Profile</h1>
        <label><a style="color: blue;" href="logout.php">Logout</a></label><br><br>
        <label><a style="color: blue;" href="editProfile.php">Edit Profile</a></label><br><br>

        <!-- user information -->
        <img src="<?php echo $picture; ?>" height="30%" width="30%" alt="<?php echo $name; ?>"/><br><br>
        <label><?php echo "<b>Name: </b>" . $name; ?></label><br><br>
        <label><?php echo "<b>Email: </b>" . $email; ?></label><br><br>
        <label><?php echo "<b>Phone Number: </b>" . $phonenumber; ?></label><br><br>
        <label><?php echo "<b>About: </b>" . $about; ?></label><br><br>
    </center>

</body>
</html>

<!-- footer -->
<?php
require_once "footer.php";
?>

