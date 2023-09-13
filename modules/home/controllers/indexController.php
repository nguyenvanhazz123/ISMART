<?php

function construct(){
    load_model('index');

}
function indexAction(){
    
    $list_product = get_list_products();
    $data['list_product'] = $list_product;
    load_view('index', $data);
}
?>
