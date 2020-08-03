<?php
function putHeaderMenu(){
    $ret = '';
    $ret .= '<navi id="navimenu">';
    $ret .=     '<input type="checkbox" id="navimenu--on">';
    $ret .=     '<div class="navimenu--area">';
    $ret .=         '<div class="navimenu--contant">';
    $ret .=             putH2Index("Site Menu");
    $ret .=             putMenuCate('futured', array(),0,'date'); 
    $ret .=             putMenuCate('cannabisculture',array(5),0,'date'); 
    $ret .=             putMenuCate("tripnotes",array(5),0,'date'); 
    $ret .=             putMenuCate('tripguide',array(5),0,'date'); 
    $ret .=         '</div>'; 
    $ret .=         '<label for="navimenu--on" class="navimenu--toggle tglbutton-menu">';
    $ret .=             '<span class="tglbutton-menu--bar1"></span>';
    $ret .=             '<span class="tglbutton-menu--bar2"></span>';
    $ret .=             '<span class="tglbutton-menu--bar3"></span>';
    $ret .=         '</label>';
    $ret .=     '</div>';
    $ret .= '</navi>';
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
        $ret .='<div class="navicate">';
        $ret    .='<input type="checkbox" name="navicate" class="navicate--on" id="navicate--' . $cate . '">';
        $ret    .='<label class="navicate--toggle" for="navicate--' . $cate . '">';
        $ret        .= '<div class="navicate--button tglbutton-cate ">';
        $ret            .= '<span class="tglbutton-cate--bar1"></span>';
        $ret            .= '<span class="tglbutton-cate--bar2"></span>';
        $ret        .= '</div>';
        $ret        .= '<h3>' . get_category_by_slug( $cate )->name .'</h3>';
        $ret    .='</label>';

        $ret    .='<div class="navicate--border ptn-str-brown">';
        $ret    .='</div>';

        $ret    .='<div class="navicate--list">';
        while ( $wpq->have_posts() ): $wpq->the_post();
            $ret .= '<a class="" href="'. get_permalink().'" >';
            $ret .=     '<p class="">'. get_the_title().'</p>';
            $ret .= '</a>';
        endwhile;
        $ret    .='</div>';

        $ret .='</div>';
    endif;
    return $ret;
}
?>