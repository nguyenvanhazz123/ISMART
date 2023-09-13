<?php
get_header();
// show_array($list_users);
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="">Tất cả <span class="count">(<?php echo $num_users ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="users">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="page" value="1">
                            <input type="text" name="s" id="s">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="actions">
                        <form method="GET" action="" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option value="1">Xóa</option>
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
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Đơn hàng</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $stt = 0;
                                foreach ($list_users as $item) { 
                                    $stt++;
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $stt ?></h3></span>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $item['fullname'] ?></a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <!-- <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li> -->
                                                <li><a href="?mod=users&action=delete&id=<?php echo $item['user_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item['phone_number'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['email'] ?></span></td>
                                        <td><span class="tbody-text"><?php echo $item['address'] ?></span></td>
                                        <td><span class="tbody-text">1</span></td>
                                        <td><span class="tbody-text"><?php echo date('d-m-Y', $item['create_date']) ?></span></td>
                                    </tr>
                                <?php 
                                }
                                ?>
                               
                                
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-body">STT</span></td>
                                    <td><span class="tfoot-body">Họ và tên</span></td>
                                    <td><span class="tfoot-body">Số điện thoại</span></td>
                                    <td><span class="tfoot-body">Email</span></td>
                                    <td><span class="tfoot-body">Địa chỉ</span></td>
                                    <td><span class="tfoot-body">Đơn hàng</span></td>
                                    <td><span class="tfoot-body">Thời gian</span></td>
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
                        echo get_pagging($num_page, $page, "?mod=users&controller=index");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
get_footer();
?>