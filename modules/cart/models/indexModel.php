<?php
function get_product_by_id($id){
    $item = db_fetch_row("SELECT * FROM `tbl_product` where `id` = $id");
    // $item['url'] = "?mod=product&action=detail&id={$id}";
    $slug = create_slug($item['product_title']);
    $item['url'] = "chi-tiet-san-pham/$slug-$id.html";
    
    return $item;
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
function add_cart($id){
    $item = get_product_by_id($id);
    if(isset($_POST['btn_add'])){
        $soluong = $_POST['num-order'];
    }else{
        $soluong = 1;
    }
    //Thêm thông tin sản phẩm vào giỏ hàng
    $quantity = $soluong;
    if( isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])){
        $quantity = $_SESSION['cart']['buy'][$id]['quantity'] + $soluong;

    }

    $_SESSION['cart']['buy'][$id] = array(
        'id' => $item['id'],
        'url' => $item['url'],
        'product_title' => $item['product_title'],
        'price' => $item['price'],
        'product_thumb' => "admin/".$item['thumb'], 
        'code' => $item['code'],
        'quantity' => $quantity,
        'sub_total' => $item['price'] * $quantity,
    );  
    //Cập nhật hóa đơn
    update_info_cart(); 

}

function  update_info_cart(){
    if(isset($_SESSION['cart'])){
        $num_order = 0;
        $total = 0;
        foreach($_SESSION['cart']['buy'] as $item){ 
            $num_order += $item['quantity'];
            $total += $item['sub_total'];
        }
    
    
        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total,
        );
    }

}

function delete_cart($id = ""){
    if(isset($_SESSION['cart'])){
        #Xóa sản phẩm dựa vào id
        if(!empty($id)){
            unset($_SESSION['cart']['buy'][$id]);
            update_info_cart();
        }
        else{
            unset($_SESSION['cart']);
        }
    }
}

function update_cart($quantity){
    foreach($quantity as $id => $newQuantity){
        $_SESSION['cart']['buy'][$id]['quantity'] = $newQuantity;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $newQuantity * $_SESSION['cart']['buy'][$id]['price'];
    }
    update_info_cart();
}
?>