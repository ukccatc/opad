<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Modern WP Themes
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'modernwpthemes' ); ?></h1>
				<!-- .page-header --></header>

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'modernwpthemes' ); ?></p>

					<?php get_search_form(); ?>

				<!-- .page-content --></div>
			<!-- .error-404 --></section>

		<!-- #content --></div>
	<!-- #primary --></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
