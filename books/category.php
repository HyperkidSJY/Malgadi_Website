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
    h2{
        text-align: center;
        padding-block: 20px;
        margin: 0 !important;
    }
</style>
<body>
    <?php 
        include "../includes/bk-nav.php";
        $category = $_GET['q'];
    ?>
    
    <h2><?php echo $category;?></h2>
    <div class="cards-container">
        <?php 
            function filterStringBasic($string){
                return trim(addslashes(htmlspecialchars($string)));
            }
        
        $sql = 'SELECT * FROM items WHERE category= "'.$category.'"';
        include "./includes/cards.php";
        ?>
            
    </div>
    <?php include "../includes/bk-footer.php" ?>
</body>
</html>