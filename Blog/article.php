<?php require_once('header.php') ?>

<section class="trending-posts-area"  style="padding: 50px 0;">
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
            <div class="col-12" style="flex: 0 0 70.333333%; margin: auto;" id="<?= $i ?>">
                <div class="single-post-area mb-80">
                    <!-- Post Thumbnail -->
                    <div class="post-thumbnail">
                        <img src="img/<?= $post['image'] ?>" alt="" style="max-width: 50%;">
                    </div>

                    <!-- Post Content -->
                    <div class="post-content">
                        
                        <a href="#" class="post-cata cata-sm cata-success">Sports</a>
                        <a href="single-post.html" class="post-title"><?= $post['title'] ?></a>
                        <p><?= $post['post'] ?></p>
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

    }  ?>

        
    </div>

</div>
</section>
<!-- ##### Trending Posts Area End ##### -->

<?php require_once('footer.php') ?>