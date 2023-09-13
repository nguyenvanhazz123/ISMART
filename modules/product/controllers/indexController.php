<?php

function construct(){
    load_model('index');
}
function indexAction(){

     //Phân trang
     $num_per_page = 12; //Số bản ghi trên mỗi trang
     $total_row = db_num_rows("SELECT * FROM `tbl_product`"); //Tổng số bản ghi
     $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
     if(!empty($_GET['page'])){
        $page = $_GET['page'];
     }else{
        $page = $_POST['page'];
     }     
     $start  = ($page - 1) * $num_per_page;
     $data['num_page'] = $num_page;
     $data['page'] = $page;
     $data['start'] = $start;
     

    $list_product_cat = get_list_cat_product();
    $data['list_product_cat'] = $list_product_cat;
    if(!empty($_GET['cat_id'])){
        $cat_id = $_GET['cat_id'];
     }else if(!empty($_POST['cat_id'])){
        $cat_id = $_POST['cat_id'];
     }else{
        $cat_id = 0;
     }

    if(!empty($_GET['s'])){
        $key = $_GET['s'];
        $list_product = get_product_page($start, $num_per_page, " `product_title` LIKE '%{$key}%' ");
        $cat_id = (int)get_cat_id_by_key($key);
        $data['cat_id'] = $cat_id;
       
    }else{               
        $data['cat_id'] = $cat_id;
        switch($cat_id){
            case 1: 
                $where = "`cat_id` IN (1, 10, 11, 12, 13)";
                break;
            case 10:
                $where = "`cat_id` IN (10, 12, 13)";
                break;
            case 11:
                $where = "`cat_id` IN (1,11, 24, 25)";
                break;
            case 26:
                $where = "`cat_id` IN (26, 27)";
                break;
            default:
                $where = "`cat_id` IN ($cat_id)";
                break;
        }
        $list_product = get_product_page($start, $num_per_page, $where);        
        $cat_product = get_cat_by_id($cat_id);
        $data['cat_product'] = $cat_product;
        //$list_product = get_list_product_by_cat_id($cat_id);
    }    
    $data['list_product'] = $list_product;        
    load_view('index', $data);
}

function detailAction(){
    $id = $_GET['id'];
    $item = get_product_by_id($id);
    $data['item'] = $item;
    $list_image = get_list_image_by_id($id);
    $data['list_image'] = $list_image;
    load_view('detail', $data);
}

function filterAction(){
    
     //Phân trang
     $num_per_page = 12; //Số bản ghi trên mỗi trang
     $total_row = db_num_rows("SELECT * FROM `tbl_product`"); //Tổng số bản ghi
     $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
     $page = $_POST['page'];
     $start  = ($page - 1) * $num_per_page;
     $data['num_page'] = $num_page;
     $data['page'] = $page;
     $data['start'] = $start;

    $cat_id =  $_POST['cat_id'];
    switch($cat_id){
        case 1: 
            $where = "`cat_id` IN (1, 10, 11, 12, 13)";
            break;
        case 10:
            $where = "`cat_id` IN (10, 12, 13)";
            break;
        case 11:
            $where = "`cat_id` IN (1,11)";
            break;
        case 26:
            $where = "`cat_id` IN (26, 27)";
            break;
        default:
            $where = "`cat_id` IN ($cat_id)";
            break;
    }
    // $page = $_GET['page'];
    $select = $_POST['select'];
    switch($select){
        case 0:
            indexAction();
            break;
        case 1:
            $list_product = get_product_page($start, $num_per_page, $where."ORDER BY `product_title` ASC");
            break; 
        case 2:
            $list_product = get_product_page($start, $num_per_page, $where."ORDER BY `product_title` DESC");
            break;        
        case 3:
            $list_product = get_product_page($start, $num_per_page, $where."ORDER BY `price` DESC");
            break;
        case 4:
            $list_product = get_product_page($start, $num_per_page, $where."ORDER BY `price` ASC");
            break;
    }
    $data['list_product'] = $list_product;        
    load_view('index', $data);
}

function filter_checkAction(){
     //Phân trang
     
     $num_per_page = 12; //Số bản ghi trên mỗi trang
     $total_row = db_num_rows("SELECT * FROM `tbl_product`"); //Tổng số bản ghi
     $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
     $page = (int)$_GET['page'];
     $start  = ($page - 1) * $num_per_page;
     $data['num_page'] = $num_page;
     $data['page'] = $page;
     $data['start'] = $start;

     if(!empty($_POST['r-cat'])){
        $cat_id = (int)$_POST['r-cat'];

     }else{
        $cat_id = (int)$_GET['cat_id'];
     }
     switch($cat_id){
         case 1: 
             $where = "`cat_id` IN (1, 10, 11, 12, 13)";
             break;
         case 10:
             $where = "`cat_id` IN (10, 12, 13)";
             break;
         case 11:
             $where = "`cat_id` IN (1,11)";
             break;
        case 26:
            $where = "`cat_id` IN (26, 27)";
            break;
         default:
             $where = "`cat_id` IN ($cat_id)";
             break;
    }
    if(!empty($_POST['r-price'])){
        $price = $_POST['r-price']; 
    }else{
        $price = 0;
    }

    if(!empty($_POST['r-brand'])){
        $brand = (int)$_POST['r-brand'];
    }else{
        $brand = 0;
    }

    if($brand != 0){
        $where .= "AND `brand` = $brand";
    }
    
    switch ($price){        
        case 1:
            $where .= " AND `price` < 500000"; break;
        case 2:
            $where .= " AND `price` >= 500000 AND  `price` < 1000000"; break;
        case 3:
            $where .= " AND `price` >= 1000000 AND  `price` < 5000000"; break;
        case 4:
            $where .= " AND `price` >= 5000000 AND  `price` < 10000000"; break;
        case 5:
            $where .= " AND `price` >= 10000000"; break;
     
    }
    $list_product = get_product_page($start, $num_per_page, $where);
    
    $data['list_product'] = $list_product;   
    load_view("index", $data);

}
?>
