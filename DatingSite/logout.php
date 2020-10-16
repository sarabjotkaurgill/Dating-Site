<!-- session destroy to logout of user -->
<?php
session_start();  
session_destroy();  
header("location:login.php");  
?>

