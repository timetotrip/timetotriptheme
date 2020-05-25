<?php
	define( '_F_ELEM', '1.0.0' );
	
/* * * * * * * * * * * * * * * * * *
 * LIB
 * * * * * * * * * * * * * * * * * */

function getThumbnailById($image_id){
	$image = wp_get_attachment_image_src( $image_id );
	$image_src = $image[0];
	
	//Smartphone用の処理を入れる
	if( ua_smartphone() ){
		$image_src = substr_replace(
			$image_src, "-sp", strrpos($image_src,"."),0 );
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
	
	$div .= '<div class="h1-title">'
						.'<div class="h1t-back ptn-str-brown"></div>'
						.'<div class="h1t-name">'
							.'<i class="fab fa-gripfire ptn-txgrad-fire"></i>'
							.'<h1 >'. $title .'</h1> '
							.'<i class="fab fa-gripfire ptn-txgrad-fire"></i>'
						.'</div>'
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
				/*if ( has_post_thumbnail() ): the_post_thumbnail( 'post-thumbnail'); endif; */
				echo '<div class="vrn-text">';
					echo '<p class="vrnt-num">' . $num . '</num>';
					echo '<div class="vrn-title">';
						echo '<p class="vrnt-views">'. getPostViews(get_the_ID()).'</p>';
						echo '<h2>';
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



?>