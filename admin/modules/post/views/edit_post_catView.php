<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
    <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Edit danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_error("success") ?>
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="title" id="title" value="<?php echo "{$post_cat['post_cat_name']}" ?>">
                        <?php echo form_error("title") ?>
                        
                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug" value="<?php echo "{$post_cat['slug']}" ?>">
                        <?php echo form_error("slug") ?>
                       
                        <label>Danh mục cha</label>
                        <select name="parent-Cat">
                           
                            <option value="1">Chính nó</option>   
                            <?php                        
                            foreach($list_post_cat as $item){
                                if($item['id_post_cat'] != $post_cat['id_post_cat']){                            
                                ?>                                
                                <option value="<?php echo $item['cat_order'] + 1 ?>"><?php echo $item['post_cat_name'] ?></option>    
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error("parent-Cat") ?>

                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="0">-- Chọn trạng thái --</option>
                            <?php 
                            foreach($list_status_cat as $item){ 
                                ?>                                
                                <option value="<?php echo $item['id_status'] ?>"><?php echo $item['status_name'] ?></option>    
                            <?php
                            }
                            ?>
                        </select>
                        <?php echo form_error("status") ?>

                        <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>