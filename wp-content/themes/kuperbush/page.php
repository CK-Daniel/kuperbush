<?php
/**
 * The template for displaying all pages
 */

get_header();
?>

<div id="main-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </article> <!-- .et_pb_post -->
</div> <!-- #main-content -->

<?php
get_footer();