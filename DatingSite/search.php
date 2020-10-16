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
        <link rel="stylesheet" href="assets/css/search.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Search</title>
    </head>

    <body>

    <center>

        <h1 class="heading">Search Members</h1>

        <!-- search form -->
        <form action="search.php" method="POST">
            <input type="text" name="query" placeholder="Search by name or email" />
            <input type="submit" value="Search" name="search" />
        </form>
    </center>

</body>
</html>

<!-- display user which are search by user -->
<?php
if (isset($_POST['search'])) {
    echo '<center>';
    echo '<br><br>';
    echo '<label><a href="index.php">See all Profiles</a></label><br><br>';
    if (isset($_POST['query']) && !empty($_POST['query'])) {
        $search = $_POST['query'];
        $query = $conn->prepare("select * from users where name LIKE '%$search%' OR email LIKE '%$search%'  LIMIT 0 , 10");
        $query->bindValue(1, "%$search%", PDO::PARAM_STR);
        $query->execute();
        // Display search result

        if (!$query->rowCount() == 0) {
            echo "Search found :<br/><br>";

            while ($results = $query->fetch()) {
                echo '<img src="' . $results['picture'] . '" height="26%" width="26%" alt="' . $results['name'] . '"/><br>';
                echo '<label><b>Name: </b>' . $results['name'] . '</label><br><br><br><br>';
            }
        } else {
            echo 'No results found!';
        }
    } else {
        echo 'Enter something to search!';
    }
    echo '</center>';
}
?>

<!-- footer -->
<?php
require_once "footer.php";
?>