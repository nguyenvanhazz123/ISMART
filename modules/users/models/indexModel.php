<?php 
function get_list_users(){
    $sql = "SELECT * FROM `tbl_users`";
    $result = db_fetch_array($sql);
    return $result;
}
function get_user_by_id($id){
    $sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}
function delete_user($id){
    $sql = "DELETE FROM tbl_users WHERE `tbl_users`.`user_id` = '{$id}'";
    db_query($sql);
}

function add_user($data){
    return db_insert('tbl_users', $data);
}
function user_exists($username, $email){
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    if($check_user > 0){
        return true;
    }
    return false;
}

function active_user($active_token){
    return db_update("tbl_users", array('is_active' => 1), "`active_token` = '{$active_token}'");
}
function check_active_token($active_token){
    $check_token = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}' and `is_active` = '0' ");
    if($check_token > 0){
        return true;
    }
    return false;
}
function check_reg_time($active_token){
    $check_reg_time = db_fetch_row("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}' and `is_active` = '0' ");
    if($check_reg_time['reg_date'] > time()){
        return true;
    }
    return false;
}

function check_email($email){
    $check_email = db_fetch_row("SELECT * FROM `tbl_users` where `email` = '{$email}' ");
    if($check_email > 0){
        return true;
    }
    return false;
}
function update_reset_token($data, $email){
    db_update("tbl_users", $data, "`email` = '{$email}'");
}

function check_reset_token($reset_token){
    $check_reset_token = db_fetch_row("SELECT * FROM `tbl_users` where `reset_pass_token` = '{$reset_token}' ");
    if($check_reset_token > 0){
        return true;
    }
    return false;
}

function update_new_pass($data, $reset_token){
    db_update("`tbl_users`", $data, "`reset_pass_token` = '{$reset_token}'");
}
?>

