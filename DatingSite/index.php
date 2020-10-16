<!-- header -->
<?php
require_once "header.php";
?>

<!-- session start and and configuration with database -->
<?php
session_start();
require_once "config.php";

// get userid of user
if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
    $data = $conn->query("SELECT * FROM `users` WHERE userid=$id")->fetchAll();
    //echo $id;
    foreach ($data as $row) {
        $name = $row['name'];
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
        <link rel="stylesheet" href="assets/css/home.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Home</title>
    </head>

    <body>

    <center>

        <h1 class="heading">Know Each Other</h1>

        <!-- form for search members -->
        <form action="search.php" method="POST">
            <input type="text" name="query" placeholder="Search by name or email"/>
            <input type="submit" value="Search" name="search"/>
        </form>
        <br><br>

        <div>
            <!-- fetch all users and display their information and can be add to favorite list by user -->
            <?php $data = $conn->query("SELECT * FROM `users`")->fetchAll(); ?>
            <div>
                <?php foreach ($data as $row) {
                    ?>
                    <div class="container">
                        <img class="image" src="<?php echo $row['picture']; ?>" height="16%" width="16%" alt="<?php echo $row['name']; ?>"/><br>
                        <div class="middle">
                            <a href="add_favorite.php?userid=<?php echo $row['userid'] ?>""><div class="text">Add to Favorite</div></a>
                        </div>
                    </div>    

                    <label><?php echo '<b>Name: </b>' . $row['name']; ?></label><br><br><br><br>
                    <?php
                }
                ?>
            </div>
    </center>
</body>
</html>

<!-- footer -->
<?php
require_once "footer.php";
?>
