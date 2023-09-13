<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
       <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Edit danh mục sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_error("success") ?>  
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="title" id="title" value="<?php echo $product_cat['cat_title'] ?>">
                        <?php echo form_error("title") ?>
                        <!-- <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo "{$product_cat['slug']}" ?>">     
                        <?php echo form_error("slug") ?>                  -->
                        <label>Danh mục cha</label>
                        <select name="parent-Cat">
                            <option value="<?php echo $product_cat['parent_id'] ?>"><?php if(get_product_cat_by_id($product_cat['parent_id']) != null) echo get_product_cat_by_id($product_cat['parent_id'])['cat_title']; else echo $product_cat['cat_title']?></option>
                            <?php                        
                            foreach($list_cat_parent as $item){                                 
                                if($item['parent_id'] != $product_cat['parent_id']){
                                ?>                                
                                    <option value="<?php echo $item['id'] ?>"><?php echo $item['cat_title'] ?></option>    
                            <?php
                                }
                            }
                            ?>
                         
                        </select>
                        <?php echo form_error("parent-Cat") ?>           
                        <button type="submit" name="btn-submit" id="btn-submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>