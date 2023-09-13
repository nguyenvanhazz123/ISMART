<?php get_header(); ?>

<div id="main-content-wp" class="clearfix detail-blog-page">
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
            <div class="section" id="detail-blog-wp">
                <?php foreach ($list_page as $item){
                    if($item['id'] == $_GET['id']){ ?>
                           <div class="section-head clearfix">
                                <h3 class="section-title"><?php echo $item['page_title'] ?></h3>
                            </div>
                            <div class="section-detail">
                                <span class="create-date"><?php echo date('d/m/Y',$item['create_date']) ?></span>
                                <div class="detail">
                                    <p><?php echo $item['page_content'] ?></p>                                                                     
                                </div>
                                <img style="min-width: 100%; height: auto" src="<?php echo $item['page_thumb'] ?>" >
                            </div>

                <?php
                    }
                }?>
             
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <?php get_sidebar('hot-product'); ?>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>