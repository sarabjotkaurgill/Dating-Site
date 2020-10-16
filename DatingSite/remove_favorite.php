<!-- header -->
<?php
require_once "header.php";
?>

<!-- session start and configuration with database -->
<?php
session_start();
require_once "config.php";
?>

<!-- display user information which are selected to delete -->
<?php
if (isset($_GET['userid']) && !empty($_GET['userid'])) {
    $favid = $_GET['userid'];
    $data = $conn->query("SELECT * FROM `users` WHERE userid=$favid")->fetchAll();
    foreach ($data as $row) {
        $fav_picture = $row['picture'];
        $fav_name = $row['name'];
        $fav_email = $row['email'];
        $fav_phn = $row['phonenumber'];
        $fav_about = $row['about'];
    }
}
?>

<!-- remove favorite user from their list -->
<?php
if (isset($_POST['remove'])) {
    print_r($_POST);

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

//Deleting a row using a prepared statement.
    $sql = "DELETE FROM `favorite` WHERE `favoriteid` = :favoriteid";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':favoriteid', $favoriteid);
    $delete = $statement->execute();

    header('location: index.php');
}
?>

<!-- display user information that would be deleted -->
<center>
    <br><br><img class="image" src="<?php echo $fav_picture ?>" height="26%" width="26%" alt="<?php echo $fav_name ?>"/><br><br>
    <label><?php echo '<b>Name: </b>' . $fav_name ?></label><br><br>
    <label><?php echo '<b>Email: </b>' . $fav_email ?></label><br><br>
    <label><?php echo '<b>Phone Number: </b>' . $fav_phn ?></label><br><br>
    <label><?php echo '<b>About: </b>' . $fav_about ?></label><br><br><br><br>
    <form method="POST" action="<?php echo htmlspecialchars('remove_favorite.php'); ?>">
        <input type="hidden" name="favoriteid" value="<?php echo $favid; ?>" />
        <button type="submit" name="remove" style="background-color:black;color:white;border-color: yellow;">Remove</button><br><br>
    </form>
</center>

<!-- footer -->
<?php
require_once 'footer.php';
?>

