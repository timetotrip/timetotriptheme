<?php
/**
 * The main template file
 *
 * @package _t
 */

get_header();
?>

	<main id="primary" class="site-main" ontouchstart="">
		<div id="country-list">
<?php
			foreach($countrylist as $cntid => $cnt){
?>
				<div class="country-area cloud-gradient sdw4 bxrad">
					
					<input type="checkbox" id="cnt-tgl-<?php echo $cntid ?>" class="cnt-tgl"> 
					<div class="cnt-tgl-btn">
						<label for="cnt-tgl-<?php echo $cntid; ?>" class="cnt-tgl-icn" >
							<i class="far fa-times-circle"></i>
						</label>
						<label for="cnt-tgl-<?php echo $cntid; ?>" class="cnt-tgl-ttl">
							<h2 class="textgrad-o"><?php echo $cnt->getName(); ?></h2>
						</label>
						<span class="bar-l orange-gradient sdw2"></span>
						<label for="cnt-tgl-<?php echo $cntid; ?>" class="cnt-img-dsc bxrad" style="background-image:url(<?php	echo get_template_directory_uri(); echo "/media/"; echo $cnt->getPict(); ?>);">
							<p><?php echo $cnt->getDesc(); ?></p>
						</label>
						<span class="bar-l orange-gradient sdw2"></span>
					</div>
					
					<div class="cnt-cnt-area">
						<div class="cnt-cnt-tgl">
	<?php
							foreach($cnt->getCitys() as $citid => $cit){
	?>
								<div class="cnt-cit-area">
									<input type="checkbox" id="cit-tgl-<?php echo $citid ?>" class="cit-tgl"> 
									
									<label for="cit-tgl-<?php echo $citid; ?>" class="cit-tgl-ttl" >
										<p class="cit-tgl-icon">
											<i class="fas fa-angle-double-right textgrad-s sdw2"></i>
										</p>
										<span class="bar-s silver-gradient  sdw2"></span>
										<h3 class="textgrad-s sdw2"><?php echo $cit->getName(); ?></h3>
									</label>
									
									<div class="cnt-cat-wrap">
										<img src="<?php echo get_template_directory_uri(); echo "/media/"; echo $cit->getPict();?>" class=" bxrad"></img>
<?php
										foreach($categorylist as $cslag => $cname){
?>
											<p><?php echo $cname; ?></p>
<?php
										}
?>
									</div>
								</div>
							
	<?php
							}
	?>
						<span class="bar-l orange-gradient sdw2"></span>
						</div>
					</div>
				</div>
<?php
				}
?>
			</div>

<?php /*
	<div class="main-index-area">
		<div class="main-country">
			<h2 class="main-country-name">カナダ</h2>
			<p>欧米文化と大自然、アクティビティが魅力のカナダは人気の留学先。</p>
			<h3 class="main-city-name">トロント</h3>
			<div class="main-city-area">
				<img class="main-city-pict" src="/wp-content/uploads/2020/04/toronto.jpg"></img>
				<div class="main-city-text">
					<div class="main-city-dest">
						<p><b>訪れる</b></p>
						
						<a class="main-city-link" href="/"><p>ビザ</p></a>
						<a class="main-city-link" href="/"><p>ESTA</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>移動</b></p>
						<a class="main-city-link" href="/"><p>電車</p></a>
						<a class="main-city-link" href="/"><p>バス</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>住む</b></p>
						<a class="main-city-link" href="/"><p>ホテル</p></a>
						<a class="main-city-link" href="/"><p>安宿</p></a>
						<a class="main-city-link" href="/"><p>賃貸</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>食べる</b></p>
						<a class="main-city-link" href="/"><p>グルメ</p></a>
						<a class="main-city-link" href="/"><p>市場</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>お洒落</b></p>
						<a class="main-city-link" href="/"><p>ブランド</p></a>
						<a class="main-city-link" href="/"><p>買物</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>遊ぶ</b></p>
						<a class="main-city-link" href="/"><p>キャンプ</p></a>
						<a class="main-city-link" href="/"><p>ハイク</p></a>
					</div>
				</div>
			</div>
			<h3 class="main-city-name">バンクーバー</h3>
			<div class="main-city-area">
				<img class="main-city-pict" src="/wp-content/uploads/2020/04/vancouver.jpg"></img>
				<div class="main-city-text">
					<div class="main-city-dest">
						<p><b>訪れる</b></p>
						
						<a class="main-city-link" href="/"><p>ビザ</p></a>
						<a class="main-city-link" href="/"><p>ESTA</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>移動</b></p>
						<a class="main-city-link" href="/"><p>電車</p></a>
						<a class="main-city-link" href="/"><p>バス</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>住む</b></p>
						<a class="main-city-link" href="/"><p>ホテル</p></a>
						<a class="main-city-link" href="/"><p>安宿</p></a>
						<a class="main-city-link" href="/"><p>賃貸</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>食べる</b></p>
						<a class="main-city-link" href="/"><p>グルメ</p></a>
						<a class="main-city-link" href="/"><p>市場</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>お洒落</b></p>
						<a class="main-city-link" href="/"><p>ブランド</p></a>
						<a class="main-city-link" href="/"><p>買物</p></a>
					</div>
					<div class="main-city-dest">
						<p><b>遊ぶ</b></p>
						<a class="main-city-link" href="/"><p>キャンプ</p></a>
						<a class="main-city-link" href="/"><p>ハイク</p></a>
					</div>
				</div>
			</div>
		</div>
	</div>
*/?>

<?php /*
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	
	*/ ?>
	
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
