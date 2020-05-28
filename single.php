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
					echo TidyContent( do_shortcode( get_the_content() ), array());
				echo "</article>";
				
				/* get_template_part( 'template-parts/content', get_post_type() );*/
				
				
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

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
		
<?php
get_sidebar();
get_footer();
