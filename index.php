<?php
/**
 * The main template file
 *
 * @package time to trip theme
 */

get_header();
?>

	<main id="primary" class="site-main" ontouchstart="">
		<div class="tp-first">
			<div class="tpf-carousel">
				<div class="tpfc-inner">
				<?php 
					putTopPageView('futured', array(39),1);
				?>
				</div>
			</div>
			<div class="tpf-atfirst">
			<?php 
				putTopPageView('atfirst', array(),1);
			?>
			</div>
			<div class="tpf-newest1">
			<?php 
				putTopPageView('cannabisculture',array(5,39),1);
			?>
			</div>
			<div class="tpf-newest2">
			<?php 
				putTopPageView('drugculture',array(5,39),1);
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
