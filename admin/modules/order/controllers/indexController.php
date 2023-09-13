<?php

function construct(){
    load_model('index');
}
function indexAction(){

        //Phân trang
        $num_per_page = 4; //Số bản ghi trên mỗi trang
        $total_row = db_num_rows("SELECT * FROM `tbl_order`"); //Tổng số bản ghi
        $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
        $page = $_GET['page'];
        $start  = ($page - 1) * $num_per_page;
        $data['num_page'] = $num_page;
        $data['page'] = $page;
        $data['start'] = $start;
    
        if(!empty($_GET['s'])){
            $key = $_GET['s'];
            $list_order = get_order_page($start, $num_per_page, " `fullname` LIKE '%{$key}%' ");;
        }else{          
            if(!empty($_GET['actions'])){
                $key_action = $_GET['actions'];
                if($key_action == 0){
                    $list_order = get_order_page($start, $num_per_page);
                }else{
                    $list_order = get_order_page($start, $num_per_page, "`status` = {$key_action}");
                }
            }else{
                $list_order = get_order_page($start, $num_per_page);
            }
        }
        //===================//
        
        $data['list_order'] = $list_order;
    
        //Lấy số lượng tất cả đơn hàng
        $num_order = get_num_order();        
        $data["num_order"] = $num_order;
        
        //Lấy tất cả đơn đang vận chuyển
        $num_order_transported = get_num_order_transported();
        $data['num_order_transported'] = $num_order_transported;

        //Lấy số lượng đơn hàng đã giao thành công
        $num_order_success = get_num_order_success();
        $data["num_order_success"] = $num_order_success;

        //Lấy số lượng sản phẩm chờ duyệt
        $num_order_pending = get_num_order_pending();
        $data["num_order_pending"] = $num_order_pending;
        
        load_view('index', $data);
    
}   

function detail_orderAction(){
    $code_order = $_GET['code_order'];
    //Lấy đơn hàng có mã code trên
    $item_order = get_order_by_code($code_order);
    $data["item_order"] = $item_order;

    //Lấy danh sách sản phẩm có mã code trên
    $list_product_code = get_list_product_by_code($code_order);
    $data["list_product_code"] = $list_product_code;

    $list_status_order = get_list_status_order();
    $data["list_status_order"] = $list_status_order;
    load_view('detail_order', $data);
}
function delete_orderAction(){
    $id = $_GET['id'];
    db_delete("`tbl_order`", "`id` = $id");
    indexAction();
}
function updateAction(){
    $id = $_GET['id'];
    
    if(isset($_POST['sm_status'])){
        $status_id = $_POST['status'];           
        $update_status = array(
            'status' => $status_id,
        );
        db_update("`tbl_order`", $update_status, "`id` = $id");

    }
    indexAction();
}
?>
