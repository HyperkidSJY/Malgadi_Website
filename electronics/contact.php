<?php
include '../dbConnect/config.php';
session_start();
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)){
    header("location: ../authorize.php");
    exit();
}
if(isset($_POST['contact'])){
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
  
    $sql = "INSERT INTO `contact` (`name`, `email`,`phone`,`message`) VALUES('$name','$email','$phone','$message')";
    $result = mysqli_query($link,$sql);
    if($result){
      echo '<script>alert("Message received! We will shortly contact you.");
      window.history.back();
      </script>';
    }else{
      echo '<script>alert("Message not received. Try again");
      window.history.back();
      </script>';
  
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact From</title>
    <link rel="stylesheet" href="./css/contact.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
  <?php require '../includes/nav.php'; ?>
    <div class="container">
      <div class="form">
        <div class="contact-info">
          <h3 class="title">How can we help?</h3>
          <p class="text">
            We're here to help and answer any question you might have. We look
            forward to hearing from you!!
          </p>

          <div class="info">
            <div class="information">
              <img src="./photos/location.png" class="icon" alt="" />
              <p>Dharmsinh Desai University, Nadiad</p>
            </div>
            <div class="information">
              <img src="./photos/email.png" class="icon" alt="" />
              <p>malgadi.in</p>
            </div>
            <div class="information">
              <img src="./photos/phone.png" class="icon" alt="" />
              <p>123-456-789</p>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" autocomplete="off">
            <h3 class="title">Send us a message!</h3>
            <div class="input-container">
              <input type="text" name="name" class="input" />
              <label for="">Your name</label>
              <span>Your name</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" />
              <label for="">✉️Email-ID</label>
              <span>✉️Email-ID</span>
            </div>
            <div class="input-container">
              <input type="tel" name="phone" class="input" />
              <label for="">📞Phone No.</label>
              <span>📞Phone No.</span>
            </div>
            <div class="input-container textarea">
              <textarea name="message" class="input"></textarea>
              <label for="">✏️Write us a message...</label>
              <span>✏️Write us a message...</span>
            </div>
            <input type="submit" name="contact" value="Send" class="btn" />
          </form>
        </div>
      </div>
    </div>
    <?php include "../includes/ec-footer.php" ?>
    <script src="./js/contact.js"></script>
  </body>
</html>
