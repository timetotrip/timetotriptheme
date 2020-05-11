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
					$wpq = new WP_Query(array(
						'category_name' => 'futured', 
						'orderby' => 'date',
						'posts_per_page' => 1
					));
					// ループ
					if ( $wpq->have_posts() ) :
						while ( $wpq->have_posts() ): $wpq->the_post();
							//echo $post->post_title;
							if ( has_post_thumbnail() ) : 
								echo "<img src=\"" .
									getThumbnailById(get_post_thumbnail_id()) .
									"\" class=\"tpfci-image\"></img>" ;
							endif;
						endwhile;
					endif;
				?>
				</div>
			</div>
			<div class="tpf-atfirst">
			<?php 
				$wpq = new WP_Query(array(
					'category_name' => 'atfirst', 
					'orderby' => 'date',
					'posts_per_page' => 1
				));
				// ループ
				if ( $wpq->have_posts() ) :
					while ( $wpq->have_posts() ): $wpq->the_post();
						//echo $post->post_title;
						if ( has_post_thumbnail() ) : 
							echo "<a href=\""
										. get_permalink()
										."\" >"
										. "<div style=\"background-image:url("
										. getThumbnailById(get_post_thumbnail_id())
										. ")\" class=\"tpfa-area\">";
									foreach(get_the_category() as $cate):
										if ( $cate->cat_slug != "futured"):
										echo "<p class=\"tpfaa-categ\">"
													.$cate->cat_name
													."</p>";
										endif;
									endforeach;
									
									echo "<h2 class=\"tpfaa-title\">"
											. $post->post_title
											."</h2>";
									
							echo "</div></a>";
						endif;
					endwhile;
				endif;
			?>
			</div>
			<div class="tpf-newest1">
				ニュー
			</div>
			<div class="tpf-newest2">
				ニュー
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
