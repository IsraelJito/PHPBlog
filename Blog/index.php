<?php require_once('header.php')?>

<!-- ##### Hero Area Start ##### -->
<section class="hero--area section-padding-80">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="post-1" role="tabpanel" aria-labelledby="post-1-tab">
                        <!-- Single Feature Post -->
                        <div class="single-feature-post video-post bg-img" style="background-image: url(img/bg-img/7.jpg);">

                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="#" class="post-cata">Sports</a>
                                <a href="single-post.html" class="post-title">Reunification of migrant toddlers, parents should be completed Thursday</a>
                                <div class="post-meta d-flex">
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 25</a>
                                    <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 25</a>
                                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 25</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-md-5 col-lg-4">
                <ul class="nav vizew-nav-tab" role="tablist" id="blogul">

                    <?php 
                    $posts = getPosts();
                    while ($post = mysqli_fetch_assoc($posts)) {?>

                        <li class="nav-item">
                            <a class="nav-link active" id="post-1-tab" data-toggle="pill" href="#post-1" role="tab" aria-controls="post-1" aria-selected="true">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post style-2 d-flex align-items-center">
                                    <div class="post-thumbnail">
                                        <img src="img/<?= $post['image'] ?>" alt="">
                                    </div>
                                    <div class="post-content">
                                        <h6 class="post-title"><?= $post['title'] ?></h6>
                                        <div class="post-meta d-flex justify-content-between">
                                            <span><i class="fa fa-comments-o" aria-hidden="true"></i> 25</span>
                                            <span><i class="fa fa-eye" aria-hidden="true"></i> 11</span>
                                            <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 19</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>   
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- ##### Hero Area End ##### -->

<!-- ##### Trending Posts Area Start ##### -->
<section class="trending-posts-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Section Heading -->
                <div class="section-heading">
                    <h4>Trending Videos</h4>
                    <div class="line"></div>
                </div>
            </div>
        </div>

        <div class="row">

           <?php 
           $posts = getPosts();
           $i = 1;
           while ($post = mysqli_fetch_assoc($posts)) {?>
            <!-- Single Blog Post -->
            <div class="col-12 col-md-4">
                <div class="single-post-area mb-80">
                    <!-- Post Thumbnail -->
                    <div class="post-thumbnail">
                        <img src="img/<?= $post['image'] ?>" alt="">
                    </div>

                    <!-- Post Content -->
                    <div class="post-content">
                        
                        <a href="#" class="post-cata cata-sm cata-success">Sports</a>
                        <a href="article.php?#<?= $i ?>" class="post-title"><?= $post['title'] ?></a>
                        <div class="post-meta d-flex">
                            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 22</a>
                            <a href="#"><i class="fa fa-eye" aria-hidden="true"></i> 16</a>
                            <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 15</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php 
            $i++;
            if ($i == 4) {
                break;
            }

    }  ?>

        
    </div>

</div>
</section>
<!-- ##### Trending Posts Area End ##### -->

<?php require_once('footer.php')?>
