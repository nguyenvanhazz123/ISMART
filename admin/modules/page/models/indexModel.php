<?php
function get_page_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_page` WHERE `id` = $id ");
    return $result;
}
function get_list_status_cat(){
    $result = db_fetch_array("SELECT * FROM `tbl_status_cat`");
    return $result;
}

function get_page_page($start = 1, $num_per_page = 10, $where = "") {
    if(!empty($where)){
        $where = " WHERE {$where}"; 
    }
    $list_page = db_fetch_array("SELECT * FROM `tbl_page` {$where} LIMIT {$start}, {$num_per_page}");
    return $list_page;
}
function get_status_cat_name_by_id($id){
    $result = db_fetch_row("SELECT * FROM `tbl_status_cat` WHERE `id_status` = $id");
    return $result;
}

function get_num_page_pending(){
    $result = db_num_rows("SELECT * FROM `tbl_page` WHERE `status` = 1");
    return $result;
}
function get_num_page_posted(){
    $result = db_num_rows("SELECT * FROM `tbl_page` WHERE `status` = 2");
    return $result;
}
function get_num_page(){
    $result = db_num_rows("SELECT * FROM `tbl_page`");
    return $result;
}

function get_list_page(){
    $sql = "SELECT * FROM `tbl_page`";
    $result = db_fetch_array($sql);
    return $result;
}

function check_thumb(){
    global $thumb;
    if(isset($_FILES['file'])){
        
        $error = array();
        //Thư mục chứa file
        //$upload_dir = 'public/uploads/';
        $upload_dir = '../images/';
       
        //Đường dẫn của file sau khi upload
        $upload_file = $upload_dir.$_FILES['file']['name'];  
    
        #Xử lý upload đúng file ảnh(dựa vào đuôi)
        $type_allow = array('png', 'jpg', 'gif', 'jpeg');
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    
        if(!in_array(strtolower($type), $type_allow)){
            $error["type"] = "Chỉ được upload file có đuôi png, jpg, gif, jpeg";
        }else{
            #Upload file có kích thước cho phép (<20mb ~ 21.000.000)
            $file_size = $_FILES['file']['size'];
            if($file_size > 21000000){
                $error['file_size'] = "Chỉ được up load file < 20mb";
            }
            
            #Kiểm tra đã trùng tên file hay chưa
            //Kiểm tra file đã tồn tại trên hệ thống chưa
            if(file_exists($upload_file)){ 
                #Xử lý đổi tên file tự động
                //Tạo file mới
                $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $new_file_name = $file_name." - Copy.";
                $new_upload_file = $upload_dir.$new_file_name.$type;
                $k = 1;
                while(file_exists($new_upload_file)){
                    $new_file_name = $file_name." - Copy({$k}).";
                    $k++;
                    $new_upload_file = $upload_dir.$new_file_name.$type;
                }
                $upload_file = $new_upload_file;
            }
        }    
        #Kiểm tra file đạt chuẩn
        if(empty($error)){
        //Kiểm tra và thay đường dẫn cũ thành đường dẫn mới             
            if(move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)){                   
                $thumb = "../images/"."{$_FILES['file']['name']}";                                                        
            }else{
                $error['upload_file'] = "Upload file Không thành công";
            }
        }
    } 
    return $thumb;   
}

function get_link_thumb(){
    $link = check_thumb();
    return $link;
}
?>