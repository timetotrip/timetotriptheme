<?php
function putHeaderMenu(){
    $ret = '';
    $ret .= '<div id="navimenu">';
    $ret .=     '<input type="checkbox" id="navimenu--on">';
    $ret .=     '<div class="navimenu--area">';
    $ret .=         '<div class="navimenu--contant">';
    $ret .=         putH1Index("Site Menu");; 
    $ret .=         '<p>test</p>'; 
    $ret .=         putMenuCate('futured', array(),0,'date'); 
    $ret .=         putMenuCate('cannabisculture',array(5),0,'date'); 
    $ret .=         putMenuCate("tripnotes",array(5),0,'date'); 
    $ret .=         putMenuCate('tripguide',array(5),0,'date'); 
    $ret .=         '</div>'; 
    $ret .=         '<label for="navimenu--on" class="navimenu--toggle tglbutton-menu">';
    $ret .=             '<span class="tglbutton-menu--bar1"></span>';
    $ret .=             '<span class="tglbutton-menu--bar2"></span>';
    $ret .=             '<span class="tglbutton-menu--bar3"></span>';
    $ret .=         '</label>';
    $ret .=     '</div>';
    $ret .= '</div>';
    return $ret;
}

function putMenuCate( $cate, $not_in, $num, $order){
    $ret = '';

    $wpq = new WP_Query(array(
        'category_name' => $cate,
        'orderby' => $order,
        'category__not_in' => $not_in,
        'posts_per_page' => $num
    ));
    
    if ( $wpq->have_posts() ) :
        $ret .=get_category_by_slug( $cate )->name;
        while ( $wpq->have_posts() ): $wpq->the_post();
            
            
            //if ( has_post_thumbnail() ) : 
                $ret .= '<a class="" href="'. get_permalink().'" >';
                            //.'<img src="'. getThumbnailById(get_post_thumbnail_id())
                            //                . '"" loading="lazy" alt="">'
                            //. '<div class="">';
               // foreach(get_the_category() as $cate):
                //    $ret .=         '<p class="">'.$cate->cat_name .'</p>';
                //endforeach;
                
                $ret .=             '<p class="">'. get_the_title().'</p>';
                
                //$ret .=        '</div>';
                $ret .= '</a>';
            //endif;
        endwhile;
    endif;
    return $ret;
}
?>