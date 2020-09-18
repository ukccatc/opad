<?php
/**
 * @package Modern WP Themes
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>

	<header class="clearfix entry-header">
<!--		--><?php //if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
<!--		<span class="comments-link"> --><?php //comments_popup_link( __( '0', 'modernwpthemes' ), __( '1', 'modernwpthemes' ), __( '%', 'modernwpthemes' ) ); ?><!--</span>-->
<!--		--><?php //endif; ?>

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
        
		<div class="entry-meta">
			Добавлено: <?php the_time('j F, y'); ?>. Автор - Максим Калмыков
		<!-- .entry-meta --></div>
		<?php endif; ?>
        
	<!-- .entry-header --></header>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="entry-thumb-full">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail( 'thumb-full' ); ?>

			</a>
		</div>

		<div class="entry-summary">
			<?php the_excerpt(); ?>

		<!-- .entry-summary --></div>

	<?php else : ?>

		<div class="clearfix entry-content">
			<?php the_content( __( 'Continue Reading <span class="meta-nav">&rarr;</span>', 'modernwpthemes' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'modernwpthemes' ), 'after' => '</div>' ) ); ?>
			<?php if ($_SERVER['REQUEST_URI'] == '/files/') echo the_tags(); ?>
		<!-- .entry-content --></div>

	<?php endif; ?>


<!-- #post-<?php the_ID(); ?>--></article>