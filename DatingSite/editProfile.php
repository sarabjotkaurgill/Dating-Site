<!-- header -->
<?php
require_once "header.php";
?>

<!-- session start and configuration with database and update profile of user -->
<?php
ob_start();
session_start();
require_once "config.php";

if (isset($_POST['update'])) {
    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    $file = $_FILES['picture']['name'];
    if ($file != "") {
        move_uploaded_file($_FILES['picture']['tmp_name'], 'assets/images/' . $file);
        $file = 'assets/images/' . $file;
    } else {
        $file = $_POST['profile'];
    }

    $id = $_SESSION['userid'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $about = $_POST['about'];
    $picture = $file;

    //updating the table
    $sql = "UPDATE users SET name=:name, email=:email, phonenumber=:phonenumber, password=:password, about=:about, picture=:picture WHERE userid=:userid";
    $query = $conn->prepare($sql);

    $query->bindparam(':userid', $id);
    $query->bindparam(':name', $name);
    $query->bindparam(':email', $email);
    $query->bindparam(':phonenumber', $phonenumber);
    $query->bindparam(':password', $password);
    $query->bindparam(':about', $about);
    $query->bindparam(':picture', $picture);
    $query->execute();

    // Alternative to above bindparam and execute
    // $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
    //redirectig to the display page, it is index.php
    header("Location: index.php");
}
?>

<!-- getting user information -->
<?php
//getting id 
$id = $_SESSION['userid'];

//selecting data associated with this particular id
$sql = "SELECT * FROM users WHERE userid=$id";
$query = $conn->prepare($sql);
$query->execute(array(':id' => $id));

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['name'];
    $email = $row['email'];
    $phonenumber = $row['phonenumber'];
    $password = $row['password'];
    $about = $row['about'];
    $picture = $row['picture'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/css/register.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Edit Profile</title>
    </head>

    <body>

        <h1 class="heading">Edit Profile</h1>

        <!-- main content -->
        <!--form-->
        <section class="form-div">
            <form action="editProfile.php" method="post" enctype="multipart/form-data" autocomplete="off">
                <div><label>Select your profile picture: </label>
                    <input type="file" name="picture"><br></input>
                    <input name="profile" value="<?php echo $picture ?>"/>
                </div><br>
                <input type="hidden" name="userid" value=<?php echo $_SESSION['userid']; ?>>
                <label>Name:</label><br>
                <input type="text" placeholder="User Name" name="name" value="<?php echo $name; ?>" autocomplete="off" required /><br>
                <label>Email:</label><br>
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" autocomplete="off" required /><br>
                <label>Phone Number:</label><br>
                <input type="tel" placeholder="Phone Number" name="phonenumber" value="<?php echo $phonenumber; ?>" autocomplete="off" required /><br>
                <label>Password:</label><br>
                <input type="password" placeholder="Password" name="password" value="<?php echo $password; ?>" autocomplete="off" required /><br><br>
                <textarea name="about" id="ts" cols="30" rows="10" placeholder="Tell us about yourself" autocomplete="off" required><?php echo $about; ?></textarea>
                <br><br><input type="submit" value="Update" name="update">
            </form>
        </section>
    </body>
</html>

<!-- footer -->
<?php
require_once "footer.php";
?>






