<?php

function construct(){
    load_model('index');

}
function indexAction(){
  
    //Phân trang
    $num_per_page = 4; //Số bản ghi trên mỗi trang
    $total_row = db_num_rows("SELECT * FROM `tbl_product`"); //Tổng số bản ghi
    $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
    $page = $_GET['page'];
    $start  = ($page - 1) * $num_per_page;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;

    if(!empty($_GET['s'])){
        $key = $_GET['s'];
        $list_product = get_product_page($start, $num_per_page, " `product_title` LIKE '%{$key}%' ");;
    }else{
        if(!empty($_GET['actions'])){
            $key_action = $_GET['actions'];
            if($key_action == 0){
                $list_product = get_product_page($start, $num_per_page);
            }else{
                $list_product = get_product_page($start, $num_per_page, "`status` = {$key_action}");
            }
        }else{
            $list_product = get_product_page($start, $num_per_page);
        }
       
    }
    //===================//
    
    $data['list_product'] = $list_product;

    //Lấy số lượng tất cả sản phẩm
    $num_product = get_num_product();
    $data["num_product"] = $num_product;
    //Lấy số lượng sản phẩm đã đăng
    $num_product_posted = get_num_product_posted();
    $data["num_product_posted"] = $num_product_posted;
    //Lấy số lượng sản phẩm chờ duyệt
    $num_product_pending = get_num_product_pending();
    $data["num_product_pending"] = $num_product_pending;
    load_view('index', $data);
}

function add_productAction(){
    global $error;
    if(isset($_POST["btn-upload-thumb"])){
        $data['upload_file'] = get_link_thumb();
        $data['file_name'] = $_FILES['file']['name']; 
    
    }
   

    //Kiểm tra khi submit thêm sản phẩm mới
    if(isset($_POST['btn-submit'])){
        $error = array();
        //Kiểm tra tên sản phẩm
        if(empty($_POST['product_name'])){
            $error['product_name'] = "Không để trống tên sản phẩm";
        }else{
            $product_name = $_POST['product_name'];
        }
        //Kiểm tra mã sản phẩm
        if(empty($_POST['product_code'])){
            $error['product_code'] = "Không để trống mã sản phẩm";
        }else{
            $product_code = $_POST['product_code'];
        }
        //Kiểm tra giá sản phẩm
        if(empty($_POST['price'])){
            $error['price'] = "Không để trống giá sản phẩm";
        }else{
            $price = $_POST['price'];
        }
        //Kiểm tra mô tả ngắn
        if(empty($_POST['product_desc'])){
            $error['product_desc'] = "Không để trống mô tả ngắn sản phẩm";
        }else{
            $product_desc = $_POST['product_desc'];
        }
        //Kiểm tra chi tiết sản phẩm
        if(empty($_POST['product_content'])){
            $error['product_content'] = "Không để trống mô tả chi tiết sản phẩm";
        }else{
            $product_content = $_POST['product_content'];
        }
        
        //Kiểm tra hình ảnh
        if(empty(check_thumb())){
            $error['thumb'] = "Bạn chưa chọn ảnh";
        }else{
            $thumb = check_thumb();
        }

        //Kiểm tra Danh mục sản phẩm
        if(empty($_POST['parent_id'])){
            $error['cat'] = "Bạn chưa chọn danh mục sản phẩm";
        }else{
            $cat_id = $_POST['parent_id'];

        }
        //Kiểm tra trạng thái
        if(empty($_POST['status'])){
            $error['status'] = "Bạn chưa chọn trạng thái cho sản phẩm";
        }else{
            $status = $_POST['status'];
           
        }

        //Kiểm tra thương hiệu        
        if(empty($_POST['brand'])){
            $error['brand'] = "Bạn chưa chọn thương hiệu";
        }else{
            $brand = $_POST['brand'];
           
        }

        if(empty($error)){
            $new_product = array(
                'product_title' => $product_name,
                'price' => $price,
                'code' => $product_code,
                'product_desc' => $product_desc,
                'thumb' => $thumb,
                'product_content' => $product_content,
                'cat_id' => $cat_id,
                'status' => $status,
                'brand' => $brand,
            );
            // show_array($new_product);
            db_insert("tbl_product", $new_product);
            $error['success'] = "Thêm mới sản phẩm thành công";
        }
    }

    $list_product_cat = get_list_product_cat();    
    $data['list_product_cat'] = $list_product_cat;

    $list_status_cat = get_list_status_cat();
    $data['list_status_cat'] = $list_status_cat;

    $list_brand = get_list_brand();
    $data['list_brand'] = $list_brand;

    load_view('add_product', $data);
}

