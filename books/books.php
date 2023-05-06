<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Malgadi</title>
    <link rel="stylesheet" href="./css/electronics.css">
    <!-- <link rel="stylesheet" href="../css/loader.css"> -->
    
</head>
<body>
    <?php
    require '../includes/bk-nav.php'; ?>
    <!-- <div class="ec-loader">
    </div> -->
    <div id="container" class="v-class">
        <div id="homeCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#homeCarousel" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block single c1" src="photos/1.png" alt="First slide">
                    <div class="carousel-caption d-md-block caption-1">
                        <h2>Malgadi<br>Books</h2> 
                        <p class="motto"><i>You Demand, We Deliver</i></p> 
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block single c2" src="./photos/4.png" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block caption-2">
                        
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#homeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#homeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div><br>
    <p id="message"></p>
    <div class="cards-container">
        <?php 
            $sql = 'SELECT * FROM books WHERE homepage=1';
            include("./includes/cards.php");?>

    <?php include "../includes/bk-footer.php" ?>
    <!-- Script for scroll top and page loader  -->
    <script src="../js/loader.js"></script>

</body>
</html>