<?php 

//Load phần dùng chung construct
function construct(){
    load_model('index');
    load('lib', 'validation');
    load('lib', 'sendmail');
}

function indexAction(){
    load('helper', 'format');
    $list_users = get_list_users();
    // show_array($list_users);
    $data['list_users'] = $list_users;
    $data['a'] = 100;
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
    delete_user($id);
    indexAction();
}
function regAction(){
    global $error, $username, $password, $email, $fullname;
    
    if(isset($_POST['btn_register'])){
        $error = array();

        //Kiểm tra fullname
        if(empty($_POST['fullname'])){
            $error['fullname'] = "Không được để trống fullname";
        }else{
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra email
        if(empty($_POST['email'])){
            $error['email'] = "Không được để trống email";
        }else{
            if(!is_email($_POST['email'])){
                $error['email'] = "email không đúng định dạng";
            }else{
                $email = $_POST['email'];
            }
        }
        //Kiểm tra username
        if(empty($_POST['username'])){
            $error['username'] = "Không được để trống username";
        }else{
            if(!is_username($_POST['username'])){
                $error['username'] = "Username không đúng định dạng";
            }else{
                $username = $_POST['username'];
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
            //Kiểm tra dữ liệu trùng
            if(user_exists($username, $email) == false){
                $active_token = md5($username.time());
                $data = array(
                    'fullname' => $fullname,
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'active_token' => $active_token,
                    'reg_date' => time() + 86400,
                );
                add_user($data);
                $link_active = base_url("?mod=users&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn {$fullname}</p>
                            <p>Bạn vui lòng click vào đường link này {$link_active} để kích hoạt tài khoản</p>
                            <p>Nếu không phải bạn đăng ký tài khoản thì hãy bỏ qua email này</p>
                            <p>Team support Nguyễn Văn Hà</p>";
                send_mail("nguyenvanhazz123@gmail.com", "Nguyễn Văn Hà", "Kích hoạt tài khoản", $content);
                //Thông báo

                //Chuyển về trang đăng nhập
                // redirect("?mod=users&action=login");
            }
            else{
                $error['account'] = 'Email hoặc username đã tồn tại trên hệ thống';
            }
        }
    
    }
    load_view('reg');
}

function loginAction(){
    global $error, $username, $password;
    if(isset($_POST['btn_login'])){
        //Kiểm tra username
        $error = array();
        if(empty($_POST['username'])){
            $error['username'] = "Không được để trống username";
        }else{
            if(strlen($_POST['username']) < 6 || strlen($_POST['username']) > 32){
                $error['username'] = "Số lượng ký tự phải từ 6 đến 32";
            }
            else{
                if(!is_username($_POST["username"])){
                    $error["username"] = "Username cho phép sử dụng các ký tự chữ số, dấu chấm, dấu gạch dưới và từ 6 đến 32 ký tự"; 
                }else{
                    $username = $_POST["username"];
                }
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

function activeAction(){
    $active_token = $_GET['active_token'];
    if(check_reg_time($active_token) == false){
        echo "Thời gian xác thực đã hết";
    }
    else if(check_active_token($active_token) == true){
        active_user($active_token);   
        $link_login = base_url("?mod=users&action=login");
        echo "Bạn đã kích hoạt thành công! Vui lòng click vào đường link sau để đăng nhập <a href='{$link_login}'>Đăng nhập</a>";
    }
    else{
        echo "Yêu cầu kích hoạt không hợp lệ hoặc tài khoản đã được kích hoạt trước đó";
    }
}

function resetAction() {
    global $error, $username, $password, $new_password;
    if(!empty($_GET['reset_pass_token'])){
        $reset_token = $_GET['reset_pass_token'];
    }
    if(!empty($reset_token)){
        if(check_reset_token($reset_token)){
            if(isset($_POST['btn_new_pass'])){
                $error = array();
                //Kiểm tra  password
                if(empty($_POST["new_password"])){
                    $error["new_password"] = "Không được để trống Mật khẩu";        
                }else{        
                    if(!is_password($_POST["new_password"])){
                        $error["new_password"] = "Password cho phép sử dụng các ký tự chữ số, chữ cái, ký tự đặc biệt bắt đầu bởi ký tự viết hoa và từ 5 đến 31 ký tự"; 
                    }else{
                        $new_password = md5($_POST["new_password"]);
                    }
                }  
                if(empty($error)){
                    $data = array(
                        'password' => $new_password,
                    );
                    update_new_pass($data, $reset_token);
                    
                    redirect("?mod=users&action=resetOk");
                }
            }
            load_view("newpassword");
        }
        else{
            echo "Yeu cau khong hop le";
        }
    }
    else{
        if(isset($_POST['btn_reset'])){
            $error = array();
            //Kiểm tra email
            if(empty($_POST['email'])){
                $error['email'] = "Không được để trống email";
            }else{
                if(!is_email($_POST['email'])){
                    $error['email'] = "email không đúng định dạng";
                }else{
                    $email = $_POST['email'];
                }
            }
        
            if(empty($error)){
                if(check_email($email)){
                    $reset_pass_token = md5($email.time());               
                    $data = array(
                        'reset_pass_token' => $reset_pass_token,
    
                    );
                    //Cập nhật mã token reset cho user cần khôi phục
                    update_reset_token($data, $email);
    
                    //Gửi link khôi phục vào email của người dùng
                    $link_active = base_url("?mod=users&action=reset&reset_pass_token={$reset_pass_token}");
                    $content = "<p>Bạn vui lòng click vào đường link này {$link_active} để khôi phục mật khẩu</p>
                                <p>Nếu không phải bạn muốn khôi phục mật khẩu thì hãy bỏ qua email này</p>
                                <p>Team support Nguyễn Văn Hà</p>";
                    send_mail($email, "", "Khôi phục mật khẩu", $content);
                }else{
                    $error['account'] = "Địa chỉ email không tồn tại trên hệ thống";
                }
            }
        }
        load_view('reset');
    }
   
}

function resetOkAction(){
    load_view('resetOk');
}




?>

