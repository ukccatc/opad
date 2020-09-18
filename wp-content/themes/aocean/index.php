<?php
/**
 * @package Modern WP Themes
 */

get_header(); ?>


	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					//Получение набора меток для каждого поста
					$metki = wp_get_post_terms($post->ID);
					if ($metki[0]->slug == 'private' && isset($_SESSION['userid'])) {
						get_template_part('content', get_post_format());
					}
					if ($metki[0]->slug == 'free') {
						get_template_part('content', get_post_format());
					}
					if ($metki[0]->slug == Null) {
						get_template_part('content', get_post_format());
					}
					?>

				<?php endwhile; ?>

				<?php modernwpthemes_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>


			<!-- #content --></div>
		<!-- #primary --></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


<?php
//$metki = wp_get_post_terms($post->ID);
//var_dump($metki);
//foreach ($metki as $tag) {
//	get_template_part('content', get_post_format());
//}
//get_template_part('content', get_post_format());
//?>