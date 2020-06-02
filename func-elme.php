<?php
	define( '_F_ELEM', '1.0.0' );
	
/* * * * * * * * * * * * * * * * * *
 * SESSION
 * * * * * * * * * * * * * * * * * */
/*
function init_session_start(){
  session_start();
}
add_action('init', 'init_session_start');
*/
/* * * * * * * * * * * * * * * * * *
 * LIB
 * * * * * * * * * * * * * * * * * */

function getThumbnailById($image_id){
	$image = wp_get_attachment_image_src( $image_id );
	$image_src = $image[0];
	/*
	$size = $_SESSION['windowSize'];
	
	if($size!=0&&$size<=420){
		$image_src = substr_replace(
			$image_src, "-sm", strrpos($image_src,"."),0 );
	}
	else*/if( ua_smartphone() ){
		$image_src = substr_replace(
			$image_src, "-sm", strrpos($image_src,"."),0 );
	}
	return $image_src;

}
function getImagePath($filename){

	$path = get_template_directory_uri();
	$path .= "/media/";
	
	if( ua_smartphone() ){
		$path .= "sp/";
	}
	else{
		$path .= "pc/";
	}
	
	$path .= $filename;
	
	return $path;
}
function ua_smartphone(){
	//ユーザーエージェントを取得
	$ua = $_SERVER['HTTP_USER_AGENT'];
	//スマホと判定する文字リスト
	$ua_list = array('iPhone','Android');
	 foreach ($ua_list as $ua_smt) {
	//ユーザーエージェントに文字リストの単語を含む場合はTRUE、それ以外はFALSE
		if (strpos($ua, $ua_smt) !== false) {
		 return true;
		}
	 } return false;
}



/* * * * * * * * * * * * * * * * * *
 * TOPPage
 * * * * * * * * * * * * * * * * * */
function putTopPageView( $cate, $not_in, $num, $order, $dect=false ){
$wpq = new WP_Query(array(
		'category_name' => $cate,
		'orderby' => $order,
		'category__not_in' => $not_in,
		'posts_per_page' => $num
	));
	
	if ( $wpq->have_posts() ) :
		while ( $wpq->have_posts() ): $wpq->the_post();
			
			
			if ( has_post_thumbnail() ) : 
				echo "<a class=\"tpv\" href=\""
					. get_permalink()
					."\" >"
					. "<img src=\""
					. getThumbnailById(get_post_thumbnail_id())
					. "\" class=\"tpv-bg\" loading=\"lazy\" alt=\"\">"
					. "<div class=\"tpv-area\">";
				foreach(get_the_category() as $cate):
					echo "<p class=\"tpva-categ\">"
								.$cate->cat_name 
								."</p>";
				endforeach;
				
				echo "<h2 class=\"tpva-title ptn-str-brown-trans\">"
							. get_the_title()
						."</h2>";
				
				if ($dect):
						echo "<div class=\"tpva-dect\">";
							the_excerpt();
						echo "</div>";
				endif;
				echo "</div></a>";
			endif;
		endwhile;
	endif;
	
}
/* * * * * * * * * * * * * * * * * *
 * Elements
 * * * * * * * * * * * * * * * * * */

function putH1Index($title){
	$div = "";
	
	$div .= '<div class="h1-title  sdw_card">'
						.'<div class="h1t-back ptn-str-brown"></div>';
		
		if ($title != ""):
		
		$div .= '<div class="h1t-name">'
							.'<i class="fab fa-gripfire ptn-txgrad-fire"></i>'
							.'<h1 >'. $title .'</h1> '
							.'<i class="fab fa-gripfire ptn-txgrad-fire"></i>';
		else:
		$div .= '<div class="h1t-name h1t-spb">'
							.'<i class="fab fa-gripfire ptn-txgrad-fire"></i>'
							.'<i class="fab fa-gripfire ptn-txgrad-fire"></i>';
		endif;
		$div .= '</div>'
					.'</div>';
	
	return $div;
	
}
/* * * * * * * * * * * * * * * * * *
 * 人気記事
 * * * * * * * * * * * * * * * * * */

// 人気記事出力用関数
function getPostViews($postID){

	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 View";
	}
	return $count.' Views';
	
}
// 記事viewカウント用関数
function setPostViews($postID) {
	
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
	}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
	}
	
}

