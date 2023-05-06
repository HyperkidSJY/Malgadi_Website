<?php include("../dbConnect/config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/cards.css">
</head>
<body>
        <?php
        $result = mysqli_query($link,$sql);
        $rows = mysqli_num_rows($result);
        $c = 0;
        while($row = mysqli_fetch_assoc($result)){
            $bookId = $row['bookId'];
            $sql = "SELECT * from bookimage WHERE bookId=$bookId";
            $res = mysqli_query($link,$sql);
            $img_count = $row['imageCount'];
            $path_info = mysqli_fetch_all($res);
            $path = $path_info[$img_count-1][2];
            $discount = ceil((($row['originalPrice']-$row['sellingPrice'])/$row['originalPrice'])*100);
            // Item Card
            echo '<div class="card" data-toggle="modal" data-target="#exampleModalCenter'.''.$c.'">
                <div class="card-image">
                    <img src="./manage/'.$path.'" alt="">
                </div>
                <div class="card-details">
                    <h5 class="item-name">'.$row['name'].'</h5>
                    <div class="item-prices">
                        <p class="item-sp">₹'.$row['sellingPrice'].'</p>
                        <p class="item-op">₹'.$row['originalPrice'].'</p>
                    </div>
                    <p class="item-discount">'.$discount.'% off</p>
                </div>';
                echo '<form action="" class="form-submit">';
                echo '<input type="hidden" class="path" value="'.$path.'">' ;
                echo '<input type="hidden" class="bookId" value="'.$bookId.'">' ;
                if($row['stockStatus']){
                        echo '<button type="button" id="addBook" class="item-atoc">ADD TO CART</button>';
                    }else{
                        echo '<button type="button" id="notify" class="item-notify">NOTIFY ME</button>';
                    }
                echo '</form>';
            echo '</div>';
            // Card Model
            echo '<div class="modal fade" id="exampleModalCenter'.''.$c.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">'.$row['name'].'</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div id="cardCarousel'.''.$c.'" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">';
                        $k = 0;
                        while($k<$img_count){?>
                            <li data-target="#cardCarousel<?php echo $c?>" data-slide-to="<?php echo $k?>" class="<?php if($k==0){echo 'active';}?>"></li>
                            <?php $k++; ?>
                            <?php } 
                       echo '</ol>
                        <div class="carousel-inner">';
                        $k = 0;
                        while($k<$img_count){?>
                            <div class="carousel-item <?php if($k==0){echo 'active';}?>">
                                    <img class="d-block" src="./manage/<?php echo $path_info[$k][2];?>" alt="First slide">
                            </div>
                               <?php $k++; ?>
                        <?php }   
                        echo '</div>';
                        if($img_count>1){?>
                            <a class="carousel-control-prev" href="#cardCarousel<?php echo $c?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#cardCarousel<?php echo $c?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php }
                        echo '</div>';
                        echo '<div class="modal-details">
                            <div class="item-prices-modal">
                                <h5>Price: </h5>
                                <p class="item-sp">₹'.$row['sellingPrice'].'</p>
                                <p class="item-op">₹'.$row['originalPrice'].'</p>
                            </div>
                            <p class="item-discount">'.$discount.'% off</p>';?>
                        <!-- Description  -->
                      <?php if($row['description']!="-"){?>
                            <h5>Description: </h5><hr>
                            <p><?php echo $row['description']?></p>
                      <?php }?>  
                      </div>  
                </div>
                <div class="modal-footer">
                    <?php 
                        if($row['stockStatus']){
                            echo '<p class="text-success"><i>In stock</i></p>';
                        }else{
                            echo '<p class="text-danger"><i>Out of stock</i></p>';
                        }
                    ?>               
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="" class="form-submit">
                        <input type="hidden" class="path" value="<?php echo $path ?>">
                        <input type="hidden" class="bookId" value="<?php echo $bookId ?>">
                        <?php if($row['stockStatus']){
                            echo '<button type="button" id="addBook" class="btn btn-success">ADD TO CART</button>';
                        }else{
                            echo '<button type="button" id="notify" class="btn btn-info">NOTIFY ME</button>';
                        }
                    echo '</form>';?>
                 
                    
                </div>
              </div>
            </div>
          </div>
          <?php
          $c++;
            }?>
            </div>
    <p id="message"></p>
    <a href="showCart.php"><button class="toCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge badge-danger"></span></button></a>
    <!-- FUNCTIONS USING AJAX TO ADD AND NOTIFY  -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Send product details in the server
            $(document).on("click", "#addBook", function(e) {
                e.stopPropagation();
                var $form = $(this).closest(".form-submit");
                var path = $form.find(".path").val();
                var bookId = parseInt($form.find(".bookId").val());
                console.log(bookId);
                console.log(path);
                $.ajax({
                    url: 'manageCart.php',
                    method: 'post',
                    data: {
                        addBook : true,
                        path : path,
                        bookId : bookId
                    },
                    success: function(response){
                        $('#message').html(response);
                        load_cart_item_number();
                    }
                });
            });
            $(document).on("click", "#notify", function(e) {
                e.stopPropagation();
                var $form = $(this).closest(".form-submit");
                var bookId = parseInt($form.find(".bookId").val());
                $.ajax({
                    url: 'manageCart.php',
                    method: 'post',
                    data: {
                        notify : true,
                        bookId : bookId
                    },
                    success: function(response){
                        $('#message').html(response);
                    }
                });
            });
            load_cart_item_number();
            // Function to update no. of cart items 
               function load_cart_item_number(){
                   $.ajax({
                       url : 'manageCart.php',
                       method : 'get',
                       data : {
                           cartUpdate : true
                       },
                       success : function(response){
                            $(".badge").html(response);
                        }
                   });
               }
        });
    </script>
</body>
</html>