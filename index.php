<?php
require_once 'assets/php/connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Accomplishment</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Abril%20Fatface.css">
    <link rel="stylesheet" href="assets/css/Aleo.css">
</head>
<style>
    body {
        background: url('assets/img/background.jpg');
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .logo {
        position: absolute;
        top: 20px;
        right: 60px;

    }

    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 20px;
    }

    form {
        display: flex;
        justify-content: center;
        flex-direction: column;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    form input {
        margin: 10px 0;
        outline: none;
    }

    .form-control {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .btn {
        margin: 10px 0;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        outline: none;
    }



    p,
    h2 {
        color: #fff;
        text-align: center;
    }
</style>

<body>
    <div class="logo">
        <img src="assets/img/province.png" width="90vm">
        <img src="assets/img/zdsmc.png" width="90vm">
    </div>
    <div class="container">
        <div class="login-form">
            <h2>Login Account</h2>
            <p>Here you can login your account</p>
            <form id="sign-in-form">
                <input type="text" name="emp_id" placeholder="Employee ID" class="form-control" required>
                <input type="password" name="password" placeholder="Password" class="form-control">
                <button type="submit" class="btn btn-primary">Login Account</button>
            </form>
        </div>
    </div>
</body>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/login.js"></script>r

</html>