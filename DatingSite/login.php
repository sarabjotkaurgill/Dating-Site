<!-- header -->
<?php
require_once "header.php";
?>

<!-- session start -->
<?php
session_start();
?>

<!-- configuration with database and login user to move further -->
<?php
$message = "";
require_once "config.php";
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $data = $conn->query("SELECT * FROM users WHERE email='$email' and password='$password'")->fetchAll();
    $count = count($data);
    if ($count > 0) {
        foreach ($data as $row) {
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['about'] = $row['about'];
            $_SESSION['picture'] = $row['picture'];
        }
//echo $_SESSION['userid'];
        header('Location: index.php');
        exit;
    } else {
        $msg = "wrguserspw";
        //header('Location: login.php');
        $message = '<label>Please enter correct information!</label>';
//exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/css/login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Register</title>
    </head>

    <body>

        <h1 class="heading">Login</h1>

        <!-- main content -->
        <!--form-->
        <section class="form-div">
            <form action="login.php" method="post" autocomplete="off">
                <label>
                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                </label>
                <br>
                <label class="hidden">Please enter correct information!Please enter correct information!</label><br>
                <center>
                    <label>Please login to move further!</label></center>
                <br><br><label>Email:</label><br>
                <input type="email" placeholder="Email" name="email" autocomplete="off" required /><br>
                <label>Password:</label><br>
                <input type="password" placeholder="Password" name="password" autocomplete="off" required /><br><br>
                <input type="submit" value="Login" name="login">
            </form>

        </section>
    <center>
        <label>No account?</label><br><br>
        <label><a style="color: blue;" href="register.php">Register here!</a></label><br>
    </center>
</body>
</html>

<!-- footer -->
<?php
require_once "footer.php";
?>
    


