<?php 
include '../dbConnect/config.php';
session_start();
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)){
    echo '<script>window.location.href="../authorize.php";  
    </script>'; 
    exit();
}
$userId = $_SESSION['userId'];
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart </title>
    <link rel="stylesheet" href="./css/showCart.css">
</head>
<body>
    <?php include("../includes/bk-nav.php") ?>
    <div class="cart-container">
        <div class="item-container">
            <?php
            $sql = "SELECT * FROM `viewcart_books` WHERE `userId`= $userId";
            $result = mysqli_query($link, $sql);
            $counter = 0;
            $totalPrice = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $bookId = $row['bookId'];
                $Quantity = $row['bookQuantity'];
                $image_path = $row['image_path'];
                $mysql = "SELECT * FROM `books` WHERE bookId = $bookId";
                $myresult = mysqli_query($link, $mysql);
                $myrow = mysqli_fetch_assoc($myresult);
                $discount = ceil((($myrow['originalPrice']-$myrow['sellingPrice'])/$myrow['originalPrice'])*100);
                $bookName = $myrow['name'];
                $bookPrice = $myrow['sellingPrice'];
                $total = $bookPrice * $Quantity;
                $counter++;
                $totalPrice = $totalPrice + $total;
                $_SESSION['amount'] = $totalPrice;
                ?>
            <div class="single-item">
                <div class="image">
                    <img src="./manage/<?php echo $image_path ?>" alt="">
                </div>
                <div class="details">
                    <h5 class="item-name"><?php echo $myrow['name'] ?></h5>
                    <div class="item-prices">
                        <p class="item-sp">₹<?php echo $myrow['sellingPrice'] ?></p>
                        <p class="item-op">₹<?php echo $myrow['originalPrice'] ?></p>
                        <p class="item-discount"><?php echo $discount?>% off</p>
                    </div>
                    <div class="quantity">
                        <form id="frm<?php echo $bookId; ?>">
                            <input type="hidden" id="bookId" name="bookId" value="<?php echo $bookId; ?>">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field=""><i class="fa fa-minus"></i></button>
                            <input type="text" id="quantity" name="quantity" onchange="updateCart(<?php echo $bookId; ?>)" value="<?php echo $row['bookQuantity']?>">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field=""><i class="fa fa-plus"></i></button>
                        </form>
                    </div>
                    <div class="general">
                        <form action="manageCart.php" method="POST">
                            <input type="hidden" id="bookId" name="bookId" value="<?php echo $bookId; ?>">
                            <button class="remove" name="removeItem">Remove</button>
                            <p>Total: ₹<?php echo $total ?></p>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <?php } ?>
            <?php if($counter !=0){ ?>
                <div class="check-out-div">
                    <h5>₹ <?php echo $totalPrice ?></h5>
                    <a href="checkout.php"><button class="check-out"><b>CHECK OUT</b></button></a>
                </div>
            <?php } else{ ?>
                <center>
                    <h5>Your Cart is empty!</h5>
                    <a href="../books/books.php"><button class="btn btn-success">Continue Shopping</button></a>
                </center>

            <?php } ?>
        </div>
        <?php if($counter !=0){ ?>
        <div class="price-container">
            <h4>Order summary</h4><hr>
            <div>
                <div>
                    <h6>Total Price</h6>
                    <h6>₹<?php echo $totalPrice ?></h6>
                </div>
                <div>
                    <h6>Delivery Charges</h6>
                    <h6 class="text-success">Free</h6>
                </div><hr>
                <div>
                    <h5>Grand Total</h5>
                    <h6>₹<?php echo $totalPrice ?></h6>
                </div>
            </div>
            <div class="payments">
                <input type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                <label for="flexRadioDefault1">Cash On Delivery</label>
                <input type="radio" name="flexRadioDefault1" id="flexRadioDefault1" disabled>
                <label for="flexRadioDefault1">Online Payment</label>
                <p class="disabled">(Online Payments are temporarily Disabled)</p>
            </div>
        </div> <?php } ?>
    </div>
    <?php include("../includes/bk-footer.php") ?>
   <script>
        function updateCart(id) {
                console.log("ENTER");
                $.ajax({
                    url: 'manageCart.php',
                    type: 'POST',
                    data: $("#frm" + id).serialize(),
                    success: function(res) {
                        location.reload();
                    }
                })
            }
        $(document).ready(function(){
            var quantitiy=0;
            $('.quantity-right-plus').click(function(e){
                var $div = $(this).closest(".quantity");
                var bookId = $div.find("#bookId").val();
                var quantity = parseInt($div.find("#quantity").val());  
                $div.find("#quantity").val(quantity + 1);
                updateCart(bookId);
            });

            $('.quantity-left-minus').click(function(e){
                var $div = $(this).closest(".quantity");
                var quantity = parseInt($div.find("#quantity").val());  
                var bookId = $div.find("#bookId").val();
                if(quantity>1){
                    $div.find("#quantity").val(quantity - 1);
                    updateCart(bookId);
                }
            });
        });
   </script>
</body>
</html>