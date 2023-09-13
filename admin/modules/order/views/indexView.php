<?php 
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $num_order ?>)</span></a> |</li>
                            <li class="publish"><a href="">Chờ duyệt <span class="count">(<?php echo $num_order_pending ?>)</span></a> |</li>
                            <li class="pending"><a href="">Đang vận chuyển<span class="count">(<?php echo $num_order_transported ?>)</span> |</a></li>
                            <li class="pending"><a href="">Thành công<span class="count">(<?php echo $num_order_success ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="order">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="page" value="1">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <input type="hidden" name="mod" value="order">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="page" value="1">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Chờ duyệt</option>
                                <option value="2">Đang vận chuyển</option>
                                <option value="3">Thành công</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stt = 0; 
                                foreach ($list_order as $item){
                                   $stt++;
                                   ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $stt ?></h3></span>
                                        <td><span class="tbody-text"><?php echo $item['code_order'] ?></h3></span>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $item['fullname'] ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">                                                
                                                <li><a href="?mod=order&action=delete_order&id='<?php echo $item['id'] ?>'&page=1" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item['num_order'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo currency_format($item['sum_price'], $suffix = 'đ') ?></span></td>
                                        <td><span class="tbody-text"><?php echo get_status_cat_name_by_id($item['status'])['status_order_name'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo date('d-m-Y', $item['create_date']); ?></span></td>
                                        <td><a href="?mod=order&action=detail_order&code_order=<?php echo "{$item['code_order']}" ?>" title="" class="tbody-text">Chi tiết</a></td>
                                    </tr>
                                <?php        
                                }
                                ?>
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                    <td><span class="tfoot-text">Họ và tên</span></td>
                                    <td><span class="tfoot-text">Số sản phẩm</span></td>
                                    <td><span class="tfoot-text">Tổng giá</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                    <td><span class="tfoot-text">Chi tiết</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <?php 
                        echo get_pagging($num_page, $page, "?mod=order&controller=index");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
get_footer();
?>