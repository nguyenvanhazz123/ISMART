<?php

function construct(){
    load_model('index');
}

function checkoutAction(){
    $list_buy = get_list_buy_cart();
    $data['list_buy'] = $list_buy;

    $list_cart_info = get_cart_info();
    $data['list_cart_info'] = $list_cart_info;

    load_view("checkout", $data);
}
function showAction(){

    
    $list_buy = get_list_buy_cart();
    $data['list_buy'] = $list_buy;

    $list_cart_info = get_cart_info();
    $data['list_cart_info'] = $list_cart_info;

    load_view('index', $data);
}

function addAction(){
    $id = $_GET['id'];
    add_cart($id);
    showAction();
}
function buy_nowAction(){
    $id = $_POST['id'];
    add_cart($id);
    echo "Them thanh cong";
    
}

function updateAction(){
    if(isset($_POST['btn_update'])){
        update_cart($_POST['quantity']);    
        showAction();
    }
}

function update_ajaxAction(){
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $item = get_product_by_id($id);
    if(isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])){
        $_SESSION['cart']['buy'][$id]['quantity'] = $quantity;

        $sub_total = $item['price'] * $quantity;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;

        update_info_cart();

        $total = $_SESSION['cart']['info']['total'];
    }
    $result = array(
        'sub_total' => currency_format($sub_total),
        'total' => currency_format($total),
    );

    echo json_encode($result);
}
function deleteAction(){
    $id = $_GET['id'];
    delete_cart($id);
    showAction();
}

