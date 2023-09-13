<?php get_header() ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <?php echo form_error("success") ?>

                        <label for="page_name">Tên trang</label>
                        <input type="text" name="page_name" id="page_name">
                        <?php echo form_error("page_name") ?>

                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title">
                        <?php echo form_error("title") ?>

                        <label for="title">Slug ( Friendly_url )</label>
                        <input type="text" name="slug" id="slug">
                        <?php echo form_error("slug") ?>

                        <label for="desc">Mô tả</label>
                        <textarea name="desc" id="desc"></textarea>
                        <?php echo form_error("desc") ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img src="<?php echo $upload_file ?>">
                        </div>
                        <?php echo form_error("thumb") ?>

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

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>