

<?php get_header();?>


<?php 
if ( have_posts() ):
    while ( have_posts() ) :  // Loop through the posts
        the_post(); // läser in nästa post som finns

        // title för den aktuella posten
        ?>
        <h2><?php the_title(); ?></h2> 
        <p><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></p>
        <div><?php the_content(); ?></div>
        <p>Född:
        <?php echo get_post_meta(get_the_ID(), 'birth_year', true); ?>
        </p>

        <?php
    endwhile;
else:
    echo "No posts";
endif;

?>


<?php get_footer(); ?>

