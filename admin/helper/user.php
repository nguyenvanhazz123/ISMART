<?php

function check_login($username,  $password) {
    $check_User = db_num_rows("SELECT * From `tbl_users` Where `username` = '{$username}' and `password` = '{$password}' ");
    if($check_User > 0){
        return true;
    }
    return false;
}

function is_login(){
    if(isset($_SESSION["is_login"])){
        return true;
    }
    return false;
}

function user_login(){
    if(!empty($_SESSION["user_login"])){
        return $_SESSION["user_login"];
    }
    return false;
}

function info_user($field = 'id') {
    $list_user =  db_fetch_array("SELECT * FROM `tbl_users`");
    if(isset($_SESSION['is_login'])){
        foreach($list_user as $user){
            if($_SESSION['user_login'] == $user['username']){
                if(array_key_exists($field, $user)){
                    return $user[$field];
                }
            }
        }
    }
    return false;
}


function show_gender($gender){
    $list_gender = array(
        'male' => "Nam",
        'female' => "Nữ",
    );
    if(array_key_exists($gender,$list_gender)){
        return $list_gender[$gender];
    }   
}



?>
