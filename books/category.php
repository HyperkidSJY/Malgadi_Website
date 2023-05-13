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
        $display= "Select Semester";
        if(isset(($_GET['sem']))){
            $sem = $_GET['sem'];
            $display = "Semester-".$sem;
        }
    ?>
    <h2><?php echo $category; if(isset(($_GET['sem']))){ echo " Sem-".$_GET['sem']; } else echo ""?></h2>
    <center><form action="" method="get">
        <select class="p-1 px-2 mb-2" name="sem" id="sem" onchange="this.form.submit()" required>
            <option value="0" selected><?php echo $display?></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
        <input type="hidden" name="q" value="<?php echo $category?>">
    </form></center>
    <div class="cards-container">
        <?php 
            function filterStringBasic($string){
                return trim(addslashes(htmlspecialchars($string)));
            }
            if(isset(($_GET['sem']))){
                $sem = $_GET['sem'];
                $sql = 'SELECT * FROM books WHERE branch= "'.$category.'" AND semester="'.$sem.'"';
            }else{
                $sql = 'SELECT * FROM books WHERE branch= "'.$category.'"';
            }
            include "./includes/cards.php";
        ?>
            
    </div>
    <?php include "../includes/bk-footer.php" ?>
</body>
</html>