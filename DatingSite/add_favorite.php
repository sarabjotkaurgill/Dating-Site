<!-- header -->
<?php
require_once "header.php";
?>

<!-- session start and configuration with database -->
<?php
session_start();
require_once "config.php";
?>

<!-- from userid display user information that would be added to favorite -->
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

<!-- if user add to favorite list then that will insert into favorite table in database -->
<?php
if (isset($_POST['add'])) {
    print_r($_POST);

    foreach ($_POST as $key => $value) {
        $$key = $value;
    }

    $data = [
        'userid' => $_SESSION['userid'],
        'favoriteid' => $favoriteid,
    ];
    $sql = "INSERT INTO favorite (userid, favoriteid) VALUES (:userid, :favoriteid)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    $userid = $conn->lastInsertId();

    //mail($fav_email, "Add to favorite", "You have been added to favorite list from dating site by " . $_SESSION['email'],  $_SESSION['email']);
    //echo "Your message has been sent<br>$fav_email by ". $_SESSION['email'];

    header('location: index.php');
}
?>

<!-- inner join query to check if user is already added to favorite or not -->
<?php
$id = $_SESSION['userid'];
$data2 = $conn->query("SELECT * 
            FROM favorite INNER JOIN 
            users ON `users`.`userid`=`favorite`.`favoriteid` 
            WHERE `favorite`.`userid`= $id")->fetchAll();
?>

<!-- user information -->
<center>
    <br><br><img class="image" src="<?php echo $fav_picture ?>" height="26%" width="26%" alt="<?php echo $fav_name ?>"/><br><br>
    <label><?php echo '<b>Name: </b>' . $fav_name ?></label><br><br>
    <label><?php echo '<b>Email: </b>' . $fav_email ?></label><br><br>
    <label><?php echo '<b>Phone Number: </b>' . $fav_phn ?></label><br><br>
    <label><?php echo '<b>About: </b>' . $fav_about ?></label><br><br><br><br>
    <form method="POST" action="<?php echo htmlspecialchars('add_favorite.php'); ?>">
        <input type="hidden" name="favoriteid" value="<?php echo $favid; ?>" />

        <!-- check if user already added to favorite or not -->
        <?php
        //if (!isset($data2)) {
        foreach ($data2 as $row2) {
//if(!empty($row['favoriteid'])){
            if ($row2['favoriteid'] == $favid) {
                echo 'Already added<br>';
                break;
            } else {
                echo '<button type="submit" name="add" style="background-color:black;color:white;border-color: yellow;">Add</button><br><br>';
                //mail($fav_email, "Add to favorite", "You have been added to favorite list from dating site by " . $_SESSION['email'],  "From: ".$_SESSION['email']);
                //echo "Your message has been sent<br>$fav_email by ". $_SESSION['email'];
            }
            break;
        }
        // }
        //if (isset($data2)) {
        echo '<button type="submit" name="add" style="background-color:black;color:white;border-color: yellow;">Add</button><br><br>';
        //break;
        // }
        ?>

    </form>
</center>

<!-- footer -->
<?php
require_once 'footer.php';
?>

