<?php
include("../../dbConnect/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $fullName = $_POST['fullName'];
        $shortName = $_POST['shortName'];
        $originalPrice = $_POST['originalPrice'];
        $sellingPrice = $_POST['sellingPrice'];
        $category = $_POST['category'];
        $tags = $_POST['tags'];
        $description = $_POST['description'];
        $specifications = $_POST['specifications'];
        $kitcontents = $_POST['kitContents'];
        $fileNames = array_filter($_FILES['files']['name']);
        $imageCount = count($fileNames);
        if (!empty($fileNames)) {
            $count = 0;
            foreach ($_FILES['files']['name'] as $key => $val) {
                // File upload path 
                $ext = pathinfo($_FILES["files"]["name"][$key], PATHINFO_EXTENSION);
                $targetDir = "item_images/";
                $basename = $shortName . "-" . uniqid();
                $filename = $basename . "." . $ext;
                $targetFilePath = $targetDir . $filename;
                $filesize = $_FILES["files"]["size"][$key];
                if (($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'png')) {
                    // Validate file size - 50MB maximum
                    $maxsize = 50 * 1024 * 1024;
                    if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit of 50MB");

                    // Validate type of the file
                    // Check whether file exists before uploading it
                    if (file_exists("electronics/item_images/" . $filename)) {
                        echo $filename . " is already exists.";
                    } else {
                        if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                            // Adding item to items database only once.
                            if ($count == 0) {
                                $sql = "INSERT INTO items (`fullName`,`shortName`, `originalPrice`, `sellingPrice`, `description`, `specifications`, `kitContents`, `category`, `tags`, `imageCount`) VALUES('$fullName', '$shortName', '$originalPrice','$sellingPrice', '$description', '$specifications', '$kitcontents', '$category','$tags','$imageCount')";

                                $result = mysqli_query($link, $sql);
                                // Seaarching recent added item and storing its id.
                                $sql = "SELECT * FROM items where fullName= '$fullName' and shortName='$shortName'";
                                $result = mysqli_query($link, $sql);
                                // Storing ID for adding path of images in another table
                                $row = mysqli_fetch_assoc($result);
                                $itemId = $row['itemId'];
                                $count++;
                            }
                            // uploading image path
                            $filepath = "item_images/" . $filename;
                            $sql = "INSERT INTO itemimage (`itemId`,`path`) VALUES($itemId,'$filepath')";

                            mysqli_query($link, $sql);
                            // for detecting whether the item is correctly added.
                            $flag = 1;
                        } else {
                            echo '<script>alert("Your File is not uploaded.");
                                window.history.back(1); 
                                </script>';
                        }
                    }
                } else {
                    echo '<script>alert("Please select a proper file format");
                                window.history.back(1); 
                                </script>';
                }
            }
            if ($flag == 1) {
                echo '<script>alert("Success");
                    window.location.href="http://localhost/Malgadi_Merged/electronics/manage/new_item.php";
                    </script>';
            }
        } else {
            echo '<script>alert("Please select a file to submit");
                                window.history.back(1); 
                                </script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Item</title>
</head>

<body>
    <form action="new_item.php" method="post" enctype="multipart/form-data">
        <input id="fullName" type="text" name="fullName" placeholder="Full Name" required><br>
        <input id="shortName" type="text" name="shortName" placeholder="Short Name" required><br>
        <input id="originalPrice" type="text" name="originalPrice" placeholder="OP" required><br>
        <input id="sellingPrice" type="text" name="sellingPrice" placeholder="SP" required><br>
        <label>Category*</label>
        <select class="browser-default" name="category" required>
            <option value="" disabled selected>Choose your option</option>
            <option value="Basic Components">Basic Components</option>
            <option value="Robotics">Robotics</option>
            <option value="Controllers">Controllers</option>
            <option value="Sensors">Sensors</option>
            <option value="IC">IC</option>
            <option value="Kits">Kits</option>
            <option value="EG Kits">EG Kits</option>
        </select><br>
        <textarea id="description" name="description" placeholder="DES" required></textarea><br>
        <textarea id="specifications" name="specifications" placeholder="SPEC" required></textarea><br>
        <textarea id="kitContents" name="kitContents" placeholder="KIT CON" required></textarea><br>

        <textarea id="tags" type="text" name="tags" placeholder="tags" required></textarea><br>
        <input type="file" name="files[]" multiple>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>

</html>