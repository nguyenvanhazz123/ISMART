<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form enctype="multipart/form-data" action = "" method="POST">
                        <?php echo form_error("success") ?>
                        <label for="product-name">Tên sản phẩm</label>
                        <input type="text" name="product_name" id="product-name">
                        <?php echo form_error("product_name") ?>

                        <label for="product-code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code">
                        <?php echo form_error("product_code") ?>

                        <label for="price">Giá sản phẩm</label>
                        <input type="text" name="price" id="price">
                        <?php echo form_error("price") ?>

                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="desc"></textarea>
                        <?php echo form_error("product_desc") ?>

                        <label for="content">Chi tiết</label>
                        <textarea name="product_content" id="content" class="ckeditor"></textarea>
                        <?php echo form_error("product_content") ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="<?php echo $upload_file ?>">
                        </div>
                        <?php echo form_error("thumb") ?>
                        <label>Danh mục sản phẩm</label>
                        <select name="parent_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php 
                       
                            foreach($list_product_cat as $item){ 
                               
                                ?>                                
                                <option value="<?php echo $item['id'] ?>"><?php echo $item['cat_title'] ?></option>    
                            <?php
                            }
                            ?>

                        </select>
                        <?php echo form_error("parent_id") ?>

                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="">-- Chọn danh mục --</option>
                            <?php 
                            $value = 0;
                            foreach($list_status_cat as $item){ 
                                $value++;
                                ?>                                
                                <option value="<?php echo $value ?>"><?php echo $item['status_name'] ?></option>    
                            <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error("status") ?>

                        
                        <label>Thương hiệu</label>
                        <select name="brand">
                            <option value="">-- Thương hiệu --</option>
                            <?php 
                            
                            foreach($list_brand as $item){                             
                                ?>                                
                                <option value="<?php echo $item['id_brand'] ?>"><?php echo $item['name_brand'] ?></option>    
                            <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error("brand") ?>

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>