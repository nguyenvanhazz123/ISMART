<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/reset.css">
    <link rel="stylesheet" href="public/login.css">
    <title>Document</title>
</head>
<body>
    <div id="wp-form-login">
        <h1 class="title-login" >ĐĂNG NHẬP</h1>
        <form action="" id="form-login" method="post">
            <input type="text" name = "username" id="username" value="<?php if(isset($_SESSION['is_login'])) echo $_SESSION['user_login'] ?>" placeholder="Username">
            <?php echo form_error('username'); ?>
            <input type="password" name="password" id="password" value="" placeholder="Password">
            <?php echo form_error('password'); ?>
            <input type="submit" id="btn-login" name="btn_login" value="ĐĂNG NHẬP">
            <?php echo form_error('account'); ?>
            <input type="checkbox" name='remember_me' id ="btn-remember_me" >Ghi nhớ đăng nhập <br>
        </form>
       

    </div>
</body>
</html>