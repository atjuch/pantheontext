<?php

/**
 * Singular Content Template
 */

?>

<?php get_header(); ?>

<div class="main wrap cf">
<div class="row">
<div class="col-8 main-content">
<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
<?php while ( have_posts() ) : the_post(); ?>


    <?php

    $panels = get_post_meta( get_the_ID(), 'panels_data', true );

    if ( ! empty( $panels ) && ! empty( $panels['grid'] ) ):

        get_template_part( 'content', 'builder' );

    else:
        add_filter( 'the_content', function ( $content ) {

            $content        = '<div>' . $content . '</div>';
            $custom_content = '<!-- like block -->
<div class="like-block">    <div class="column half like-article"><h3>Like this Article</h3><div class="fb-like" data-href="' . get_permalink() . '" data-width="50%" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div></div>
<div class="column half like-page"><h3>Like Unicorn Booty</h3><div class="fb-like" data-href="https://facebook.com/unicornbooty/" data-width="50%" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div></div></div><!-- end like block -->';
            $content .= $custom_content;


            return $content;
        }, 0 );

        get_template_part( 'content', 'single' );

    endif;
    ?>
<style>
			div.pp_pic_holder .ppt{display:none !important;}
			</style>
<div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
<?php endwhile; // end of the loop. ?>
    <!-- fb comments -->
<!--    <div class="fb-comments" data-href="--><?php //echo get_permalink();?><!--" data-width="100%" data-numposts="5" data-colorscheme="light" data-version="v2.3"></div>-->

</div>
<style>
		.ppt{display:none !important;}
			</style>
<?php Bunyad::core()->theme_sidebar(); ?>

</div> <!-- .row -->
</div> <!-- .main -->

<?php get_footer(); ?>