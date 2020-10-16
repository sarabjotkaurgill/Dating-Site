<!-- header -->
<?php
require_once "header.php";
?>

<!-- session start and configuration with database -->
<?php
session_start();
require_once "config.php";
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

        <h1 class="heading">Favorites</h1>

        <div>
            <!-- using favorite table from database get favorite list of user -->
            <?php 
            $id = $_SESSION['userid'];
            $data = $conn->query("SELECT * 
            FROM favorite INNER JOIN 
            users ON `users`.`userid`=`favorite`.`favoriteid` 
            WHERE `favorite`.`userid`= $id")->fetchAll();
            ?>
            <div>
                <?php foreach ($data as $row) {
                    ?>
                    <div class="container">
                        <img class="image" src="<?php echo $row['picture']; ?>" height="26%" width="26%" alt="<?php echo $row['name']; ?>"/><br>
                        <div class="middle">
                            <a href="remove_favorite.php?userid=<?php echo $row['userid'] ?>""><div class="text">Remove from Favorite</div></a>
                        </div>
                    </div>    

                    <label><?php echo '<b>Name: </b>' . $row['name']; ?></label><br><br><br><br>
                    <?php
                }
                ?>
    </center>

   </body>
</html>

<!-- footer -->
<?php
require_once "footer.php";
?>
