<?php
include '../dbConnect/config.php';
session_start();

if(isset($_SESSION['fname'])){
unset($_SESSION["loggedin"]);
unset($_SESSION["fname"]);
unset($_SESSION["userId"]);

session_unset();
session_destroy();
}
if (isset($_COOKIE["mobile"]) AND isset($_COOKIE["pass"])){
    setcookie("mobile", '', time() - (3600));
    setcookie("pass", '', time() - (3600));
}
echo '<script>confirm("Press Ok to Log Out.");
window.location.href="http://localhost/Malgadi_Merged/home/index.php"; 
</script>';
?>