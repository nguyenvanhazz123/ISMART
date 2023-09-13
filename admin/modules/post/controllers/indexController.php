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

    if(!empty($_GET['s'])){
        $key = $_GET['s'];
        $list_post = get_post_page($start, $num_per_page, " `post_title` LIKE '%{$key}%' ");;
    }else{
        if(!empty($_GET['actions'])){
            $key_action = $_GET['actions'];
            if($_GET['actions'] == 0){
                $list_post = get_post_page($start, $num_per_page);
            }else{
                $list_post = get_post_page($start, $num_per_page, "`status` = {$key_action}");
            }
        }else{
            $list_post = get_post_page($start, $num_per_page);
        }
       
    }
  
    $data["list_post"] = $list_post;

    $num_post = get_num_post();
    $data["num_post"] = $num_post;
    $num_post_posted = get_num_post_posted();
    $data["num_post_posted"] = $num_post_posted;
    $num_post_pending = get_num_post_pending();
    $data["num_post_pending"] = $num_post_pending;

    load_view('index', $data);
}

function add_postAction(){
    global $error;
    if(isset($_POST["btn-upload-thumb"])){
        $data['upload_file'] = get_link_thumb();            
    }
       
    //Kiểm tra khi submit thêm sản phẩm mới
    if(isset($_POST['btn-submit'])){
        $error = array();
        //Kiểm tra tiêu đề
        if(empty($_POST['title'])){
            $error['title'] = "Không để trống tên tiêu đề";
        }else{
            $title = $_POST['title'];
        }
        //Kiểm tra link thân thiện
        if(empty($_POST['slug'])){
            $error['slug'] = "Không để trống slug";
        }else{
            $slug = $_POST['slug'];
        }
       
        //Kiểm tra mô tả ngắn
        if(empty($_POST['desc'])){
            $error['desc'] = "Không để trống mô tả ngắn";
        }else{
            $desc = $_POST['desc'];
        }
        //Kiểm tra hình ảnh
        if(empty(check_thumb())){
            $error['thumb'] = "Bạn chưa chọn ảnh";
        }else{
            $thumb = check_thumb();
        }
        
        // }
        //Kiểm tra Danh mục bài viết
        if(empty($_POST['parent_Cat'])){
            $error['parent_Cat'] = "Bạn chưa chọn danh mục bài viết";
        }else{
            $post_cat_id = $_POST['parent_Cat'];
        }     

        if(empty($error)){
            $new_post = array(
                'post_title' => $title,
                'slug' => create_slug($slug),
                'post_desc' => $desc, 
                'post_thumb' => $thumb,              
                'post_cat_id' => $post_cat_id,
                'post_date' => time(),
                'status' => 1,

            );
            // show_array($new_product);
            db_insert("tbl_post", $new_post);
            $error['success'] = "Thêm bài viết mới thành công";
        }
    }

    $list_post_cat = get_list_post_cat();    
    $data['list_post_cat'] = $list_post_cat; 
    load_view('add_post', $data);
}

function list_catAction(){

      //Phân trang
    $num_per_page = 4; //Số bản ghi trên mỗi trang
    $total_row = db_num_rows("SELECT * FROM `tbl_post_cat`"); //Tổng số bản ghi
    $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
    $page = $_GET['page'];
    $start  = ($page - 1) * $num_per_page;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;

    $list_post_cat = get_post_cat_page($start, $num_per_page);
    $data["list_post_cat"] = $list_post_cat;

    load_view('list_cat', $data);
}
function deleteAction(){
    $id = (int)$_GET['id'];
    db_delete("`tbl_post`", "`post_id` = $id");

    indexAction();
}
function delete_post_catAction(){
    $id = (int)$_GET['id'];
    db_delete("`tbl_post_cat`", "`id_post_cat` = $id");

    list_catAction();
}

