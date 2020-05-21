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
				putTopPageView('cannabisculture',array(5,39),1,'date');
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
			<div class="tpi-atfirst sdw_card">
				<?php 
					putTopPageView('atfirst', array(),1,'date');
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
		
		<div class="tp-cate tpc-1">
			<h1>大麻文化</h1>
			<?php 
				putTopPageView('cannabisculture',array(5,39),10,'date');
			?>
		</div>
		<div class="tp-cate">
			<h1>ドラッグ</h1>
			<?php 
				putTopPageView('drugculture',array(5,39),10,'date');
			?>
		</div>
		<div class="tp-cate">
			categoly 1
		</div>
		<div class="tp-cate">
			categoly 2
		</div>
		<div class="tp-cate">
			categoly 1
		</div>
		<div class="tp-cate">
			categoly 2
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
