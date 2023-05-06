<?php
include '../dbConnect/config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $itemName = $_POST["itemName"];
  $itemQuntity = $_POST["itemQuantity"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $sql = "INSERT INTO `special_order` (`itemName`,`itemQuantity` , `address`,`phoneNo`) VALUES ('$itemName','$itemQuntity', '$address','$phone')";
  $result = mysqli_query($link, $sql);
  if ($result) {
    echo "<script>alert('Order placed successfully');
                window.history.back(1);
                </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Special Order</title>
  <link rel="stylesheet" href="./css/contact.css" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>
<style>
  .container{
    min-height: 0;
  }
</style>
<body>
  <?php require '../includes/bk-nav.php'; ?>
  <div class="container">
    <div class="form">
      <div class="contact-info">
        <h3 class="title">Special Order is For..</h3>
        <p class="text">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis soluta, quaerat sit vero saepe veniam, nesciunt ab tempore porro itaque maxime, fugiat atque possimus quia quas nisi doloremque ipsa est.
        </p>
      </div>
      <div class="contact-form">
        <span class="circle one"></span>
        <span class="circle two"></span>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" autocomplete="off">
          <h3 class="title">Order any item</h3>
          <div class="input-container">
            <input type="text" name="itemName" class="input" required/>
            <label for="">Item name</label>
            <span>Item name</span>
          </div>
          <div class="input-container">
            <input type="text" name="itemQuantity" class="input" required />
            <label for="">Item Quantity</label>
            <span>Item Quantity</span>
          </div>
          <div class="input-container">
            <input type="tel" name="phone" class="input" required minlength="10" maxlength="10"/>
            <label for="">Phone No.</label>
            <span>Phone No.</span>
          </div>
          <div class="input-container">
            <input type="text" name="address" class="input" required  />
            <label for="">Address</label>
            <span>Address</span>
          </div>
          <input type="submit" value="Send" class="btn" />
        </form>
      </div>
    </div>
  </div>
  <?php include "../includes/bk-footer.php" ?>
  <script src="./js/contact.js"></script>
</body>

</html>