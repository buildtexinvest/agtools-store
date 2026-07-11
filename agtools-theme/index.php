<?php get_header(); ?>
<main id="main-content" class="container page-content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content/content', get_post_type() ); endwhile; else : ?><p><?php esc_html_e( 'Nothing found.', 'agtools' ); ?></p><?php endif; ?>
</main>
<?php get_footer(); ?>
