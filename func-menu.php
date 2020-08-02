<?php
function putHeaderMenu(){
    $ret = '';
    $ret .= '<div id="navimenu">';
    $ret .=     '<input type="checkbox" id="navimenu--on">';
    $ret .=     '<div class="navimenu--area">';
    $ret .=         '<label for="navimenu--on" class="navimenu--toggle">';
    $ret .=         '●●';
    $ret .=         '</label>';
    $ret .=     '</div>';
    $ret .= '</div>';
    return $ret;
}

function putMenuCate( $cate, $not_in, $num, $order, $dect=false ){
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
?>