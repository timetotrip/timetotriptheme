<?php
/**
 * The header for our theme
 *  
 * @package _t
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<script src="https://kit.fontawesome.com/faf0d19c44.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
	<link rel='stylesheet' id='_s-style-css'  href='<?php echo  get_template_directory_uri(); ?>/style.css?date=<?php echo date("His"); ?>' media='all' />
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site back-gradient">

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			$_s_description = get_bloginfo( 'description', 'display' );
			if ( is_front_page() && is_home() ) :
			//フロントページ  
				?>
				
				<div ID="top-story-area">
					<div class="top-story-title" style="background-image:url(<?php echo get_template_directory_uri(); ?>/media/top-min.png);">
						<h1 class="cloud-out sdw2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<p class="cloud-out sdw2"><?php echo $_s_description; ?></p>
					</div>
					
					<div class="top-story-message wave-gradient sdw4 bxrad">
						<p>好きなとき、好きな場所、好きなこと</p>
						<p>自由に旅するには　『準備』　が大切</p>
						<p>準備したぶん、旅はトキメクんだから</p>
					</div>
				</div>
				<?php
			else :
			//下層ページ
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			  ?>
			  
		</div><!-- .site-branding -->
		
		<?php /*
		
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', '_s' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
		*/ ?> 
		
	</header><!-- #masthead -->
