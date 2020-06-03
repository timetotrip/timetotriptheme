<?php
/** 
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package timetotrip
 */
 ?>
	<aside id="secondary" class="sidebar">
		<div class="s-wrapper">
			<div class="s-rank  sdw_card">
				<?php 
					echo putH1Index('RANKING'); 
					putPostViewsList();
				 ?>
			</div>
		</div>
	</aside><!-- #secondary -->
	
</div><!--containoer-->