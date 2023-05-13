<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Authenticate | Malgadi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login_signup.css">

</head>

<body>
    
    <?php ob_start(); 
     ?>

    <div class="container">
        <div class="titletext">
            <div class="title login"> Login </div>
            <div class="title signup"> Signup </div>


        </div>
        <div class="formcontainer">
            <div class="slidecontrols">
                <input type="radio" name="slider" id="login" checked>
                <input type="radio" name="slider" id="signup">
                <label for="login" class="slide  login">Login</label>
                <label for="signup" class="slide signup">Signup</label>
                <div class="slidetab"></div>
            </div>


            <div class="forminner">

                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="login">
                    <div class="field">
                        <input type="email" value="<?php if (isset($_COOKIE["email"])){echo $_COOKIE["email"];}?>" placeholder="Email" required name="email" id="email">
                    </div>
                    <div class="field">
                        <input type="password" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" placeholder="Password" required name="password" id="password">
                    </div>
                    <div class="passlink"><a href="#">Forgot Password</a></div>
                    <div class="field">
                        <input type="submit" value="Login" name="login">
                    </div>
                    <div class="signuplink">Not a member?&nbsp;<a href="#">Signup Now</a></div>
                </form>
               
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="signup">

                    <div class="field">
                        <input type="text" placeholder="First Name" required name="fname" id="fname">
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Last Name" required name="lname" id="lname">
                    </div>

                    <div class="field">
                        <input type="email" placeholder="Email Address" required name="email" id="email">
                    </div>

                    <div class="field">
                        <input type="password" placeholder="Password" required name="password" id="password">
                    </div>

                    <div class="field">
                        <input type="password" placeholder="Confirm Password" required name="cpassword" id="cpassword">
                    </div>

                    <div class="field">
                        <input type="tel" placeholder="Mobile no." minlength="10" maxlength="10" required name="mobile" id="mobile">
                    </div>

                    <div class="field">
                        <input type="submit" value="Signup" name="signup">
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <script>
        const loginForm = document.querySelector("form.login");
        const signupForm = document.querySelector("form.signup");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector(".signuplink a");
        const loginText = document.querySelector(".titletext .login");
        const signupText = document.querySelector(".titletext signup");

        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });

        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });

        signupLink.onclick = (() => {
            signupBtn.click();
            return false;
        });
    </script>
</body>

</html>

<?php
$showAlert = false;
$showError = false;
if (isset($_POST['login'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include './dbConnect/config.php';
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "Select * from users where email='$email'";
        $result = mysqli_query($link, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                //verification of password
                if (password_verify($password, $row['password'])) {
                    //session start it stores mobile
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['lname'] = $row['lname'];
                    $_SESSION['userId'] = $row['userId'];
                    $_SESSION['phone'] = $row['mobile'];

                    //setting cookies
                    setcookie("email", $row['email'], time() + (86400 * 30)); 
                    setcookie("pass", $password, time() + (86400 * 30));


                    header("location: index.php");
                } else {
                    echo"<script>alert('Invalid Credentials');
                        window.history.back(1);</script>";
                }
            }
        } else {
            echo"<script>alert('Email not registered');
                window.history.back(1);</script>";
        }
    }
}
//sign up backend
if (isset($_POST['signup'])) {
    $showAlert = false;
    $showError = false;
    $exists = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include './dbConnect/config.php';
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $mobile = $_POST["mobile"];

        // Check whether this Mobile exists.
        $existSql = "SELECT * FROM `users` WHERE mobile = '$mobile'";
        $result = mysqli_query($link, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo '<script>alert("Mobile already registered.");
            window.history.back(1);
            </script>';
            exit();
        }
        // Check whether Email exists.
        $existSql = "SELECT * FROM `users` WHERE email = '$email'";
        $result = mysqli_query($link, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
        // $showError = '<div style="position:relative; bottom: 25px; color:red; text-align:center;">Username already exists.</div>';
            echo '<script>alert("Email already registered.");
            window.history.back(1);
            </script>';
            exit();
        }
        else{
            if(($password == $cpassword)){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` ( `fname`,`lname`,`email`, `password`, `mobile`) VALUES ('$fname',  '$lname',  '$email', '$hash', '$mobile')";   
                $result = mysqli_query($link, $sql);
                if ($result){
                    $showAlert = true;
                    setcookie("email", $email, time() + (86400 * 30)); 
                    setcookie("pass", $password, time() + (86400 * 30));
                    echo '<script>confirm("You are successfully Registered!");
                    window.location.href="http://localhost/Malgadi_Merged/home/authorize.php"; 
                    </script>';
                }else{
                    echo mysqli_error($link);
                }
            }
            else{
                // $showError = '<div style="position:relative; bottom: 25px; color:red;">Passwords do not match.</div>';
                echo '<script>alert("Passwords do not match");
                window.history.back(1);
                </script>';
            }
        }
    }
}


?>