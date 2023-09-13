<?php

function get_list_status_order(){
    $result = db_fetch_array("SELECT * FROM `tbl_status_order`");
    return $result;
}
function get_product_by_code($code){
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `code` = '{$code}'");
    return $result;
}

function get_order_by_code($code_order){
    $result = db_fetch_row("SELECT * FROM `tbl_order` WHERE `code_order` = '{$code_order}'");
    return $result;
}

function get_list_product_by_code($code_order){
    $result = db_fetch_array("SELECT * FROM `tbl_detail_order` WHERE `code_order` = '{$code_order}'");
    return $result;
}
    
function get_status_cat_name_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_status_order` WHERE `id` = $id");
    return $result;
}
function get_num_order(){
    $result = db_num_rows("SELECT * FROM `tbl_order`");
    return$result;
}

function get_num_order_transported(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status` = 2");
    return$result;
}

function get_num_order_pending(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status` = 1");
    return$result;
}
function get_num_order_success(){
    $result = db_num_rows("SELECT * FROM `tbl_order` WHERE `status` = 3");
    return$result;
}
function get_order_page($start = 1, $num_per_page = 10, $where = "") {
    if(!empty($where)){
        $where = " WHERE {$where}"; 
    }
    $list_product = db_fetch_array("SELECT * FROM `tbl_order` {$where} LIMIT {$start}, {$num_per_page}");
    return $list_product;
}
?>