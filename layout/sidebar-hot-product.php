<?php 
$list_product = get_list_products();
?>
<div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        
                    <?php foreach ($list_product as $item){
                            
                            if($item['cat_id'] == 1){                            
                                ?>
                               <li class="clearfix">
                                    <a href="?mod=product&action=detail&id=<?php echo $item['id']?>" title="" class="thumb fl-left">
                                        <img src="admin/<?php echo $item['thumb']?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="?mod=product&action=detail&id=<?php echo $item['id']?>" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo currency_format($item['price'], $suffix = 'đ') ?></span>
                                            <span class="old">7.190.000đ</span>
                                        </div>
                                        <a href="?mod=cart&action=add&id=<?php echo $item['id']?>" title="" class="buy-now">Mua ngay</a>
                                    </div>
                                </li>
                        <?php 
                            }
                        } ?>
                        
                    </ul>
                </div>
            </div>