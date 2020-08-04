<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header();
?>

	<div id="container">
		<main id="primary" class="site-main single">

			<?php
			
			
			while ( have_posts() ) :
				the_post();
				$pid = get_the_ID();
				setPostViews($pid);
				
				echo putH1Index("");
				
				echo '<div class="s-firstview sdw_card">'
							.'<img src="'
								. getThumbnailById(get_post_thumbnail_id())
								. '" class="sf-img" loading="lazy" alt="">'
								. '<div class="sf-title">'
									.'<h1>' .get_the_title() . '</h1>'
								. '</div>'
						.'</div>';
				
				breadcrumb(); 
				
				echo "<article>";
					echo TidyContent( do_shortcode( get_the_content() ), array(
						'-3' => putCate((get_the_category())[0], $pid),
						'-4' => putSuggest((get_the_category())[0], get_the_tags() ,$pid),
						'-5' => putFutured(),
						'-6' => putRand($pid)
					));
				echo "</article>";
				wp_reset_query();


				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				the_post_navigation(
					array(
						'prev_text' => 
							'<i class="fas fa-angle-double-left nav-subtitle ptn-txgrad-fire sdw_card"></i>'
							.'<p class="nav-title">%title</p>'
						,
						'next_text' => 
						'<i class="fas fa-angle-double-right nav-subtitle ptn-txgrad-fire sdw_card"></i>'
						.' <p class="nav-title">%title</p>',
					)
				);

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
		
<?php
get_sidebar();
get_footer();