function deleteAction(){
    $id = (int)$_GET['id'];
    db_delete("`tbl_product`", "`id` = $id");

    indexAction();
}
function delete_catAction(){
    $id = (int)$_GET['id'];
    db_delete("`tbl_product_cat`", "`id` = $id");

    list_catAction();
}

// function searchAction(){
//     $key =  $_GET['s'];
//     //Phân trang
//     $num_per_page = 4; //Số bản ghi trên mỗi trang
//     $total_row = db_num_rows("SELECT * FROM `tbl_product`"); //Tổng số bản ghi
//     $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
//     $page = $_GET['page'];
//     $start  = ($page - 1) * $num_per_page;
//     $data['num_page'] = $num_page;
//     $data['page'] = $page;
//     $data['start'] = $start;

//     //===================//
//     $list_product = get_product_page($start, $num_per_page, " `product_title` LIKE '%{$key}%' ");;
//     $data['list_product'] = $list_product;

//     //Lấy số lượng tất cả sản phẩm
//     $num_product = get_num_product();
//     $data["num_product"] = $num_product;
//     //Lấy số lượng sản phẩm đã đăng
//     $num_product_posted = get_num_product_posted();
//     $data["num_product_posted"] = $num_product_posted;
//     //Lấy số lượng sản phẩm chờ duyệt
//     $num_product_pending = get_num_product_pending();
//     $data["num_product_pending"] = $num_product_pending;
//     load_view('index', $data);
// }


function list_catAction(){
    //Phân trang
    $num_per_page = 4; //Số bản ghi trên mỗi trang
    $total_row = db_num_rows("SELECT * FROM `tbl_product_cat`"); //Tổng số bản ghi
    $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
    $page = $_GET['page'];
    $start  = ($page - 1) * $num_per_page;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;

    //===================//
    $list_product_cat = get_product_cat_page($start, $num_per_page);
    $data['list_product_cat'] = $list_product_cat;
    load_view('list_cat', $data);

}

function add_product_catAction(){
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

        $parent_Cat = $_POST['parent-Cat'];
        if($parent_Cat==0){
            $slug_parent = "";
        }else{
            $slug_parent = create_slug(get_cat_title_by_id($parent_Cat)['cat_title'])."/";
        }

        // if($parent_Cat == 2){
        //     $slug_parent = "may-tinh";
        // }else if($parent_Cat == 3){
        //     $slug_parent = "laptop";
        // }else{
        //     $slug_parent = "dien-thoai";
        // }   
        if(empty($error)){
            $new_cat_product = array(
                'cat_title' => $title,
                'slug' => $slug_parent.create_slug($slug),
                'parent_id' => $parent_Cat,
            );
            db_insert("tbl_product_cat", $new_cat_product);
            $id = (int)get_id_max_product_cat();
            $new_slug = array(
                'slug' => $slug_parent.create_slug($slug)."-$id",
            );
            
            db_update("`tbl_product_cat`", $new_slug, "`id` = $id");
            $error['success'] = "Thêm thành công";
        }
    }
    $list_cat_parent  = get_list_product_cat();
    $data['list_cat_parent'] = $list_cat_parent;
    load_view('add_product_cat', $data);
}

