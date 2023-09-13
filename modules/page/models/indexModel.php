<?php
function get_list_products(){
    $sql = "SELECT * FROM `tbl_product`";
    $result = db_fetch_array($sql);
    return $result;
}

function get_list_page(){
    $sql = "SELECT * FROM `tbl_page`";
    $result = db_fetch_array($sql);
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
?>