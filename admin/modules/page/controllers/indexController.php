<?php

function construct(){
    load_model('index');
}
function indexAction(){
    //Phân trang
    $num_per_page = 4; //Số bản ghi trên mỗi trang
    $total_row = db_num_rows("SELECT * FROM `tbl_page`"); //Tổng số bản ghi
    $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
    $page = $_GET['page'];
    $start  = ($page - 1) * $num_per_page;
   

    if(!empty($_GET['s'])){
        $key = $_GET['s'];
        $list_page = get_page_page($start, $num_per_page, " `page_title` LIKE '%{$key}%' ");;
    }else{
        if(!empty($_GET['actions'])){
            $key_action = $_GET['actions'];
            if($_GET['actions'] == 0){
                $list_page = get_page_page($start, $num_per_page);
            }else{
                $list_page = get_page_page($start, $num_per_page, "`status` = {$key_action}");
            }
        }else{
            $list_page = get_page_page($start, $num_per_page);
        }
       
    }
    
    $data["list_page"] = $list_page;
    $data['num_page_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;

    $num_page = get_num_page();
    $data["num_page"] = $num_page;
    $num_page_posted = get_num_page_posted();
    $data["num_page_posted"] = $num_page_posted;
    $num_page_pending = get_num_page_pending();
    $data["num_page_pending"] = $num_page_pending;

    load_view("index", $data);
}
function detailAction(){
    echo $_GET['slug'];
    load_view('index');
}

function addAction(){
    global $error;
    if(isset($_POST["btn-upload-thumb"])){
        $data['upload_file'] = get_link_thumb();            
    }
    if(isset($_POST['btn-submit'])){
        $error = array();

        if(empty($_POST['page_name'])){
            $error['page_name'] = 'Không để trống tên trang';
        }else{
            $page_name = $_POST['page_name'];
        }

        if(empty($_POST['title'])){
            $error['title'] = 'Không để trống title';
        }else{
            $title = $_POST['title'];
        }

        if(empty($_POST['slug'])){
            $error['slug'] = 'Không để trống slug';
        }else{
            $slug = $_POST['slug'];
        }
        //Kiểm tra hình ảnh
        if(empty(check_thumb())){
            $error['thumb'] = "Bạn chưa chọn ảnh";
        }else{
            $thumb = check_thumb();
        }
         //Kiểm tra mô tả ngắn
         if(empty($_POST['desc'])){
            $error['desc'] = "Không để trống mô tả ngắn";
        }else{
            $desc = $_POST['desc'];
        }       

        if($_POST['status'] == 0){
            $error['status'] = 'Bạn chưa chọn trạng thái';
        }else{
            $status = $_POST['status'];
        }

        if(empty($error)){          
            $new_page = array(
                'page_name' => $page_name,
                'page_title' => $title,
                'page_content' => $desc,
                'slug' => create_slug($slug),
                'create_date' => time(),
                'page_thumb' => $thumb,
                'status' => $status,
            );
            db_insert("tbl_page", $new_page);
            $error['success'] = "Thêm thành công";
        }
    }

    $list_status_cat = get_list_status_cat();
    $data['list_status_cat'] = $list_status_cat;
    load_view('add', $data);
}
function deleteAction(){
    $id = (int)$_GET['id'];
    db_delete("`tbl_page`", "`id` = $id");

    indexAction();
}

function editAction(){
    $id = (int)$_GET['id'];
    $page = get_page_by_id($id);
    $data['page'] = $page;
    global $error;
    if(isset($_POST["btn-upload-thumb"])){
        $data['upload_file'] = get_link_thumb();            
    }
    if(isset($_POST['btn-submit'])){
        $error = array();

        if(empty($_POST['page_name'])){
            $error['page_name'] = 'Không để trống tên trang';
        }else{
            $page_name = $_POST['page_name'];
        }

        if(empty($_POST['title'])){
            $error['title'] = 'Không để trống title';
        }else{
            $title = $_POST['title'];
        }

        if(empty($_POST['slug'])){
            $error['slug'] = 'Không để trống slug';
        }else{
            $slug = $_POST['slug'];
        }
        //Kiểm tra hình ảnh
        if(empty(check_thumb())){
            $thumb = $page['page_thumb'];
        }else{
            $thumb = check_thumb();
        }
         //Kiểm tra mô tả ngắn
         if(empty($_POST['desc'])){
            $error['desc'] = "Không để trống mô tả ngắn";
        }else{
            $desc = $_POST['desc'];
        }       

        if($_POST['status'] == 0){
            $error['status'] = 'Bạn chưa chọn trạng thái';
        }else{
            $status = $_POST['status'];
        }

        if(empty($error)){          
            $new_page = array(
                'page_name' => $page_name,
                'page_title' => $title,
                'page_content' => $desc,
                'slug' => create_slug($slug),
                'create_date' => time(),
                'page_thumb' => $thumb,
                'status' => $status,
            );
            db_update("tbl_page", $new_page, "`id` = $id");
            redirect("?mod=page&controller=index&page=1");
        }
    }

    $list_status_cat = get_list_status_cat();
    $data['list_status_cat'] = $list_status_cat;
    load_view('edit', $data);
}

?>
