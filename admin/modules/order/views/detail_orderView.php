<?php get_header() ?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?php echo $item_order['code_order'] ?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?php echo $item_order['address'] ?></span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail"><?php echo $item_order['payments'] ?></span>
                    </li>
                    <form method="POST" action="?mod=order&action=update&id=<?php echo $item_order['id']?>&page=1">
                        <li>
                            <h3 class="title">Tình trạng đơn hàng</h3>
                            <select name="status">
                            <option selected='selected' value='<?php echo $item_order['status'] ?>'><?php echo get_status_cat_name_by_id($item_order['status'])['status_order_name'] ?></option>
                            <?php 
                                foreach($list_status_order as $item){
                                    if($item['id'] != $item_order['status']){ ?>
                                        <option value='<?php echo $item['id'] ?>'><?php echo $item['status_order_name'] ?></option>
                                    <?php 
                                    }
                                }
                            ?>
                            </select>
                            <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                        </li>
                    </form>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $stt = 0;
                            foreach ($list_product_code as $item){ 
                                $stt++;
                                ?>
                                <tr>
                                    <td class="thead-text"><?php echo $stt ?></td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="<?php echo get_product_by_code($item['code_product'])['thumb'] ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="thead-text"><?php echo get_product_by_code($item['code_product'])['product_title'] ?></td>
                                    <td class="thead-text"><?php echo currency_format(get_product_by_code($item['code_product'])['price'], $suffix = 'đ') ?></td>
                                    <td class="thead-text"><?php echo $item['quantity'] ?></td>
                                    <td class="thead-text"><?php echo currency_format($item['money'], $suffix = 'đ') ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $item_order['num_order'] ?> sản phẩm</span>
                            <span class="total"><?php echo currency_format($item_order['sum_price'], $suffix = 'đ') ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php get_footer() ?>