function orderAction(){
    load('lib', 'sendmail');
    $list_buy = get_list_buy_cart();
    $list_cart_info = get_cart_info();
    
    global $error, $fullname, $email, $address, $phone, $note;
    if(isset($_POST['order-now'])){
        
        $error = array();
        if(empty($_POST['fullname'])){
            $error['fullname'] = "Bạn chưa nhập họ tên";
        }else{
            $fullname = $_POST['fullname'];
        }

        if(empty($_POST['email'])){
            $error['email'] = "Bạn chưa nhập email";
        }else{
            $email = $_POST['email'];
        }

        if(empty($_POST['address'])){
            $error['address'] = "Bạn chưa nhập địa chỉ nhận hàng";
        }else{
            $address = $_POST['address'];
        }

        if(empty($_POST['phone'])){
            $error['phone'] = "Bạn chưa nhập số điện thoại liên hệ";
        }else{
            $phone = $_POST['phone'];
        }
        if($_POST['payment-method'] == "direct-payment"){
            $payments = "Thanh toán tại cửa hàng";
        }else{
            $payments = "Thanh toán tại nhà";
        }
        $note = $_POST['note'];

        if(empty($error)){
            $sent_to_email = $email;
            $sent_to_fullname = $fullname;
            $time = time();
            $Subject ='Đơn hàng từ ISMART';
            $content = "<!DOCTYPE html>
                        <html>
                        <head>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f2f2f2;
                                    margin: 0;
                                    padding: 0;
                                }
                                .container {
                                    max-width: 800px;
                                    margin: 0 auto;
                                    background-color: #ffffff;
                                    border: 1px solid #dddddd;
                                    border-radius: 5px;
                                    overflow: hidden;
                                }
                                h1 {
                                    color: #333333;
                                    background-color: #d6772a;
                                    padding: 20px;
                                    margin: 0;
                                }
                                p {
                                    padding-left: 20px;
                                    margin: 0 0 20px;
                                    color: #555555;
                                }
                                .order-details {
                                    padding: 20px;
                                    border-top: 1px solid #dddddd;
                                    border-bottom: 1px solid #dddddd;
                                }
                                table {
                                    margin-left: 10px;
                                    width: 100%;
                                    border-collapse: collapse;
                                }
                                th, td {
                                    padding: 10px;
                                    text-align: left;
                                }
                                th {
                                    background-color: #f8f8f8;
                                }
                                .product-details {
                                    padding: 20px;
                                    border-bottom: 1px solid #dddddd;
                                }
                                .product-name {
                                    font-weight: bold;
                                }
                                .footer {
                                    padding: 20px;
                                    background-color: #f8f8f8;
                                }
                                .footer p {
                                    color: #777777;
                                }
                            </style>
                        </head>
                        <body>
                            <div class='container'>
                                <h1>Xác nhận đơn hàng - [Số đơn hàng của bạn]</h1>

                                <p>Dear " . "{$sent_to_fullname}" . " ,</p>

                                <p>Cảm ơn bạn đã mua hàng tại cửa hàng chúng tôi! Chúng tôi rất vui thông báo rằng đơn hàng của bạn đã được xác nhận và đang được xử lý. Dưới đây là thông tin chi tiết về đơn hàng của bạn:</p>

                                <div class='order-details'>                     
                                    <p><strong>Ngày đặt hàng:</strong> " . "{$time}" . " </p>
                                    <p><strong>Tổng giá trị đơn hàng:</strong> " . currency_format($list_cart_info['total'], $suffix = 'đ') . " </p>
                                    <p><strong>Phương thức thanh toán:</strong> " . "{$payments}" . "</p>
                                </div>

                                <p>Dưới đây là thông tin về sản phẩm bạn đã mua:</p>

                                <table>
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    foreach ($list_buy as $item){
                                        
                                        $content .=   "<tr>
                                                            <td class='product-name'>" . "{$item['product_title']}" . "</td>
                                                            <td>" . "{$item['quantity']}" . "</td>
                                                            <td>" . currency_format($item['sub_total'], $suffix = 'đ') . "</td>
                                                        </tr>";
                                    
                                    }
                                       
                                    $content .= "</tbody>
                                </table>

                                <p>Vui lòng kiểm tra lại các thông tin trên. Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ thêm, xin vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại đã được cung cấp bên dưới.</p>

                                <p>Chúng tôi sẽ thông báo cho bạn khi đơn hàng của bạn được chuyển đến bộ phận vận chuyển và cung cấp thông tin theo dõi đơn hàng. Dự kiến thời gian giao hàng là [Thời gian giao hàng].</p>

                                <div class='footer'>
                                    <p>Xin cảm ơn sự ủng hộ của bạn!</p>
                                    <p>ISMART</p>
                                    <p>928 Quốc lộ 52, Xa lộ Hà Nội, P, Quận 9, Việt Nam</p>
                                    <p>Email: caovanlun123@gmail.com</p>
                                    <p>Điện thoại: 0999999999</p>
                                </div>
                            </div>
                        </body>
                        </html>
                        ";
            $body = $content;
            send_mail($sent_to_email, $sent_to_fullname, $Subject, $body);  

            //Thêm dữ liệu vào database
            $code = mt_rand();
            $code_order = "UNITOP".$code;
            
                //Thêm đơn hàng
            $newOrder = array(
                'code_order' => $code_order,
                'fullname' => $fullname,
                'address' => $address,
                'payments' => $payments,
                'num_order' => (int)$list_cart_info['num_order'],
                'sum_price' => (int)$list_cart_info['total'],
                'create_date' => (int)time(),
                'status' => 2,
            );         
            db_insert("`tbl_order`", $newOrder);     

                //Thêm chi tiết đơn hàng
            foreach($list_buy as $item){
                $newDetailOrder = array(
                    'code_order' => $code_order,
                    'code_product' => $item['code'],
                    'quantity' => $item['quantity'],
                    'money' => $item['sub_total'],
                );
                db_insert("`tbl_detail_order`", $newDetailOrder);
            }         
            //Xóa dữ liệu trong giỏ hàng và đưa về trang thanh toán thành công
            session_unset();
            session_destroy(); 
            load_view("successOrder");                 
        }

    }
    checkoutAction();
   
}
?>
