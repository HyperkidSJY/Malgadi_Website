<?php
include '../dbConnect/config.php';
session_start();
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)){
    header("location: ../authorize.php");
    exit();
}
if(isset($_POST['review'])){
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_SESSION['fname'] .' '.$_SESSION['lname'];
    $email = $_SESSION['email'];
    $message = $_POST['message'];
  
    $sql = "INSERT INTO `reviews` (`name`, `email`, `message`) VALUES('$name','$email','$message')";
    $result = mysqli_query($link,$sql);
    if($result){
      echo '<script>alert("Review Submitted");</script>';
    }else{
      echo '<script>alert("Review not Submitted");</script>';
  
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Review Us</title>
    <link rel="stylesheet" href="./css/contact.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <style>
    .form{
        grid-template-columns: repeat(1,1fr);
    }
    .contact-info{
        display: none;
    }
    .container{
        min-height: 65px;
    }
  </style>
  <body>
  <?php require '../includes/bk-nav.php'; ?>
    <div class="container">
      <div class="form">
        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" autocomplete="off">
            <h3 class="title">Write a Review!</h3>
            <div class="input-container textarea">
              <textarea name="message" class="input" required></textarea>
              <label for="">✏️Write your review...</label>
              <span>✏️Write your review...</span>
            </div>
            <input type="submit" name="review" value="Send" class="btn">
          </form>
        </div>
      </div>
    </div>
    <?php include "../includes/bk-footer.php" ?>
    <script src="./js/contact.js"></script>
  </body>
</html>