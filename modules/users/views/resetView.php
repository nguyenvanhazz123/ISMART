<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/reset.css">
    <link rel="stylesheet" href="public/css/login.css">
    <title>Document</title>
</head>
<body>
    <div id="wp-form-login">
        <h1 class="title-login" >KHÔI PHỤC MẬT KHẨU</h1>        
        <form action="" id="form-login" method="post">
            <input type="email" name = "email" id="username" placeholder="Email khôi phục">
            <?php echo form_error('email'); ?>
          
            <input type="submit" id="btn-login" name="btn_reset" value="GỬI YÊU CẦU">
            <?php echo form_error('account'); ?>            
        </form>
        <a href="<?php echo base_url("?mod=users&action=login"); ?>" id = "lost-pass">Đăng nhập</a> |
        <a href="<?php echo base_url("?mod=users&action=reg"); ?>" id = "lost-pass">Đăng ký</a>        
    </div>
</body>
</html>