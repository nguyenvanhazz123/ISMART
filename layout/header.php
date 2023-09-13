<?php 
 $list_buy = get_list_buy_cart();
 $data['list_buy'] = $list_buy;

 $list_cart_info = get_cart_info();
 $data['list_cart_info'] = $list_cart_info;

?>


<!DOCTYPE html>
<html>
    <head>
        <title>ISMART STORE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <base href="/unitop.vn/backend/project/ISMART/ismart.com/">
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>

        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
    </head>
    <body>
         
    <!-- Lớp phủ mờ -->
    <div id="success-overlay" class="success-overlay"></div>
    
    <!-- Thông báo thêm vào giỏ hàng thành công -->
    <div id="success-message" class="success-message"> 
        <p>Thêm vào giỏ hàng thành công!</p>
        <div class="success-buttons">
            <button onclick="hideSuccessMessage()">Tiếp tục mua hàng</button>
            <button onclick="viewCart()">Xem giỏ hàng</button>
        </div>
    </div>

        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="trang-chu.html" title="">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="san-pham/dien-thoai-1.html" title="">Sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="bai-viet.html" title="">Blog</a>
                                    </li>
                                    <li>
                                        <a href="gioi-thieu.html" title="">Giới thiệu</a>
                                    </li>
                                    <li>
                                        <a href="lien-he.html" title="">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="?" title="" id="logo" class="fl-left"><img src="public/images/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                <form method="GET" action="">
                                    <input type="hidden" name="mod" value="product">
                                    <input type="hidden" name="action" value="index">
                                    <input type="hidden" name="cat_id" value="0">
                                    <input type="hidden" name="page" value="1">
                                    <input type="text" name="s" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                    <button type="submit" id="sm-s">Tìm kiếm</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">2</span>
                                </a>
                                <div id="cart-wp" class="fl-right">                                    
                                    <div id="btn-cart">
                                        <a style="color: #fff" href="gio-hang.html">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <span id="num"><?php if(!empty($list_buy)) echo count($list_buy) ?></span>
                                        </a>
                                       
                                    </div>
                                    <div id="dropdown">
                                        <?php 
                                        if(!empty($list_buy)){ ?>
                                        
                                            <p class="desc">Có <span><?php echo count($list_buy) ?> sản phẩm</span> trong giỏ hàng</p>
                                            <ul class="list-cart">
                                                <?php 
                                                foreach($list_buy as $item){ ?>
                                                    <li class="clearfix">
                                                        <a href="chi-tiet-san-pham/<?php echo create_slug($item['product_title']) ?>-<?php echo  "{$item['id']}" ?>.html" title="" class="thumb fl-left">
                                                            <img src="<?php echo "{$item['product_thumb']}" ?>  " alt="">
                                                        </a>
                                                        <div class="info fl-right">
                                                            <a href="" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                                            <p class="price"><?php echo currency_format($item['price'], $suffix = 'đ') ?></p>
                                                            <p class="qty">Số lượng: <span><?php echo $item['quantity'] ?></span></p>
                                                        </div>
                                                    </li>
                                                <?php 
                                                }
                                                ?>                                               
                                            </ul>
                                            <div class="total-price clearfix">
                                                <p class="title fl-left">Tổng:</p>
                                                <p class="price fl-right"><?php echo currency_format($list_cart_info['total'], $suffix = 'đ') ?></p>
                                            </div>
                                            <dic class="action-cart clearfix">
                                                <a href="gio-hang.html" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                                <a href="thanh-toan.html" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                            </dic>

                                    <?php }else{ ?>
                                            <p class="desc">Không có sản phẩm nào trong giỏ hàng</p>
                                        <?php
                                        }
                                        ?>
                                    
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>