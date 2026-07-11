<?php
/**
 * Front page template.
 *
 * @package AGTools
 */

get_header();
?>
<main id="main-content">
	<?php get_template_part( 'template-parts/home/hero' ); ?>
	<?php get_template_part( 'template-parts/home/categories' ); ?>
	<?php get_template_part( 'template-parts/home/featured-products' ); ?>
	<?php get_template_part( 'template-parts/home/brands' ); ?>
	<?php get_template_part( 'template-parts/home/benefits' ); ?>
	<?php get_template_part( 'template-parts/home/newsletter' ); ?>
</main>
<?php get_footer(); ?>
