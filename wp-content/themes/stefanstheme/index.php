<?php get_header(); ?>

<header class="masthead" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>Clean Blog</h1>
                            <span class="subheading">A Blog Theme by Stefan</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
<div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <?php 
                if ( have_posts() ):
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <div class="post-preview">
                            <a href="<?php the_permalink(); ?>">
                                <h2 class="post-title"><?php the_title(); ?></h2>
                                <h3 class="post-subtitle"><?php the_excerpt(); ?></h3>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
                                on <?php the_date(); ?>
                            </p>
                        </div>
                        <hr class="my-4" />
                        <?php
                    endwhile;
                else:
                    echo "No posts";
                endif

                ?>
            </div>

</div>



<?php get_footer(); ?>