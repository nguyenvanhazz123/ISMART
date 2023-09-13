<?php 
get_header();

?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="public/images/slider-01.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($list_product as $item){
                            $cat_phone = "26, 27";  
                            $numbers = explode(',', $cat_phone);                
                            if(in_array($item['cat_id'], $numbers)){                             
                                ?>
                                <li>
                                    <a href="chi-tiet-san-pham/<?php echo create_slug($item['product_title']) ?>-<?php echo  "{$item['id']}" ?>.html" title="" class="thumb">
                                        <img src="admin/<?php echo $item['thumb']?>">    
                                   
                                    </a>
                                    <a href="chi-tiet-san-pham/<?php echo create_slug($item['product_title']) ?>-<?php echo  "{$item['id']}" ?>.html" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price'], $suffix = 'đ') ?></span>
                                        <span class="old">6.190.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <button data-id = "<?php echo $item['id'] ?>" title="" class="buyNowToCartBtn add-cart fl-left">Thêm giỏ hàng</button>                                                                            
                                        <a href="?mod=cart&action=add&id=<?php echo $item['id'] ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                        <?php 
                            }
                        } ?>
                        
                        
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">                                                                        
                    <?php foreach ($list_product as $item){          
                            $cat_phone = "1, 10, 11, 12, 13, 14 ,24 ,25";  
                            $numbers = explode(',', $cat_phone);                
                            if(in_array($item['cat_id'], $numbers)){                                
                                ?>
                                <li>
                                    <a href="chi-tiet-san-pham/<?php echo create_slug($item['product_title']) ?>-<?php echo  "{$item['id']}" ?>.html" title="" class="thumb">
                                        <img src="admin/<?php echo $item['thumb'] ?>">    
                                   
                                    </a>
                                    <a href="chi-tiet-san-pham/<?php echo create_slug($item['product_title']) ?>-<?php echo  "{$item['id']}" ?>.html" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price'], $suffix = 'đ') ?></span>
                                        <span class="old">6.190.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <!-- <a href="?mod=cart&action=buy_now&id=<?php echo $item['id'] ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a> -->
                                        <button data-id = "<?php echo $item['id'] ?>" title="" class="buyNowToCartBtn add-cart fl-left">Thêm giỏ hàng</button>                                                                            
                                        <a href="?mod=cart&action=add&id=<?php echo $item['id'] ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                        <?php 
                            }
                        } ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">                                             
                    <?php foreach ($list_product as $item){
                            
                            if($item['cat_id'] == 3){ 
                                //$list_images = get_list_images($item['thumb_id']);
                                // echo "<pre>";
                                // print_r( $list_images);
                                // echo "</pre>";
                                ?>
                                <li>
                                    <a href="chi-tiet-san-pham/<?php echo create_slug($item['product_title']) ?>-<?php echo  "{$item['id']}" ?>.html" title="" class="thumb">
                                        <img src="admin/<?php echo $item['thumb'] ?>">    
                                   
                                    </a>
                                    <a href="chi-tiet-san-pham/<?php echo create_slug($item['product_title']) ?>-<?php echo  "{$item['id']}" ?>.html" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price'], $suffix = 'đ') ?></span>
                                        <span class="old">6.190.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <!-- <a href="?mod=cart&action=add&id=<?php echo $item['id'] ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a> -->
                                        <button data-id = "<?php echo $item['id'] ?>" title="" class="buyNowToCartBtn add-cart fl-left">Thêm giỏ hàng</button>                                                                            
                                        <a href="?mod=cart&action=add&id=<?php echo $item['id'] ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                        <?php 
                            }
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('cat'); ?>
            <?php get_sidebar('hot-product') ?>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
get_footer();
?>