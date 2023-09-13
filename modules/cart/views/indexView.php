<?php 
get_header();


?>

<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <h3 class="title">Giỏ hàng</h3>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php 
            if(!empty($list_buy)){ ?>
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        <form action="?mod=cart&action=update" method="post">
                            <table class="table">                        
                                <thead>
                                    <tr>
                                        <td>Mã sản phẩm</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Giá sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td colspan="2">Thành tiền</td> 
                                    </tr>
                                </thead>
                                <tbody>                     
                                        <?php 
                                            foreach($list_buy as $item){ ?>
                                                <tr>
                                                    <td><?php echo "{$item['code']}" ?></td>
                                                    <td>
                                                        <a href="<?php echo "{$item['url']}" ?>" title="" class="thumb">
                                                            <img src="<?php echo "{$item['product_thumb']}" ?>" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo "{$item['url']}" ?>" title="" class="name-product"><?php echo "{$item['product_title']}" ?></a>
                                                    </td>
                                                    <td><?php echo currency_format($item['price'], $suffix = 'đ') ?></td>
                                                    <td>
                                                        <input type="number" min="1" max="10" onkeydown="return false" name="quantity[<?php echo $item['id'] ?>]" value="<?php echo "{$item['quantity']}" ?>" class="num-order" data-id = "<?php echo $item['id'] ?>">
                                                    </td>
                                                    <td id = "sub-total-<?php echo "{$item['id']}" ?>"><?php echo currency_format($item['sub_total'], $suffix = 'đ') ?></td>
                                                    <td>
                                                        
                                                        <a href="?mod=cart&action=delete&id=<?php echo "{$item['id']}" ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>   
                                        <?php
                                            }
                                        ?>
                                                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($list_cart_info['total'], $suffix = 'đ') ?></span></p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <div class="fl-right">
                                                    <input type="submit" id="update-cart" name="btn_update" value="Cập nhật giỏ hàng">
                                                    <!-- <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a> -->
                                                    <a href="thanh-toan.html" title="" id="checkout-cart">Thanh toán</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>                      
                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                        <a href="?" title="" id="buy-more">Mua tiếp</a><br/>
                        <a href="?mod=cart&action=delete&id=" title="" id="delete-cart">Xóa giỏ hàng</a>
                    </div>
                </div>    
        <?php
            }else{ ?>
            <p>Không có sản phẩm trong giỏ hàng</p>
        <?php
            }
        ?>    
       
    </div>
</div>

<?php
get_footer();
?>