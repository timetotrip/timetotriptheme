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

		
		<div class="tp-cate">
		
			<div class="tp-intro">
				<div class="tpc-title ptn-str-brown">
					<i class="fab fa-gripfire ptn-txgrad-fire"></i>
					<h1 >はじめに</h1>
					<i class="fab fa-gripfire ptn-txgrad-fire"></i>
				</div>
				<div class="tpc-index sdw_card">
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
		
		
			<div class="tpc-1 sdw_card">
				<div class="tpc-title ptn-str-brown">
					<i class="fab fa-gripfire ptn-txgrad-fire"></i>
					<h1 >大麻文化</h1>
					<i class="fab fa-gripfire ptn-txgrad-fire"></i>
				</div>
				<div class="tpc-index">
					<?php 
						putTopPageView('cannabisculture',array(5,39),10,'date');
					?>
				</div>
			</div>
			
			<div class="tpc-2 sdw_card">
				<div class="tpc-title ptn-str-brown">
					<i class="fab fa-gripfire ptn-txgrad-fire"></i>
					<h1 >旅紀行</h1> 
					<i class="fab fa-gripfire ptn-txgrad-fire"></i>
				</div>
				<div class="tpc-index">
					<?php 
						putTopPageView('drugculture',array(5,39),10,'date');
					?>
				</div>
			</div>
			
			<div class="tpc-3 sdw_card">
				<div class="tpc-title ptn-str-brown">
					<i class="fab fa-gripfire ptn-txgrad-fire"></i>
					<h1 >ドラッグ</h1> 
					<i class="fab fa-gripfire ptn-txgrad-fire"></i>
				</div>
				<div class="tpc-index">
					<?php 
						putTopPageView('drugculture',array(5,39),10,'date');
					?>
				</div>
			</div>
			
		</div>
	
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
