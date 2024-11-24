<?php

session_start();
if (isset($_SESSION['id'])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/login.css" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />

</head>

<body>
    <div class="container">
        <form class="user-info" action="includes/checkuser.php" method="post">
            <h2 class="welcome">Expenses Tracker Login</h2>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <p>
                    <input type="text" placeholder="Enter your mail address" name="email" id="email" />
                </p><label id="emerr"></label>

            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <p>
                    <input type="password" placeholder="Enter password" name="password" id="password" />
                </p>
                <label id="perr"></label>
            </div>

            <button type="submit" class="login-btn">Login</button>
            <div class="bottom">
                <div class="down-text">Forgotten Password?</div>
                <div class="down-text">
                    Don't Have an Account? <a href="signup.php">Sign Up.</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>