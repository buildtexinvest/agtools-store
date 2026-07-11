<?php get_header(); ?>
<main id="main-content" class="container page-content">
<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content/content', 'single' ); comments_template(); endwhile; ?>
</main>
<?php get_footer(); ?>
