<?php 
get_header();

?>

<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home&controller=index" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <?php ?>    
                    <h3 class="section-title fl-left"><?php if(!empty($cat_product)){ echo $cat_product['cat_title'];} else{ echo "Tìm kiếm";} ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị <?php echo count($list_product) ?> trên <?php echo count($list_product) ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="?mod=product&action=filter">
                                <input type="hidden" name="cat_id" value="<?php if(!empty($_GET['cat_id'])) echo $_GET['cat_id']; else if(!empty($_POST['cat_id'])) echo $_POST['cat_id']; else echo 0?>" />
                                <input type="hidden" name="page" value="<?php if(!empty($_GET['page'])) echo $_GET['page']; else echo $_POST['page'] ?>" />
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php foreach ($list_product as $item){ 
                           
                                // $list_images = get_list_images($item['thumb_id']);
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
                        ?>                 
                        
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                <?php 
                if(!empty($_GET['cat_id'])) $id_cat = $_GET['cat_id']; else if(!empty($_POST['cat_id'])) $id_cat = $_POST['cat_id']; else $id_cat = 0;
                    echo get_pagging($num_page, $page, "?mod=product&controller=index&cat_id=$id_cat");
                ?>                   
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('cat') ?>
            <?php get_sidebar('filter') ?>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
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