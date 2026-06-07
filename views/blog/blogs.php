<?php
    $list_posts = $PostModel->select_all_posts();

    $list_post_catgories = $PostModel->select_post_category();
?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Bài viết</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<section class="coffee-page-hero coffee-page-hero--blog">
    <div class="container">
        <div class="coffee-page-hero__inner">
            <span class="coffee-page-hero__kicker">Coffee journal</span>
            <h1>B&#224;i vi&#7871;t</h1>
            <p>C&#7853;p nh&#7853;t c&#226;u chuy&#7879;n v&#7873; tr&#224;, c&#224; ph&#234;, menu m&#7899;i v&#224; nh&#7919;ng g&#7907;i &#253; th&#432;&#7903;ng th&#7913;c m&#7895;i ng&#224;y.</p>
        </div>
    </div>
</section>

<!-- Blog Section Begin -->
<section class="blog spad coffee-blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php foreach ($list_posts as $value) {
                        extract($value);
                    ?>
                    <div class="col-lg-6 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <a href="chi-tiet-bai-viet&id=<?=$post_id?>">
                                <div class="blog__item__pic set-bg" data-setbg="upload/<?=$image?>"></div>
                            </a>
                            <div class="blog__item__text">
                                <h6><a href="chi-tiet-bai-viet&id=<?=$post_id?>"><?=$title?></a></h6>
                                <ul>
                                    <li>Tác giả <span><?=$author?></span></li>
                                    <li><?=$created_at?></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <?php 
                    }
                    ?>                
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="blog__sidebar">
                            <div class="blog__sidebar__item">
                                <div class="section-title">
                                    <h4>Chuyên mục</h4>
                                </div>
                                <ul>
                                    <li><a href="bai-viet">Tất cả</span></a></li>
                                    <?php
                                    foreach ($list_post_catgories as $value) {
                                        extract($value);                              
                                    ?>
                                    <li><a href="danh-muc-bai-viet&id=<?=$id?>"><?=$name?> <span>(<?=$qty_post?>)</span></a></li>
                                    <?php
                                    }
                                    ?>
                                    
                                </ul>
                            </div>
                            <div class="blog__sidebar__item">
                                <div class="section-title">
                                    <h4>Bài viết mới</h4>
                                </div>
                                <?php
                                foreach ($list_posts as $value) {
                                    extract($value);
                                
                                ?>
                                <a href="chi-tiet-bai-viet&id=<?=$post_id?>" class="blog__feature__item">
                                    <div class="blog__feature__item__pic">
                                        <img style="max-width: 110px;" src="upload/<?=$image?>" alt="">
                                    </div>
                                    <div class="blog__feature__item__text">
                                        <h6 class="text-truncate-2"><?=$title?></h6>
                                        <span><?=$created_at?></span>
                                    </div>
                                </a>
                                <?php
                                }
                                ?>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>







            <div class="col-lg-12 text-center">
                <a href="#" class="primary-btn load-btn">Xem thêm</a>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
