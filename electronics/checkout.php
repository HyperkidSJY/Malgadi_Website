<?php
include '../dbConnect/config.php';
session_start();
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)){
    echo '<script>window.location.href="http://localhost/Malgadi_Merged/authorize.php";  
    </script>'; 
    exit();
} ?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | MyFoodKart</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="phone.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@600&family=Bree+Serif&family=Lobster&family=Tapestry&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/checkout.css">
</head>

<body>
    <?php include("../includes/ec-nav.php"); ?>
    <?php 
        $userId = $_SESSION['userId'];
        $sql = "SELECT * FROM orders WHERE userId = '$userId' ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)==1){
            $address = $row['address'];
            $branch = $row['branch'];
            $sem = $row['semester'];
        }else{
            $address = '';
        }
    ?>
    <!-- Checkout Modal -->
    <div id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModal" aria-hidden="true">
        <br>
        <h2>Enter Your Details:</h2><br>
        <div>
            <form action="manageCart.php" method="post">
                <!-- <b><label for="address">Address:</label></b> -->
                <input name="address" placeholder="Address" type="text" value="<?php echo $address?>" required minlength="3" maxlength="500">
                <div>
                    <select name="branch" id="branch" required>
                        <option value="0" selected>Select Branch</option>
                        <option value="EC">E.C</option>
                        <option value="MH">M.H</option>
                        <option value="CE">C.E</option>
                        <option value="IT">I.T</option>
                        <option value="CH">C.H</option>
                        <option value="CIVIL">Civil</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <select name="sem" id="sem" required>
                        <option value="0" selected>Select Semester</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
                
                <div class="btns">
                    <a href="showCart.php"><button type="button" data-dismiss="modal" class="last-btns">Cancel Order</button></a>
                    <button type="submit" name="checkout" class="last-btns">Confirm Order</button>
                </div>
            </form>
        </div>
    </div>
    <?php include("../includes/ec-footer.php"); ?>
</body>

</html>