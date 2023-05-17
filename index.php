<?php 
include ('./dbConnect/config.php');
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $fname = $_SESSION['fname'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Salsa&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Thasadith&display=swap"rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Forum&display=swap"rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Macondo&display=swap"rel="stylesheet">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Malgadi</title>
    <link rel="stylesheet" href="./css/home.css">
  </head>
  <body>
    <div class="ho-container">
      <div class="ho-navbar">
        <div class="logo-head">
          <img src="./photos/home-logo.png" class="logo"><p>Malgadi</p>
        </div>
        <ul>
          <li><a href="about.php">About</a></li>
          <li><a href="./social/">Social Innovation</a></li>
          <li><a href="./team/">Team</a></li>
        </ul>
        <div class="credentials">
          <?php
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                  $user_display = $_SESSION['fname'];
                  echo '<a href="logout.php">Log Out</a>';
                  echo '<i class="fa fa-user" aria-hidden="true"></i>';
                  echo "<p>$user_display</p>";
                }
                else{
                  echo '<a href="authorize.php">Login/SignUp</a>';
                }
              ?>     
          <!-- <a href="authorize.php">Login/SignUp</a> -->
        </div>
      </div>
      <div class="ho-content">
        <h1>YOU DEMAND WE DELIVER</h1>
        <p>
          Get electronics and books at lowest rates as compared to market rates.
        </p>
        <div class="btns-home">
          <a href="./electronics/"><button type="button"><span></span>ELECTRONICS</button></a>
          <a href="./books/"><button type="button"><span></span>BOOKS</button></a>
        </div>
        
      </div>
    </div>
  </body>
</html>
