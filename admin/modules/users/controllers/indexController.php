<?php 

//Load phần dùng chung construct
function construct(){
    load_model('index');
    load('lib', 'sendmail');
}

function indexAction(){
    //Phân trang
    $num_per_page = 4; //Số bản ghi trên mỗi trang
    $total_row = db_num_rows("SELECT * FROM `tbl_users`"); //Tổng số bản ghi
    $num_page = ceil($total_row/$num_per_page); //Tổng số lượng trang
    $page = $_GET['page'];
    $start  = ($page - 1) * $num_per_page;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;

    if(!empty($_GET['s'])){
        $key = $_GET['s'];
        $list_users = get_product_page($start, $num_per_page, " `fullname` LIKE '%{$key}%' ");;
    }else{       
        $list_users = get_product_page($start, $num_per_page);
    }
    $data['list_users'] = $list_users;

    $num_users = get_num_users();
    $data['num_users'] = $num_users;

    load_view('index', $data);
}

function addAction(){
    echo "Thêm dữ liệu";
}   
function editAction(){
    load('helper', 'format');
    $id = (int)$_GET['id'];
    $user = get_user_by_id($id);
    $data['user'] = $user;
    load_view('edit', $data);
    // show_array($user);

}
function deleteAction(){
    $id = (int)$_GET['id'];
    db_delete("`tbl_users`", "`user_id` = $id");

    indexAction();
}


function loginAction(){
    
    // echo date("d/m/y");
    global $error, $username, $password;
    if(isset($_POST['btn_login'])){
        //Kiểm tra username
        $error = array();
        if(empty($_POST['username'])){
            $error['username'] = "Không được để trống username";
        }else{
            if(!is_username($_POST["username"])){
                $error["username"] = "Username cho phép sử dụng các ký tự chữ số, dấu chấm, dấu gạch dưới và từ 2 đến 32 ký tự"; 
            }else{
                $username = $_POST["username"];
            }
        }
    
        //Kiểm tra  password
        if(empty($_POST["password"])){
            $error["password"] = "Không được để trống Mật khẩu";        
        }else{        
            if(!is_password($_POST["password"])){
                $error["password"] = "Password cho phép sử dụng các ký tự chữ số, chữ cái, ký tự đặc biệt bắt đầu bởi ký tự viết hoa và từ 5 đến 31 ký tự"; 
            }else{
                $password = md5($_POST["password"]);
            }
        }
    
        if(empty($error)){
            if(check_login($username, $password)){
                // if(isset($_POST['remember_me'])){
                //     setcookie('is_login', true, time() + 3600);
                //     setcookie('user_login', $username, time() + 3600);
                // }
                $_SESSION["is_login"] =  true;
                $_SESSION["user_login"] = $username;    
                redirect("?");
            }else{
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            }
        }
    }
    load_view('login');
}

function logoutAction() {
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect('?mod=users&action=login');
}

function resetAction(){
    global $error;
    if(isset($_POST['btn-reset-pass'])){
        $error = array();

        if(empty($_POST['pass-old']) || empty($_POST['pass-new']) || empty($_POST['confirm-pass'])){
            $error["pass_new_confirm"] = "Chưa nhập đủ thông tin";
        }else{
            if(!check_pass_old(user_login() , md5($_POST['pass-old'])) ){
            $error['pass_old'] = "Mật khẩu cũ không chính xác";
        }else{
            if($_POST['pass-new'] != $_POST['confirm-pass']){
                $error['pass_new_confirm'] = "Xác nhận mật khẩu không chính xác";
            }else{
                if(!is_password($_POST['pass-new']) || !is_password($_POST['confirm-pass'])){
                    $error['pass_new_confirm'] = "Mật khẩu mới không đúng định dạng";
                }else{
                    $password = $_POST['pass-new'];
                }
            }
        }
        }

        

        if(empty($error)){
            $data = array(
                'password' => md5($password),
            );
            update_user_login(user_login() ,$data);
        }
    }

    load_view('reset');
}



function updateAction(){

    if(isset($_POST['btn-update'])){
        $error = array();
        if(empty($_POST['full-name'])){
            $error['fullname'] = "Không để trống họ và tên";
        }else{
            $fullname = $_POST['full-name'];
        }        


        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];

        if(empty($error)){
            //update
            $data = array(
                'fullname' => $fullname,
                'phone_number' => $phone_number,
                'address' => $address,
            );
            update_user_login(user_login() ,$data);
        }
    }

    $info_user = get_user_by_username(user_login());
    $data['info_user'] = $info_user;    
    
    load_view('update', $data);
}


?>

