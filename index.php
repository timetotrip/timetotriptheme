<?php
/**
 * The main template file
 * 
 * @package time to trip theme
 */

get_header();
?> 

	<div id="firstview" class="">
		<div class="tp-first sdw_card">
			<div class="tpf-carousel">
				<div class="tpfc-inner">
				<?php 
					putTopPageView('futured', array(),1,'rand');
				?>
				</div>
			</div>
			<div class="tpf-newest1">
			<?php 
				putTopPageView('cannabisculture',array(5),1,'date');
			?>
			</div>
			<div class="tpf-newest2">
			<?php 
				putTopPageView("tripnotes",array(),1,'date');
			?>
			</div>
			<div class="tpf-newest3">
			<?php 
				putTopPageView('tripguide',array(5),1,'date');
			?>
			</div>
		</div>
		
		
	</div>
	
	<div id="container">
	
		<main id="primary" class="site-main">
			<div class="tp-cate">
			
				<div class="tp-intro">
					<?php echo putH1Index('はじめに'); ?>
					<div class="tpc-index sdw_card">
						<?php 
							putTopPageView('atfirst', array(),1,'date', true);
						?>
					</div>
					<div class="tpi-taco">
						<?php 
							echo putTalk( array('who'=>'taco','where'=>'l'),
								"海外情報サイト Time to tripにようこそ！
								タコとイカが海外のルールや常識を伝えるサイトだ
								日本の外に興味をもって、どんどん旅行してほしい"
							);
						?>
					</div>
					<div class="tpi-ika">
						<?php 
							echo putTalk( array('who'=>'ika','where'=>'r'),
								"タコちゃんのインスタもフォローしてあげて！
								<a href=\"https://www.instagram.com/tacoskyhigh/\"><i class=\"fab fa-instagram\"></i>@tacoskyhigh</a>"
							);
						?>
					</div>

				</div>
			
			
				<div class="tpc-1 sdw_card">
					<?php echo putH1Index('大麻文化'); ?>
					<div class="tpc-index">
						<?php 
							putTopPageView('cannabisculture',array(5,39),10,'date', true);
						?>
					</div>
				</div>
				
				<div class="tpc-2 sdw_card">
					<?php echo putH1Index('旅行記'); ?>
					<div class="tpc-index">
						<?php
							putTopPageView('tripnotes',array(5),10,'date', true);
						?>
					</div>
				</div>
				
				<div class="tpc-3 sdw_card">
					<?php echo putH1Index('トリップ'); ?>
					<div class="tpc-index">
						<?php 
							putTopPageView('tripguide',array(5,39),10,'date', true);
						?>
					</div>
				</div>
				
			</div>
		
		</main><!-- #main -->

<?php
get_sidebar();
get_footer();
