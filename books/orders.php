<?php
include '../dbConnect/config.php';
session_start();
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
    echo '<script>window.location.href="http://localhost/Malgadi_Merged/authorize.php";  
        </script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<style>
    .order-heading{
        display: flex;
        align-items: center;
        padding: 5px;
        justify-content: space-between;
    }
    .order-heading i{
        font-size: 1.5rem;
    }
    .card{
        cursor: pointer;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }
</style>
<body>
    <?php include("../includes/bk-nav.php"); ?>
    <center>
        <h3 class="m-4">Your Orders</h3>
    </center>
    <?php
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM orders WHERE userId = $userId";
    $result = mysqli_query($link, $sql);
    $rows = mysqli_num_rows($result);
    if($rows==0){
       echo '<center><div>
            <p class="text-black"> You have not ordered anything yet.<p>
            <a href="showCart.php"><button class="btn btn-primary">Go to Cart</button></a>
        </div></center>';
        exit();
    }
    $c = 0; ?>
    <div class="accordion container" id="accordionExample">
    <?php while ($row = mysqli_fetch_assoc($result)) { 
        $contents='';
        $contentArray = explode("*", $row['contents']);
        for($i = 0; $i < sizeof($contentArray) ;$i++){

            $contentArray[$i] = explode(".", $contentArray[$i]);
            $s = "SELECT `fullName` FROM items WHERE `itemId`=".$contentArray[$i][0]."";
            $res = mysqli_query($link,$s);
            $row2 = mysqli_fetch_assoc($res);
            $contents .= $row2['fullName']." <b>X ".$contentArray[$i][1]."</b><br>";
        }
        ?>
        <div class="card">
            <!-- Heading  -->
            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne<?php echo $c ?>" aria-expanded="true" aria-controls="collapseOne">
                <div class="order-heading">
                    <b><?php echo $c+1; ?>.</b>
                    Order <?php echo $row['status'].' '.'on'.' '. $row['d_date']; ?>
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
            <!-- Order body  -->
            <div id="collapseOne<?php echo $c ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><b>Placed on:&nbsp;</b><?php echo $row['date']; ?></li>
                        <li class="list-group-item"><b>Email :&nbsp;</b><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></li>
                        <li class="list-group-item"><b>Phone :&nbsp;</b><a href="tel:<?php echo $row['mobile']; ?>"><?php echo $row['mobile']; ?></a></li>
                        <li class="list-group-item"><b>Address :&nbsp;</b><br><?php echo $row['address']; ?></li>
                        <li class="list-group-item"><b>Br/Sem :&nbsp;</b><?php echo $row['branch']; ?>/<?php echo $row['semester']; ?></li>
                        <li class="list-group-item"><b>Contents :&nbsp;</b><br><?php echo $contents; ?></li>
                        <li class="list-group-item"><b>Amount :&nbsp;</b>Rs. <?php echo $row['amount']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php $c++; } ?>
    </div><br><br><br>
    <?php include("../includes/bk-footer.php"); ?>
</body>

</html>