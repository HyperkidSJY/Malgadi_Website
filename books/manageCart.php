<?php
include '../dbConnect/config.php';?>


<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)){
        echo '<script>window.location.href="http://localhost/Malgadi_Merged/authorize.php";  
        </script>'; 
        exit();
    }
    // For ADD TO CART
    $userId = $_SESSION['userId'];
    $email = $_SESSION['email'];
    if(isset($_POST['addBook'])) {
        $bookId = $_POST["bookId"];
        $image_path = $_POST['path'];
        // Check whether this item exists
        $existSql = "SELECT * FROM `viewcart_books` WHERE `bookId` = '$bookId' AND `userId`='$userId'";
        $result = mysqli_query($link, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Book already added in Cart</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
        // If not added then add to cart.
        else{
            $sql = "INSERT INTO `viewcart_books` (`bookId`, `userId`,`image_path`, `bookQuantity`) VALUES ('$bookId', '$userId','$image_path', '1')";   
            $result = mysqli_query($link, $sql);
            if ($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Book added in Cart</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        }
    }
    // Notifying the User.
    if(isset($_POST['notify'])){
        $bookId = $_POST["bookId"];
        // Check whether notifing request already exists or not.
        $existSql = "SELECT * FROM `notify_books` WHERE `bookId` = '$bookId' AND `email`='$email'";
        $result = mysqli_query($link, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Notify Request is already registered. You will receive an email on your registered email id once the book will be available.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
        // If not then add the request.
        else{
            $sql = "INSERT INTO `notify_books` (`bookId`,`email`) VALUES ('$bookId', '$email')";   
            $result = mysqli_query($link, $sql);
            if ($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thank You. Your Request is registered. You will receive an email on your registered email id once the book will be available.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        }
    }
    // Removing an item from cart.
    if(isset($_POST['removeItem'])) {
        $bookId = $_POST["bookId"];
        $sql = "DELETE FROM `viewcart_books` WHERE `bookId`='$bookId' AND `userId`='$userId'";   
        $result = mysqli_query($link, $sql);
        echo "<script>
                window.history.back(1);
            </script>";
    }
    // Checkout from cart.
    if(isset($_POST['checkout'])) {
        $userId = $_SESSION['userId'];
        $name = $_SESSION['fname']." ".$_SESSION['lname'];
        $email = $_SESSION['email'];
        $phone = $_SESSION["phone"];
        $address = $_POST["address"];
        $branch = $_POST["branch"];
        $sem = $_POST["sem"];
        $type = $_POST["type"];
        $amount = $_SESSION["amount"];
        $contents = "";
        $sql = "SELECT * FROM `viewcart_books` WHERE userId = $userId";
        $result = mysqli_query($link,$sql);
        $rows = mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result)){
            $contents = $contents . $row['bookId'] .".". $row['bookQuantity'] . "*";
        }
        $contents = rtrim($contents, "*");
        $sql = "INSERT into orders_books (userId, name, email,mobile, address,branch, semester, amount,contents, type) VALUES('$userId','$name', '$email', '$phone', '$address', '$branch', '$sem', '$amount', '$contents', '$type')";
        $result = mysqli_query($link,$sql);
        $orderId = $link->insert_id;

        // Incrementing Order Stats.
        $month=date('M').date('y');
        $exists=0;    
        $st = 'SELECT * FROM stats_bk';
        $r = mysqli_query($link, $st);
        while($row = mysqli_fetch_assoc($r)){
            if($row['month'] == $month){
                $exists = 1;
                break;
            }
        }
        if($exists){
            $statement ="SELECT * FROM stats_bk WHERE month = '$month'";
            $res = mysqli_query($link,$statement);
            $row = mysqli_fetch_assoc($res);
            $orderCount = $row['orders'];
            $orderCount++;        
            $statement = "UPDATE stats_bk SET orders=$orderCount WHERE month = '$month'";
            $res = mysqli_query($link,$statement);
        }else {    
            $statement = "INSERT INTO stats_bk(month, orders) VALUES('$month', 1)";
            $res = mysqli_query($link,$statement);
        }
        if($result){
            $sql = "DELETE FROM `viewcart_books` WHERE `userId`='$userId'";
            $result = mysqli_query($link,$sql);
            unset($_SESSION['amount']);
            echo '<script>alert("Thanks for ordering with us. Your order id is ' .$orderId. '.");
            window.location.href="http://localhost/Malgadi_Merged/books/orders.php";  
            </script>';
            exit();
        }
    }
    //Change Quantity
    if(isset($_POST['quantity']))
    {
        $bookId = $_POST['bookId'];
        $qty = $_POST['quantity'];
        echo $bookId;
        $updatesql = "UPDATE `viewcart_books` SET `bookQuantity`='$qty' WHERE `bookId`='$bookId' AND `userId`='$userId'";
        $updateresult = mysqli_query($link, $updatesql);
    }
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
    // Updating Cart Items number
    if(isset($_GET['cartUpdate'])){
        session_start();
        if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)){
            echo "0"; 
        }
        else{
            $userId = $_SESSION['userId'];
            $sql = "SELECT * FROM `viewcart_books` WHERE userId = '$userId'";
            $result = mysqli_query($link,$sql);
            $cart_quantity = mysqli_num_rows($result);
            if($result){
                echo $cart_quantity; 
            }
        }
    }
}
?>