function putPostViewsList() {
	
	if ( !is_home() && !is_front_page() ) :	
		setPostViews(get_the_ID());
	endif;
	
	$args = array(
		'meta_key' => 'post_views_count',
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
		'posts_per_page' => 5 // ← 5件取得
	);

	$num = 1;

	// WP_Queryによるループ
	$query = new WP_Query($args);
	if ($query->have_posts()) :
		while ($query->have_posts()) :
			$query->the_post();

;
			echo '<a href="'; the_permalink(); echo '" class="vrn vrn-'. $num . '">';
				echo '<img src="'. getThumbnailById(get_post_thumbnail_id()). '" class="vrn-bg" loading="lazy" alt="">';
				echo '<div class="vrn-text  ptn-str-brown-slant">';
					echo '<p class="vrnt-num">' . $num . '</p>';
					echo '<div class="vrnt-title">';
						echo '<p class="vrnt-views">'. getPostViews(get_the_ID()).'</p>';
						echo '<h2 class="vrnt-h2">';
							the_title();
						echo '</h2>';
					echo '</div>';
				echo '</div>';
			echo '</a>';
			
			$num += 1;
		endwhile;
	endif;
	wp_reset_postdata();
}
/* * * * * * * * * * * * * * * * * *
 * パンくず
 * * * * * * * * * * * * * * * * * */
function breadcrumb(){
	global $post;
	$str ='';
	if(!is_home()&&!is_admin()){
		$str.=
		'<div id="breadcrumb" class="cf sdw_card">'
			.'<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="bc-ele">'
				.'<a href="'. home_url() .'" itemprop="url"  class="bce-arrow">'
					.'<span itemprop="title">HOME</span>'
				.'</a>'
			.'</div>';
			
			if(is_category()) {
				$cat = get_queried_object();
				if($cat -> parent != 0){
					$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
					foreach($ancestors as $ancestor){
						$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="bc-ele">'
										.'<a href="'. get_category_link($ancestor) .'" itemprop="url" class="bce-arrow">'
											.'<span itemprop="title">'. get_cat_name($ancestor) .'</span>'
										.'</a>'
									.'</div>';
					}
				}
				$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="bc-ele">'
								.'<a href="'. get_category_link($cat -> term_id). '" itemprop="url" class="bce-arrow">'
									.'<span itemprop="title">'. $cat-> cat_name . '</span>'
								.'</a>'
							.'</div>';

			} 
			elseif(is_page()){
				if($post -> post_parent != 0 ){
					$ancestors = array_reverse(get_post_ancestors( $post->ID ));
					foreach($ancestors as $ancestor){
						$str.= '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="bc-ele">'
										.'<a href="'. get_permalink($ancestor).'" itemprop="url" class="bce-arrow">'
											.'<span itemprop="title">'. get_the_title($ancestor) .'</span>'
										.'</a>'
									.'</div>';
					}
				}
			} 
			elseif(is_single()){
				$categories = get_the_category($post->ID);
				$cat = $categories[0];
				if($cat -> parent != 0){
					$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
					foreach($ancestors as $ancestor){
						$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="bc-ele">'
										.'<a href="'. get_category_link($ancestor).'" itemprop="url" class="bce-arrow">'
											.'<span itemprop="title">'. get_cat_name($ancestor). '</span>'
										.'</a>'
									.'</div>';
					}
				}
				$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="bc-ele">'
								.'<a href="'. get_category_link($cat -> term_id). '" itemprop="url" class="bce-arrow">'
									.'<span itemprop="title">'. $cat-> cat_name . '</span>'
								.'</a>'
							.'</div>';
			}
			else{
				$str.='<div class="bc-ele">'. wp_title('', false) .'</div>';
			}
			$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="bc-ele">'
									.'<a href="'. get_the_permalink(). '" itemprop="url" class="bce-arrow">'
										.'<span itemprop="item">'. get_the_title() . '</span>'
									.'</a>'
								.'</div>';
			$str.='</div>';
		}
		echo $str;
}

/* * * * * * * * * * * * * * * * * *
 * Content
 * * * * * * * * * * * * * * * * * */