function editAction(){
    $id = (int)$_GET['id'];
    $product = get_product_by_id($id);
    $data['product'] = $product;
    $list_product_cat = get_list_product_cat();    
    $data['list_product_cat'] = $list_product_cat;
    $list_status_cat = get_list_status_cat();
    $data['list_status_cat'] = $list_status_cat;
    global $error;

    if(isset($_POST["btn-upload-thumb"])){
        $data['upload_file'] = get_link_thumb();
        $data['file_name'] = $_FILES['file']['name']; 
    
    }
   

    //Kiểm tra khi submit thêm sản phẩm mới
    if(isset($_POST['btn-submit'])){
        $error = array();
        //Kiểm tra tên sản phẩm
        if(empty($_POST['product_name'])){
            $error['product_name'] = "Không để trống tên sản phẩm";
        }else{
            $product_name = $_POST['product_name'];
        }
        //Kiểm tra mã sản phẩm
        if(empty($_POST['product_code'])){
            $error['product_code'] = "Không để trống mã sản phẩm";
        }else{
            $product_code = $_POST['product_code'];
        }
        //Kiểm tra giá sản phẩm
        if(empty($_POST['price'])){
            $error['price'] = "Không để trống giá sản phẩm";
        }else{
            $price = $_POST['price'];
        }
        //Kiểm tra mô tả ngắn
        if(empty($_POST['product_desc'])){
            $error['product_desc'] = "Không để trống mô tả ngắn sản phẩm";
        }else{
            $product_desc = $_POST['product_desc'];
        }
        //Kiểm tra chi tiết sản phẩm
        if(empty($_POST['product_content'])){
            $error['product_content'] = "Không để trống mô tả chi tiết sản phẩm";
        }else{
            $product_content = $_POST['product_content'];
        }
        
        //Kiểm tra hình ảnh
        if(empty(check_thumb())){
            $thumb = $product['thumb'];
        }else{
            $thumb = check_thumb();
        }

        //Kiểm tra Danh mục sản phẩm
        if(empty($_POST['parent_id'])){
            $error['cat'] = "Bạn chưa chọn danh mục sản phẩm";
        }else{
            $cat_id = $_POST['parent_id'];

        }
        //Kiểm tra trạng thái
        if(empty($_POST['status'])){
            $error['status'] = "Bạn chưa chọn trạng thái cho sản phẩm";
        }else{
            $status = $_POST['status'];
           
        }

        if(empty($error)){
            $edit_product = array(
                'product_title' => $product_name,
                'price' => $price,
                'code' => $product_code,
                'product_desc' => $product_desc,
                'thumb' => $thumb,
                'product_content' => $product_content,
                'cat_id' => $cat_id,
                'status' => $status,
            );
            // show_array($new_product);
            db_update("tbl_product", $edit_product, "`id` = $id");
            redirect("?mod=product&controller=index&page=1");
        }
    }

  
    load_view('edit_product', $data);
}


function edit_catAction() {
    $id = (int)$_GET['id'];
    $product_cat = get_product_cat_by_id($id);
    $data['product_cat'] = $product_cat;
    $list_cat_parent  = get_list_product_cat();
    $data['list_cat_parent'] = $list_cat_parent;
    global $error;
    if(isset($_POST['btn-submit'])){
        $error = array();
        if(empty($_POST['title'])){
            $error['title'] = 'Không để trống title';
        }else{
            $title = $_POST['title'];
        }     

        $parent_Cat = $_POST['parent-Cat'];
        if($parent_Cat==$product_cat['parent_id']){
            $slug_parent = $product_cat['slug'];
        }else{
            $slug_parent = create_slug(get_cat_title_by_id($parent_Cat)['cat_title'])."/".create_slug($product_cat['cat_title'])."-$id";
        }
        
        if(empty($error)){
            $edit_cat_product = array(
                'cat_title' => $title,
                'slug' => $slug_parent,
                'parent_id' => $parent_Cat,
            );
            db_update("tbl_product_cat",$edit_cat_product, "`id` = $id");
           
            $error['success'] = "Edit công";            
        }
    }
    
    load_view('edit_cat', $data);
}
?>
