<?php

function construct(){
    load_model('index');
}
function indexAction(){ 
     //Phân trang
    $num_per_page = 4; //Số bản ghi trên mỗi trang
    $total_row = db_num_rows("SELECT * FROM `tbl_post`"); //Tổng số bản ghi
    $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
    $page = $_GET['page'];    
    $start  = ($page - 1) * $num_per_page;
   
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;
    $list_post = get_post_page($start, $num_per_page, "");
    $data['list_post'] = $list_post;
    load_view('index', $data);
}

function detailAction(){
    $list_post = get_list_post();    
    $data['list_post'] = $list_post;
    load_view('detail', $data);
}

?>
