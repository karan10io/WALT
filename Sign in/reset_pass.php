<?php

require_once "C:/Xampp/htdocs/dashboard/php/config.php";
$error="";
$success="";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {


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
            $insertQuery = $db->prepare("UPDATE users
            SET password= ?
            WHERE email = ?");
            $insertQuery->bind_param("ss",  $password_hash,$email);
            $result = $insertQuery->execute();
            $insertQuery->close();
            $error .= '<p class="error">Password reseted.</p>';
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
        }
                
        else   {
            $error .= '<p class="error">Email Not Regestered.</p>';
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
    <link rel="stylesheet" href="/dashboard/Sign Up/signup.css">    
</head>

<body>
    <div class="signup_form">
    <h1 style="font-size: 37px"> Reset Password</h1>
    <p></p>
    <?php echo $success; ?>
    <?php echo $error; ?>    
    <form action="" method="post">
        
    <input type="email" name="email" class="input-box" required placeholder="Your Email"> 
    <input type="password" name="confirm_password" class="input-box" required placeholder="Your Password">
    <input type="password" name="password" class="input-box" required  placeholder="Confirm Password">
    <button type="submit" name="submit" class="submit">Reset Password</button>
     <hr>
    <p style="font-size: 16px"> <a href="/dashboard/Sign in/login.php">Sign In</a> </p>
    <p>
    </form>

</div>

</body>
</html>