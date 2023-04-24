<?php

require_once "C:/Xampp/htdocs/dashboard/php/config.php";
require_once "C:/Xampp/htdocs/dashboard/php/session.php";
$querry="";

$error = '';
$sucess = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // validate if email is empty
    if (empty($email)) {
        $error .= '<p class="error">Please enter email.</p>';
    }

    // validate if password is empty
    if (empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }

    if (empty($error)) {
        if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
            $query->bind_param('s', $email);
            $query->execute();
            $row = $query->get_result()->fetch_assoc();
            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;

                    // Redirect the user to welcome page
                    header("location: /dashboard/Main/Main.php");
                    exit;
                } else {
                    $error .= '<p class="error">The password is not valid.</p>';
                               
                    

                }
            } 
            else {
                $error .= '<p class="error">The Emai is not Registered.</p>';
            }
        }
        $query->close();
    }
    // Close connection
    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="google-signin-client_id" content="82487855005-2qk11c65okvd2a6dmtjs6hk4jdg1dkdu.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="/dashboard/images/top.png">
    <link rel="stylesheet" href="sign_in.css">
    <title>Sign In</title> 
</head>
<body>


  <form  action="" method="post">>
    <div class="signin" max-width: 500px>
    <a  href="/dashboard/Home.php" ><img src="/dashboard/images/logo4.png"
    width="200px"></a>
        <h1>Sign In</h1>
<?php echo $error; ?>
<?php echo $sucess; ?>

        <hr>
        <input type="email" name="email" class="useremail" required placeholder="Email"><br>
        <input type="password" name="password" class="password" requireds placeholder="Password"><br>
        <button type="submit" name="submit" class="button">Sign In</button> <br>
        <input type="checkbox"  checked="checked">  Remember me
        <div class="OR">
        <p>OR</p>
        </div>
      
        <p></p>
        <div class="container">
              <div class="g-signin2" data-onsuccess="onSignIn" >
                <div class="content-wrapper">
                  <div class="logo-wrapper">
                    <img src="https://developers.google.com/identity/images/g-logo.png">
                  </div>
                  <span class="text-container">
                    <span>Sign in with Google</span> 
                  </span>
                </div>
              </div>
            </a>
          </div>
        <hr>
        <div class="text-center">
            <div class="signup-option">
                <span class="no-account-text">New to Walt?</span>
                <a id="sign-up-link" class="text-link signup-link" href="/dashboard/Sign up/signup.php" target="_self">Sign Up</a><br>
        </div>
        <div class="Forgot Password">
                <span class="Forgot">Forgot Pasword?</span>
                <a id="reset link" class="text-link reset link" href="/dashboard/Sign in/reset_pass.php" target="_self">Reset</a><br>
        </div>
        </div>
      </form>
</body>
<script>
    function onSignIn(googleUser) {
      // get user profile information
      console.log(googleUser.getBasicProfile())
    }
  </script>
</html>