<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/reg.css">
    <title>Trang đăng ký</title>
</head>
<body>
    <div id="wp-form-register">
        <h1 class="title-register" >ĐĂNG KÝ TÀI KHOẢN</h1>
        <form action="" id="form-register" method="post">
            <input type="text" name = "fullname" id="fullname" value="<?php echo set_value('fullname') ?>" placeholder="Fullname">
            <?php echo form_error('fullname'); ?>

            <input type="email" name = "email" id="email" value="<?php echo set_value('email') ?>" placeholder="Email">
            <?php echo form_error('fullname'); ?>

            <input type="text" name = "username" id="username" value="<?php echo set_value('username') ?>" placeholder="Username">
            <?php echo form_error('username'); ?>

            <input type="password" name="password" id="password" value="" placeholder="Password">
            <?php echo form_error('password'); ?>

            <input type="submit" id="btn-register" name="btn_register" value="Đăng ký">
            <?php echo form_error('account'); ?>
        </form>
        <a href="<?php echo base_url("?mod=users&action=login"); ?>" id = "lost-pass">Đăng nhập</a>
    </div>
</body>
</html>