function TidyContent( $raw, $putlist ){
	
	$h2s = explode('<h2>',$raw);
	
	
	$beforh2=false;
	$summry = '<div class="sa-h2">'
							.'<i class="fab fa-gripfire ptn-txgrad-fire sdw_card"></i>'
								.'<h2 class="">' .'目次'.'</h2>'
						.'</div>'
						.'<div id="summary" class="ptn-hex-white  sdw_card ">';
	$i=1;
	foreach($h2s as $sent){
		if(mb_strpos($sent,'</h2>')){
			$index = mb_substr($sent, 0, mb_strpos($sent,'</h2>'), 'UTF-8');
			$summry .= '<a href ="#' . $index .'">'
									.'<h3>' . $i . ' . '.$index
									.'</h3>'
								.'</a>';
			$i += 1;
		}
		else{
			$beforh2=true;
		}
	}
	$summry .= '</div>';
	
	$summry .= putTalk( array('who'=>'ika','where'=>'r'),
								'タコちゃんのインスタもフォローしてあげて！</br>'
								.'<a href="https://www.instagram.com/tacoskyhigh/">'
									.'<i class="fab fa-instagram"></i>@tacoskyhigh'
								.'</a>'
								);
	
	$putlist += array('-2'=>$summry); 
	
	$ret = "";
	$i=1;
	foreach($h2s as $sent){
		
		if ( array_key_exists(strval(-1*$i), $putlist) ) {
			$ret .= $putlist[strval(-1*$i)];
		}
		
		if( $i > 1 || $beforh2 == false ){
			$ret .= '<div class="sa-h2">'
								.'<i class="fab fa-gripfire ptn-txgrad-fire sdw_card"></i>'
								.'<h2 id="'.mb_substr($sent, 0, mb_strpos($sent,'</h2>'), 'UTF-8').'">';
			$sent = preg_replace('#<\/h2>#', '</h2></div>', $sent);
		}
		$ret .= $sent;
		
		
		if ( array_key_exists(strval($i), $putlist) ) {
			$ret .= $putlist[strval($i)];
		}
		
		
		$i += 1;
	}
	
	return $ret;
}
/* * * * * * * * * * * * * * * * * *
 * Suggestion
 * * * * * * * * * * * * * * * * * */
function putSuggest( $cat, $tugs, $self ){
	$div = '<div class="sgt-area">';
		$div .= searchSuggest($cat->term_id, -1,$tugs, $self );
		$div .= searchSuggest(-1,$cat->term_id,$tugs, $self );
	$div .= '</div>';
	return $div;
}

function searchSuggest( $incat, $outcat, $tugs, $self ){
	$div = '';
	$thistugs = array_column($tugs, 'name');
	$maxpoint = 0;
	$rettitle = "";
	$retimage = "";
	$retlink = "";
	
	
	$wpq = new WP_Query(array(
		'cat' => $incat,
		'category__not_in' => array( $outcat ),
		'post__not_in' => array($self),
		'posts_per_page' => -1
	));
	if ( $wpq->have_posts() ) :
		while ( $wpq->have_posts() ): $wpq->the_post();
			$sametugs = array_intersect($thistugs,array_column( get_the_tags(), 'name'));
			
			if( $maxpoint <= count($sametugs) ):
				$rettitle = get_the_title();
				$retimage = getThumbnailById(get_post_thumbnail_id());
				$retlink = get_the_permalink();
				$maxpoint = count($sametugs);
			endif;
			
		endwhile;
	endif;
	if ($maxpoint > 0):
	$div = '<div class="sgta-post">'
			. '<a href="' .$retlink . '" class="sug sdw_card">'
						. '<img src="'. $retimage . '" class="sug-bg" loading="lazy" alt="">'
						. '<div class="sug-text  ptn-str-brown-slant">'
						. '<i class="fab fa-gripfire sugt-icon ptn-txgrad-fire"></i>'
							. '<div class="sugt-title">'
								. '<p class="sugt-p">'
									. $rettitle
								. '</p>'
							. '</div>'
						. '</div>'
					. '</a>'
				. '</div>';
	endif;
	return $div;
}

function putFutured(){
	$div = '<div class="ftd-area">';
	$wpq = new WP_Query(array(
		'cat' => 5,
		'orderby' => 'rand',
		'posts_per_page' => 2
	));
	if ( $wpq->have_posts() ) :
		while ( $wpq->have_posts() ): $wpq->the_post();
		
	$div .= '<div class="ftda-post">'
					.'<a href="' .get_the_permalink() . '" class="ftd sdw_card">'
					. '<img src="'. getThumbnailById(get_post_thumbnail_id()) . '" class="ftd-bg" loading="lazy" alt="">'
					. '<div class="ftd-text  ptn-str-brown-slant">'
					. '<i class="fab fa-gripfire ftdt-icon ptn-txgrad-fire"></i>'
						. '<div class="ftdt-title">'
							. '<p class="ftdt-p">'
								. get_the_title()
							. '</p>'
						. '</div>'
					. '</div>'
				. '</a>'
				.'</div>';
		
		endwhile;
	endif;
	
	$div .= '</div>';
	return $div;
}

?>