<?php
include("../../dbConnect/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $originalPrice = $_POST['originalPrice'];
        $sellingPrice = $_POST['sellingPrice'];
        $branch = $_POST['branch'];
        $semester = $_POST['semester'];
        $description = $_POST['description'];
        $author = $_POST['author'];
        $fileNames = array_filter($_FILES['files']['name']);
        $imageCount = count($fileNames);
        if (!empty($fileNames)) {
            $count = 0;
            foreach ($_FILES['files']['name'] as $key => $val) {
                // File upload path 
                $ext = pathinfo($_FILES["files"]["name"][$key], PATHINFO_EXTENSION);
                $targetDir = "book_images/";
                $basename = $name . "-" . uniqid();
                $filename = $basename . "." . $ext;
                $targetFilePath = $targetDir . $filename;
                $filesize = $_FILES["files"]["size"][$key];
                if (($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'png')) {
                    // Validate file size - 50MB maximum
                    $maxsize = 50 * 1024 * 1024;
                    if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit of 50MB");

                    // Validate type of the file
                    // Check whether file exists before uploading it
                    if (file_exists("books/item_images/" . $filename)) {
                        echo $filename . " is already exists.";
                    } else {
                        if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                            // Adding item to items database only once.
                            if ($count == 0) {
                                $sql = "INSERT INTO books (`name`,`originalPrice`, `sellingPrice`, `description`, `author`, `branch`, `semester`, `imageCount`) VALUES('$name','$originalPrice','$sellingPrice', '$description', '$author', '$branch', '$semester', '$imageCount')";

                                $result = mysqli_query($link, $sql);
                                // Seaarching recent added item and storing its id.
                                $sql = "SELECT * FROM books where name= '$name'";
                                $result = mysqli_query($link, $sql);
                                // Storing ID for adding path of images in another table
                                $row = mysqli_fetch_assoc($result);
                                $bookId = $row['bookId'];
                                $count++;
                            }
                            // uploading image path
                            $filepath = "book_images/" . $filename;
                            $sql = "INSERT INTO bookimage (`bookId`,`path`) VALUES($bookId,'$filepath')";

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
    <title>New Book</title>
</head>

<body>
    <form action="new_book.php" method="post" enctype="multipart/form-data">
        <input id="name" type="text" name="name" placeholder="Name" required><br>
        <input id="originalPrice" type="text" name="originalPrice" placeholder="OP" required><br>
        <input id="sellingPrice" type="text" name="sellingPrice" placeholder="SP" required><br>
        <label>Branch*</label>
        <select class="browser-default" name="branch" required>
            <option value="" disabled selected>Choose your option</option>
            <option value="CE">CE</option>
            <option value="IT">IT</option>
            <option value="EC">EC</option>
            <option value="MH">MH</option>
            <option value="CH">CH</option>
            <option value="IC">IC</option>
            <option value="CL">CL</option>
        </select><br>
        <label>Semester*</label>
        <select class="browser-default" name="semester" required>
            <option value="" disabled selected>Choose your option</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select><br>
        <textarea id="description" name="description" placeholder="DES" required></textarea><br>
        <input id="author" type="text" name="author" placeholder="Author" required><br>
        <input type="file" name="files[]" multiple><br>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>

</html>