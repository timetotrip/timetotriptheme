<?php


/* * * * * * * * * * * * * * * * * *
 * In link format
 * * * * * * * * * * * * * * * * * */

function putInLink( $ids, $class, $title ){
    $div = '';
    if(count($ids)!=0){
        $div .= '<nav class="inlink inlink--' . $class . '">';
        if(isHTML($title)||(0 === strpos($title, '<'))){
            $div .=     '<span class="inlink--title">' . $title . '</span>';
        }
        else{
            $div .=     '<p class="inlink--title">' . $title . '</p>';
        }

        foreach($ids as $id){
            if($id != 0){
                $div .=     '<a class="inlink--a" href="' . get_the_permalink($id) .'" '
                .                                           putGtagLink("in_".$class) . '>' 
                .               get_the_title($id)
                .           '</a>';
            }
        }
        $div .= '</nav>';
    }
    return $div;
}



/* * * * * * * * * * * * * * * * * *
 * Category
 * * * * * * * * * * * * * * * * * */
function putInLinkCate($cat, $self){
    $ids = array();

    $wpq = new WP_Query(array(
        'cat' => $cat->term_id,
        'category__not_in' => array( 40 ),
        'post__not_in' => array($self),
        'orderby' => 'rand',
        'posts_per_page' => 2
    ));
    if ( $wpq->have_posts() ) :
        while ( $wpq->have_posts() ): $wpq->the_post();
            $ids[] = get_the_ID();
        endwhile;
    endif;
    wp_reset_query();

    return putInLink($ids,"cate","同じカテゴリーの記事");
}




/* * * * * * * * * * * * * * * * * *
 * Suggestion
 * * * * * * * * * * * * * * * * * */
function putInLinkSugg($cat, $self, $tugs){
    $ids = array();

    //同じカテゴリから
    $ids[] = searchSuggIds($cat->term_id, -1,$tugs, $self );
    //違うカテゴリから
    $ids[] = searchSuggIds(-1,$cat->term_id,$tugs, $self );
    wp_reset_query();

    return putInLink($ids,"sugg","似たキーワードの記事");
}

function searchSuggIds( $incat, $outcat, $tugs, $self ){
    $thistugs = array_column($tugs, 'name');
    $maxpoint = 0;
    $retId = 0;
    
    
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
                $retId = get_the_ID();
                $maxpoint = count($sametugs);
            endif;
            
        endwhile;
    endif;
    return $retId;
}
/* * * * * * * * * * * * * * * * * *
 * Futured
 * * * * * * * * * * * * * * * * * */
function putInLinkFutr($self){
    $ids = array();
    $wpq = new WP_Query(array(
        'cat' => 5,
        'post__not_in' => array($self),
        'orderby' => 'rand',
        'posts_per_page' => 2
    ));
    if ( $wpq->have_posts() ) :
        while ( $wpq->have_posts() ): $wpq->the_post();
            $ids[] = get_the_ID();
        endwhile;
    endif;
    wp_reset_query();
    return putInLink($ids,"futr","注目記事");
}


/* * * * * * * * * * * * * * * * * *
 * Random
 * * * * * * * * * * * * * * * * * */
function putInLinkRand($self){
    $ids = array();
    $wpq = new WP_Query(array(
        'category__not_in' => array( 40 ),
        'post__not_in' => array($self),
        'orderby' => 'rand',
        'posts_per_page' => 2,
    ));
    if ( $wpq->have_posts() ) :
        while ( $wpq->have_posts() ): $wpq->the_post();
            $ids[] = get_the_ID();
        endwhile;
    endif;
    wp_reset_query();
    return putInLink($ids,"rand","I'm feeling lucky");
}

function putInLinknavigation(){

    $ids = array();
    if(get_previous_post() != NULL ){
        $ids[] = get_previous_post()->ID;
    }
    else{
        $ids[] = 0;
    }
    if(get_next_post() != NULL){
        $ids[] = get_next_post()->ID;
    }
    else{
        $ids[] = 0;
    }
    return putInLink($ids,"futr","次はこれを読もう！");
}
?>