<?php
/**
 * @package Modern WP Themes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>
	<header class="entry-header">
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"> <?php comments_popup_link( __( '0', 'modernwpthemes' ), __( '1', 'modernwpthemes' ), __( '%', 'modernwpthemes' ) ); ?></span>
		<?php endif; ?>

		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			Добавлено: <?php the_time('j F, y'); ?>. Автор - Максим Калмыков
		<!-- .entry-meta --></div>
	<!-- .entry-header --></header>

	<div class="clearfix entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'modernwpthemes' ),
				'after'  => '</div>',
			) );
		?>
	<!-- .entry-content --></div>

	
<!-- #post-<?php the_ID(); ?> --></article>
