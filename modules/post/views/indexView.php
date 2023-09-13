<?php 
get_header();
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
                       
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Blog</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($list_post as $item){
                             ?>
                                <li class="clearfix">
                                    <a href="chi-tiet-bai-viet/<?php echo create_slug($item['post_title']) ?>-<?php echo  "{$item['post_id']}" ?>.html" title="" class="thumb fl-left">
                                        <img src="<?php echo $item['post_thumb'] ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="chi-tiet-bai-viet/<?php echo create_slug($item['post_title']) ?>-<?php echo  "{$item['post_id']}" ?>.html" title="" class="title"><?php echo $item['post_title'] ?></a>
                                        <span class="create-date"><?php echo date('d/m/Y', $item['post_date']) ?></span>
                                        <p class="desc"><?php echo $item['post_desc'] ?></p>
                                    </div>
                                </li>
                        <?php
                            
                        }?>         
                        
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php
                        echo get_pagging($num_page, $page, "?mod=post&controller=index");
                    ?>
                   
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('hot-product') ?>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_blog_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
get_footer();
?>