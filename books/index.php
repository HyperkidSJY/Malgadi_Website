<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Malgadi</title>
    <link rel="stylesheet" href="./css/electronics.css">
    <link rel="stylesheet" href="../css/loader.css">
    
</head>
<body>
    <?php
    require '../includes/bk-nav.php'; ?>
    <div class="ec-loader">
    </div>
    <div id="container" class="v-class">
        <div id="homeCarousel" class="carousel slide l-carousel" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#homeCarousel" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block single c1" src="./photos/1.png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block single c2" src="./photos/2.png" alt="Second slide">
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
        <div id="homeCarousel-2" class="carousel slide m-carousel" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#homeCarousel-2" data-slide-to="0" class="active"></li>
                <li data-target="#homeCarousel-2" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item m-item active">
                    <img class="d-block single c1" src="./photos/M1.png" alt="First slide">
                </div>
                <div class="carousel-item m-item">
                    <img class="d-block single c2" src="./photos/M2.png" alt="Second slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#homeCarousel-2" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#homeCarousel-2" role="button" data-slide="next">
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