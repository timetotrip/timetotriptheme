<?php
/**
 * The main template file
 * 
 * @package time to trip theme
 */

get_header();
?>

	<main id="primary" class="site-main" ontouchstart="">
		<div class="tp-first sdw_card">
			<div class="tpf-carousel">
				<div class="tpfc-inner">
				<?php 
					putTopPageView('futured', array(39),1,'rand');
				?>
				</div>
			</div>
			<div class="tpf-newest1">
			<?php 
				putTopPageView('atfirst', array(),1,'date');
			?>
			</div>
			<div class="tpf-newest2">
			<?php 
				putTopPageView('cannabisculture',array(5,39),1,'date');
			?>
			</div>
			<div class="tpf-newest3">
			<?php 
				putTopPageView('drugculture',array(5,39),1,'date');
			?>
			</div>
		</div>
		<div class="tp-intro">
			<div class="tpi-taco">
				<?php 
					echo putTalk( array("taco","l"),"Hello world");
				?>
			</div>
			<div class="tpi-atfirst sdw_card">
				<?php 
					putTopPageView('atfirst', array(),1,'date');
				?>
			</div>
		</div>
		<div class="tp-cate">
			categoly 1
		</div>
		<div class="tp-cate">
			categoly 2
		</div>
	
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
