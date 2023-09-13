<?php 
function is_username($username){
    $partten = "/^[A-Za-z0-9_\.]{2,32}$/";
    if(!preg_match($partten, $username, $matches))
        return false;
    return true;
}
function is_password($password){
    $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if(!preg_match($partten, $password, $matches))
        return false;
    return true;
}
function is_phone_number($phone_number){
    $partten = "/^(09|08|01[2|6|8|9])+([0-9]{8,9})$/";
    if(!preg_match($partten, $_POST["phone_number"], $matches))
        return false;
    return true;
}
function is_email($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return $email;
    }
    return true;
}
function set_value($label_field){
    global $$label_field;
    if(!empty($$label_field))
        return $$label_field;
}
function form_error($label_field){
    global $error;
    if(!empty($error[$label_field]))
        return "<p style='color: red;' class = 'error'>{$error[$label_field]}</p>";
}
?>