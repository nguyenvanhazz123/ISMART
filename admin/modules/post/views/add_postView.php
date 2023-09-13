<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <?php echo form_error("success") ?>
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title">
                        <?php echo form_error("title") ?>

                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <?php echo form_error("slug") ?>

                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc" class="ckeditor"></textarea>
                        <?php echo form_error("desc") ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="<?php echo $upload_file ?>">
                        </div>
                        <?php echo form_error("thumb") ?>

                        <label>Danh mục cha</label>
                        <select name="parent_Cat">
                            <option value="">-- Chọn danh mục --</option>
                            <?php 
                           
                            foreach($list_post_cat as $item){ 
                              
                                ?>                                
                                <option value="<?php echo $item['id_post_cat'] ?>"><?php echo $item['post_cat_name'] ?></option>    
                            <?php
                            }
                            ?>
                            <!-- <option value="1">Thể thao</option>
                            <option value="2">Xã hội</option>
                            <option value="3">Tài chính</option> -->
                        </select>
                        <?php echo form_error("parent_Cat") ?>

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>