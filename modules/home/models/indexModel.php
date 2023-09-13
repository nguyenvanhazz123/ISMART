<?php

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

function get_list_products(){
    $sql = "SELECT * FROM `tbl_product`";
    $result = db_fetch_array($sql);
    return $result;
}
function get_product_by_cat_id($cat_id){
    $sql = "SELECT * FROM `tbl_product` WHERE `cat_id` = '{$cat_id}'";
    $result = db_fetch_row($sql);
    return $result;
}
function get_list_images($id_product){
    $list_images = db_fetch_array("SELECT * FROM `tbl_images` WHERE `id_product` = '{$id_product}'");
    return $list_images;
}




?>