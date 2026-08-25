<?php

session_start();

require_once "includes/connection.php";

$error = "";

if(isset($_POST['login'])){

    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    $sql = "SELECT * FROM admins WHERE email=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s",$email);

    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $admin = $result->fetch_assoc();

        if(password_verify($password,$admin['password'])){

            $_SESSION['admin_id'] = $admin['admin_id'];

            $_SESSION['admin_name'] = $admin['full_name'];

            header("Location: dashboard.php");

            exit();

        }else{

            $error = "Incorrect password.";

        }

    }else{

        $error = "Email not found.";

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Spriaccs CMS | Login</title>

    <link rel="stylesheet"
          href="assets/css/login.css">

    <!-- Google Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="login-page">

    <!-- LEFT PANEL -->

    <div class="login-left">

        <img src="../png/logo.png"
             alt="Spriaccs Logo"
             class="login-logo">

        <h1>Welcome Back</h1>

        <p>

            Manage your projects, blog posts,
            messages and website settings
            from one beautiful dashboard.

        </p>

    </div>

    <!-- RIGHT PANEL -->

    <div class="login-right">

        <form class="login-form"
              action="login.php"
              method="POST">

            <h2>Admin Login</h2>

            <p>

                Sign in to continue.

            </p>

            <?php if($error!=""){ ?>

            <div class="login-error">

                <?php echo $error; ?>

            </div>

            <?php } ?>

            <div class="input-box">

                <i class="fa-solid fa-envelope"></i>

                <input
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    required>

            </div>

            <div class="input-box">

                <i class="fa-solid fa-lock"></i>

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required>

            </div>

            <div class="login-options">

                <label>

                    <input type="checkbox">

                    Remember Me

                </label>

                <a href="#">

                    Forgot Password?

                </a>

            </div>

            <button type="submit" name="login">

                Login

            </button>

        </form>

    </div>

</div>

</body>
</html>