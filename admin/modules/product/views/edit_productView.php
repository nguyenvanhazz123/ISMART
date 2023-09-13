<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Edit sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" action = "" method="POST">                       
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name" value="<?php echo "{$product['product_title']}" ?>">
                        <?php echo form_error("product_name") ?>

                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code"value="<?php echo "{$product['code']}" ?>">
                        <?php echo form_error("product_code") ?>

                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price" value="<?php echo "{$product['price']}" ?>">
                        <?php echo form_error("price") ?>

                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="desc"><?php echo "{$product['product_desc']}" ?></textarea>
                        <?php echo form_error("product_desc") ?>

                        <label for="content">Chi tiết</label>
                        <textarea name="product_content" id="content" class="ckeditor"><?php echo "{$product['product_content']}" ?></textarea>
                        <?php echo form_error("product_content") ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="<?php echo "{$product['thumb']}" ?>">
                        </div>
                        <?php echo form_error("thumb") ?>
                        <label>Danh mục sản phẩm</label>
                        <select name="parent_id">
                            <option value="<?php echo $product['cat_id'] ?>"><?php echo get_product_cat_name_by_id($product['cat_id'])['cat_title'] ?></option>
                            <?php 
                       
                            foreach($list_product_cat as $item){ 
                               if($item['id'] != $product['cat_id']){
                                ?>                                
                                <option value="<?php echo $item['id'] ?>"><?php echo $item['cat_title'] ?></option>    
                            <?php
                                }
                            }
                            ?>

                        </select>
                        <?php echo form_error("parent_id") ?>

                        <label>Trạng thái</label>
                        <select name="status">
                        <option value="<?php echo $product['status'] ?>"><?php echo get_status_cat_name_by_id($product['status'])['status_name'] ?></option>
                            <?php 
                            foreach($list_status_cat as $item){      
                                if($item['id_status'] != $product['status']) {           
                                ?>                                
                                <option value="<?php echo $item['id_status'] ?>"><?php echo $item['status_name'] ?></option>    
                            <?php
                                 }
                            }
                            ?>
                        </select>
                        <?php echo form_error("status") ?>

                        <button type="submit" name="btn-submit" id="btn-submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>