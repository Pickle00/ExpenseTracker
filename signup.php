<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html
        {
            height: 100%;
            background-color: lightgrey;
        }

        body {
            font-family: "Poppins", sans-serif;
            display: flex;
            place-items: center;
            padding: auto;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            display: grid;
            padding: 20px;
            width: 30rem;
            height: auto;
            border-radius: 10px;
            border: 1px solid skyblue;
            background-color: white;

        }

        .txtfield input {
            border-radius: 10px;
            border: none;
            font-size: 1rem;
            background-color: #f0f8ff;
            width: 100%;
            height: 40px;
            margin: 20px 0px;
            padding: 0px 10px;
            outline: none;
        }

        .txtfield button {
            margin-top: 20px;
            font-size: 1rem;
            width: 90%;
            height: 40px;
            border: none;
            font-family: inherit;
            border-radius: 10px;
            color: skyblue;
            font-weight: 600;
            border: 1px solid skyblue;
            background-color: #ffffff;
            transition: all 0.2s ease-in;
        }



        .txtfield input:hover {
            border: 2px solid skyblue;
        }

        .txtfield input:focus {
            border: 2px solid skyblue !important;
        }

        button:hover {
            cursor: pointer;
            background-color: skyblue;
            /* width: 100%; */
            transform: scale(1.1);
            color: white;
        }

        .txtfield .name {
            width: 48%;
        }

        .txtfield p {
            display: flex;
            justify-content: space-between;
        }

        .avatar img {
            max-width: 80px;
            background-color: rgb(255, 255, 255);
            border-radius: 100%;
        }


        .more {
            margin: 30px;
            color: black;
        }

        .su-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            padding: 0;
            margin: 0;
            z-index: -1;
            opacity: 0.8;
            filter: blur(10px);
        }

        .container label {
            font-size: 40px;
            font-weight: bold;
            margin: 20px;
            color: black;
        }

        .login {
            width: 100px;
            height: 40px;
            border: 1px solid skyblue;
            background-color: white;
            text-decoration: none;
            color: skyblue;
            font-size: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: auto;
        }

        .login:hover {
            background-color: skyblue;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <label>Create an Account</label>
        <form class="txtfield" method="post" action="includes/register.php" onsubmit="return validateForm()">
            <input type="text" class="username" placeholder="Username" name="username" required />
            <input type="text" class="email" placeholder="Enter your Email" name="email" required />
            <input type="password" class="password" placeholder="Enter your password" name="password" required />
            <input type="password" class="password" placeholder="Re-enter your password" name="confirm_password" required />
            <button type="submit" class="tologin">Sign Up</button>
            <p class="more">Already Have an Account?. <a href="login.php" class="login">Login</a></p>
            <div id="error-message" style="color: red; margin-top: 10px;"></div>
        </form>
    </div>
</body>
<script>
    function validateForm() {
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
        const errorMessage = document.getElementById('error-message');
        errorMessage.innerHTML = '';

        if (!passwordPattern.test(password)) {
            errorMessage.innerHTML += "Password must be at least 6 characters long, contain at least one uppercase letter, one number, and one special character.<br>";
            return false;
        }

        if (password !== confirmPassword) {
            errorMessage.innerHTML += "Passwords do not match.<br>";
            return false;
        }

        if (!emailPattern.test(email)) {
            errorMessage.innerHTML += "Please enter a valid Gmail address.<br>";
            return false;
        }

        return true;
    }
</script>

</html>