function add_post_catAction(){
    global $error;
    if(isset($_POST['btn-submit'])){
        $error = array();
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

        if($_POST['parent-Cat'] == 0){
            $parent_Cat = 0;
        }else{
            $parent_Cat = $_POST['parent-Cat'];
        }

        if($_POST['status'] == 0){
            $error['status'] = 'Bạn chưa chọn trạng thái';
        }else{
            $status = $_POST['status'];
        }

        if(empty($error)){
            if($parent_Cat == 0){
                $cat_order = 1;
            }else{
                $cat_order =  get_post_cat_name_by_id($parent_Cat)['cat_order'] + 1;
            }
            $new_cat_post = array(
                'post_cat_name' => $title,
                'cat_order' => $cat_order,
                'status' => $status,
                'slug' => create_slug($slug),
            );
            db_insert("tbl_post_cat", $new_cat_post);
            $error['success'] = "Thêm thành công";
        }
    }

    $list_post_cat = get_list_post_cat();    
    $data['list_post_cat'] = $list_post_cat;
    $list_status_cat = get_list_status_cat();
    $data['list_status_cat'] = $list_status_cat;
    load_view('add_post_cat', $data);
}

function editAction(){
    $id = (int)$_GET['id'];
    $post = get_post_by_id($id);
    $data['post'] = $post;
    global $error;
    if(isset($_POST["btn-upload-thumb"])){
        $data['upload_file'] = get_link_thumb();            
    }
       
    //Kiểm tra khi submit thêm sản phẩm mới
    if(isset($_POST['btn-submit'])){
        $error = array();
        //Kiểm tra tiêu đề
        if(empty($_POST['title'])){
            $error['title'] = "Không để trống tên tiêu đề";
        }else{
            $title = $_POST['title'];
        }
        //Kiểm tra link thân thiện
        if(empty($_POST['slug'])){
            $error['slug'] = "Không để trống slug";
        }else{
            $slug = $_POST['slug'];
        }
       
        //Kiểm tra mô tả ngắn
        if(empty($_POST['desc'])){
            $error['desc'] = "Không để trống mô tả ngắn";
        }else{
            $desc = $_POST['desc'];
        }
        //Kiểm tra hình ảnh
        if(empty(check_thumb())){
            $thumb = $post['post_thumb'];
        }else{
            $thumb = check_thumb();
        }
        
        // }
        //Kiểm tra Danh mục bài viết
        if(empty($_POST['parent_Cat'])){
            $error['parent_Cat'] = "Bạn chưa chọn danh mục bài viết";
        }else{
            $post_cat_id = $_POST['parent_Cat'];
        }     

        if(empty($error)){
            $new_post = array(
                'post_title' => $title,
                'slug' => create_slug($slug),
                'post_desc' => $desc, 
                'post_thumb' => $thumb,              
                'post_cat_id' => $post_cat_id,
                'post_date' => time(),
                'status' => 1,

            );
            // show_array($new_product);
            db_update("tbl_post", $new_post, "`post_id` = $id");
            $error['success'] = "Edit thành công";
            redirect("?mod=post&controller=index&page=1");
        }
    }

    $list_post_cat = get_list_post_cat();    
    $data['list_post_cat'] = $list_post_cat; 
    load_view('edit_post', $data);

}

function edit_post_catAction(){
    $id = (int)$_GET['id'];
    $post_cat = get_post_cat_by_id($id);
    $data['post_cat'] = $post_cat;
    global $error;
    if(isset($_POST['btn-submit'])){
        $error = array();
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

        if((int)$_POST['parent-Cat'] == 1){
            $parent_Cat = 1;
        }else{
            $parent_Cat = $_POST['parent-Cat'];
        }
       

        if($_POST['status'] == 0){
            $error['status'] = 'Bạn chưa chọn trạng thái';
        }else{
            $status = $_POST['status'];
        }

        if(empty($error)){
           
            $new_cat_post = array(
                'post_cat_name' => $title,
                'cat_order' => $parent_Cat,
                'status' => $status,
                'slug' => create_slug($slug),
            );
            db_update("tbl_post_cat", $new_cat_post, "`id_post_cat` = $id");
            $error['success'] = "Edit thành công";
        }
    }

    $list_post_cat = get_list_post_cat();    
    $data['list_post_cat'] = $list_post_cat;
    $list_status_cat = get_list_status_cat();
    $data['list_status_cat'] = $list_status_cat;
    load_view('edit_post_cat', $data);
}

?>
