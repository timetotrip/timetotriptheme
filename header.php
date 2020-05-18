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
	
	<link rel='dns-prefetch' href='//fonts.googleapis.com' />
	<link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
	<script src="https://kit.fontawesome.com/faf0d19c44.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
	
	<link rel='stylesheet' id='_s-style-css'  href='<?php echo  get_template_directory_uri(); ?>/style.css?date=<?php echo date("His"); ?>' media='all' />
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site grd-back">

	<header id="masthead" class="site-header">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<div class="h-area sdw_card" style="background-image:url(<?php echo getImagePath("header.jpg"); ?>);">
				<div class="h-base">
					<div class="h-desc">
						<p>4:20</p>
						<p>時間だ、</p>
						<p>旅にでよう。</p>
					</div>
					<div class="h-name">
						<h1>Time To Trip</h1>
					</div>
					<div class="h-addr">
						<p>420.jpn.com</p>
					</div>
				</div>
			</div>		
		</a>
		
	</header>
