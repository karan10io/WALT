<?php

require_once "C:/Xampp/htdocs/dashboard/php/config.php";
require_once "C:/Xampp/htdocs/dashboard/php/session.php";
$error="";
$success="";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
        $error = '';
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$query->bind_param('s', $email);
	$query->execute();
	// Store the result so we can check if the account exists in the database.
	$query->store_result();
        if ($query->num_rows > 0) {
            $error .= '<p class="error">The email address is already registered!</p>';}
         else {
            // Validate password
            if (strlen($password ) < 6) {
                $error .= '<p class="error">Password must have atleast 6 characters.</p>';
            }

            // Validate confirm password
            if (empty($confirm_password)) {
                $error .= '<p class="error">Please enter confirm password.</p>';
            } else {
                if (empty($error) && ($password != $confirm_password)) {
                    $error .= '<p class="error">Password did not match.</p>';
                }
            }
            if (empty($error) ) {
                $insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?);");
                $insertQuery->bind_param("sss", $fullname, $email, $password_hash);
                $result = $insertQuery->execute();
                $insertQuery->close();
 
                if ($result) {
                    $error .= '<p class="success">Your registration was successful!</p>';
                } else {
                    $error .= '<p class="error">Something went wrong!</p>';
                }
            }
        }
    }
    $query->close();
    
    // Close DB connection
    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="signup.css">    
    <link rel="icon" type="image" href="/dashboard/images/top.png">
</head>

<body>
    <div class="signup_form">
    <a href="/dashboard/Home/Home.html" ><img src="/dashboard/images/logo4.png"></a>
    <h1 style="font-size: 37px"> Sign Up Now</h1>
    <p></p>
    <?php echo $success; ?>
    <?php echo $error; ?>    
    <form action="" method="post">
    <input type="name" name="name" class="input-box" required placeholder="Your Name">
    <input type="email" name="email" class="input-box" required  placeholder="Your Email">
    <input type="password" name="confirm_password" class="input-box" required placeholder="Your Password">
    <input type="password" name="password" class="input-box" required  placeholder="Confirm Password">
    <p style="font-size: 16px"><span><input type="checkbox" required></span> I Agree to the <a href="Terms and Conditions .txt">Terms And Condtions</a></p>
    <p> Enter captcha</p>
    <div class="preview"></div>
    <input type="captcha" class="captcha" placeholder="Enter Captcha here">
    <button type="button" class="captcha-refresh">
        <i class="fa fa-refresh"></i>
    </button>
    <button type="submit" name="submit" class="submit">Sign Up</button>
   
    <hr>
    <p style="font-size: 16px">Already a Member? <a href="/dashboard/Sign in/login.php">Sign In</a> </p>
    <script  src="signup.js"></script>
    <p>
    </form>

</div>

</body>
</html>