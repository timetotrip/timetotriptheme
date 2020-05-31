<?php
/**
 * The main template file
 * 
 * @package time to trip theme
 */

get_header();
?> 

	
	<div id="container">
	
		<main id="primary" class="site-main">
			<div class="tp-cate">
			
			
				<div class="tpc-1 sdw_card">
					<?php
					 $cat = get_the_category();
					 echo putH1Index($cat[0]->cat_name);
					 ?>
					<div class="tpc-index">
						<?php 
							putTopPageView($cat[0]->category_nicename,array(),10,'date', true);
						?>
					</div>
				</div>
				
			</div>
		
		</main><!-- #main -->

<?php
get_sidebar();
get_footer();
