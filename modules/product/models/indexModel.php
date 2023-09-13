<?php
function get_cat_id_by_key($key){
    $result = db_fetch_row("SELECT `id` FROM `tbl_product_cat` WHERE `cat_title` LIKE '%{$key}%' ");
    return $result;
}
function get_list_buy_cart(){
    if(isset($_SESSION['cart'])){
        // foreach($_SESSION['cart']['buy'] as &$item){
        //     $item['url_delete_cart'] = "?mod=cart&act=delete&id={$item['id']}";
        // }  
        foreach($_SESSION['cart']['buy'] as &$item){
            $item['url_delete_cart'] = "?mod=cart&action=delete&id={$item['id']}";
            $_SESSION['cart']['buy'][$item['id']] = $item;
        }               
        return $_SESSION['cart']['buy'];
    }
    return false;
}
function get_cart_info(){
    if(isset($_SESSION['cart']['info'])){
        return  $_SESSION['cart']['info'];
    }
}
function get_list_image_by_id($id){
    $result = db_fetch_array("SELECT * FROM `tbl_images` WHERE `id_product` = $id");
    return $result;
}

function get_product_page($start = 1, $num_per_page = 10, $where = "") {
    if(!empty($where)){
        $where = " WHERE {$where}"; 
    }
    $list_product = db_fetch_array("SELECT * FROM `tbl_product` {$where} LIMIT {$start}, {$num_per_page}");
    return $list_product;
}
function get_product_cat_page($start = 1, $num_per_page = 10, $where = "") {
    if(!empty($where)){
        $where = " WHERE {$where}"; 
    }
    $list_product_cat = db_fetch_array("SELECT * FROM `tbl_product_cat` {$where} LIMIT {$start}, {$num_per_page}");
    return $list_product_cat;
}
function get_list_images($id_product){
    $list_images = db_fetch_array("SELECT * FROM `tbl_images` WHERE `id_product` = '{$id_product}'");
    return $list_images;
}
// function get_list_product_by_cat_id($cat_id){
//     switch($cat_id){
//         case 1: 
//             $sql = "SELECT * FROM `tbl_product` WHERE `cat_id` IN (1, 10, 11, 12, 13)";
//             break;
//         case 10:
//             $sql = "SELECT * FROM `tbl_product` WHERE `cat_id` IN (10, 12, 13)";
//             break;
//         case 11:
//             $sql = "SELECT * FROM `tbl_product` WHERE `cat_id` IN (1,11)";
//             break;
//         default:
//             $sql = "SELECT * FROM `tbl_product` WHERE `cat_id` IN ($cat_id)";
//             break;
//     }
    
//     $result = db_fetch_array($sql);
//     return $result;
// }
function get_product_by_id($id){
    $sql = "SELECT * FROM `tbl_product` WHERE `id` = '{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}

function get_cat_by_id($cat_id){
    $result = db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `id` = '{$cat_id}'");
    return $result;
}
function get_list_cat_product(){
    $sql = "SELECT * FROM `tbl_product_cat`";
    $result = db_fetch_array($sql);
    return $result;
}
function total($list_product = array(), $cat_id){
    $total = 0;
    foreach($list_product as $item){
        if($item['cat_id'] == $cat_id) {
            $total++;
        }
    }
    return $total;
}


?>