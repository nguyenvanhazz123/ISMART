<?php 
$data = db_fetch_array("SELECT * FROM `tbl_product_cat`");

function has_child($data, $id){
    foreach($data as $v){
        if($v['parent_id'] == $id) return true;
    }
    return false;
}
function render_menu($data, $menu_id= "main_menu", $menu_class = "", $parent_id = 0, $level = 0){
    if($level == 0){
        $result = "<ul class='{$menu_class}'>";
    }else{
        $result = "<ul class='sub-menu'>";
    }    
    foreach($data as $v){
        if($v['parent_id'] == $parent_id){
            $result .= "<li>";
            $result .= "<a href='san-pham/{$v['slug']}.html'>{$v['cat_title']}</a>";
           
            if(has_child($data, $v['id'])){
                $result .= render_menu($data, $menu_id, $menu_class, $v['id'], $level + 1);
                
            }

            $result .= "</li>";
        }
    }
    $result.= "</ul>";
    return $result;
}
?>
<div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <?php echo render_menu($data, " ", "list-item")?>
                    <!-- <ul class="list-item">
                        <li>
                            <a href="san-pham/dien-thoai-1.html" title="">Điện thoại</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="san-pham/dien-thoai/sam-sung-11.html" title="">SamSung</a>
                                </li>
                                <li>
                                    <a href="san-pham/dien-thoai/iphone-10.html" title="">Iphone</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="san-pham/dien-thoai/iphone-13-12.html" title="">Iphone 13</a>
                                        </li>
                                        <li>
                                            <a href="san-pham/dien-thoai/iphone-14-13.html" title="">Iphone 14</a>
                                        </li>
                                       
                                    </ul>
                                </li>                              
                            </ul>
                        </li>
                        <li>
                            <a href="san-pham/may-tinh-2.html" title="">Máy tính bảng</a>
                        </li>
                        <li>
                            <a href="san-pham/laptop-3.html" title="">laptop</a>
                        </li>                
                    </ul> -->
                </div>
            </div>