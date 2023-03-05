<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reviews</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="./css/reviews.css">
</head>

<body>
  <?php include("../dbConnect/config.php");
  include("../includes/nav.php");
  ?>
  <div class="container">
    <div class="board">
      <h2 class="text-light">Word form our customers</h2>
      <p class="text-light">Some of the fullfilled costomers reviews</p>

      <!-- Slider main container -->
      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <?php
          $sql = "SELECT * FROM reviews where visibility=1";
          $result = mysqli_query($link, $sql);
          while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="swiper-slide">
              <div class="flex">
                <div class="comments">
                  <?php echo $row['message']; ?>
                  <div class="profile">
                  <p><i>- <?php echo $row['name']; ?></i></p>
                </div>
                </div>
                
              </div>
            </div>
          <?php } ?>

        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
        <a href="review.php" class="review">Leave Us a Review</a><br>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

      </div>

    </div>
  </div>
  <?php include("../includes/ec-footer.php"); ?>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script src="./js/reviews.js"></script>
</body>

</html>