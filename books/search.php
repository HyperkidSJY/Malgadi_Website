<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/cards.css">
</head>

<style>
    .search-heading{
        text-align: center;
        padding-block: 20px;
        margin: 0 !important;
    }
    .no-results{
        display: none;
        padding: 20px 50px;
    }
    .no-results ul{
        padding-left: 30px;
    }
    .no-results ul li{
        list-style: disc;
        padding: 10px;
    }
    .hide{
        display: none;
    }
</style>
<body>
    <?php 
        ob_start();
        include "../includes/bk-nav.php";
        $keywords = "";
        if(isset($_GET['q'])){
            header("electronics.php");
            $keywords = $_GET['q'];
        }else{
        }
        if($keywords ==""){
            header("location: electronics.php");
        }
    ?>
    <h2 class="search-heading">Showing Results for <i><?php echo $keywords;?></i></h2>
    <div class="no-results">
        <hr><br>
        <h3>Try adjusting your search. Here are some ideas:</h3>
        <ul>
            <li>Make sure all words are spelled correctly</li>
            <li>Try different search terms</li>
            <li>Try more general search terms</li>
        </ul>
    </div>
    <div class="cards-container">
        <?php 
            function filterStringBasic($string){
                return trim(addslashes(htmlspecialchars($string)));
            }
        
        $sql = 'SELECT * FROM items WHERE MATCH(tags) AGAINST("'.$keywords.'" IN BOOLEAN MODE)';
        include "./includes/cards.php";
            if($rows == null){?>
                <script>
                    document.addEventListener('DOMContentLoaded', function(){
                        document.querySelector(".search-heading").innerText="No Matches found";
                        document.querySelector(".cards-container").style.display="none";
                    });
                </script>
            <?php
                }
            ?>
            
    </div>
    <?php 
    if($rows==0){?>
    <script>
        document.querySelector(".no-results").style.display="block";
    </script>
    <?php }?>
    <?php include "../includes/bk-footer.php"?>
</body>
</html>