<?php session_start(); ?>
<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Modern WP Themes
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header id="masthead" class="site-header" role="banner">
   		<div class="clearfix container">
			<div class="site-branding">
            
               <?php if ( of_get_option('custom_logo') == '' ): ?>
               
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>

				</<?php echo $heading_tag; ?>>
              
                <?php else : ?>
                
			<?php if ( of_get_option( 'custom_logo' ) ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( of_get_option( 'custom_logo' ) ); ?>" /></a>
			<?php } ?>


                <?php endif; ?>
                
				<?php if ( of_get_option('site_description')=='' ): ?><div class="site-description"><?php bloginfo( 'description' ); ?></div><?php endif; ?>

			<!-- .site-branding --></div>
<!--            Модальное окно-->
				<button class="btn-success modal-1" data-toggle="modal" data-target="#modal-1">
					Информация о пользователе
				</button>
				<div class="modal fade" id='modal-1'>
					<div class="modal-dialog modal-xs">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close" type='button' data-dismiss='modal'>&times</button>
								<h3>Статистика пользователя<h3>
							</div>
							<div class="modal-body">
								<?php if (isset($_SESSION['userid'])) : ?>
										<p>Вы вошли как : <span><?php echo $_SESSION['userinfo']['ФИО'];?></span></p>
										<p>На Вашем счету :  <span><?php echo $_SESSION['userinfo']['Общая сумма'];?> грн</span></p>
										<button type="button" class="btn btn-default">
											<a href="/session_destroy">Выйти</a>
										</button>
								<?php else  : ?>
									<?php	echo "<a href='/billing'>Авторизироваться на сайте</a>"; ?>
								<?php endif; ?>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn-danger" data-dismiss="modal"> Закрыть </button>
							</div>

						</div>
					</div>
			</div>
		</div>
        	<nav id="main-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'container_class' => 'clearfix container sf-menu', 'theme_location' => 'main' ) ); ?>
			<!-- #main-navigation -->
				
			</nav>
	<!-- #masthead --></header> 

	<div id="main" class="site-main">
		<div class="clearfix container">