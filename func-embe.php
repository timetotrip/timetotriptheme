<?php
    function putYoutube( $atts, $content = null ) {
        $atts = shortcode_atts( array(
            'id' => '12345',
        ), $atts );
        $div = "";

        $div .= '<div class="embe-ytb">';
        $div .=     '<a class="embe-ytb--a" href="https://www.youtube.com/watch?v=' . $atts['id']. '" class="youtube_pn">';
        $div .=         '<p class="embe-ytb--title">'.$content.'</p>';
        $div .=         '<i class="embe-ytb--icon fab fa-youtube"></i>';
        $div .=         '<img class="embe-ytb--img" src="https://i.ytimg.com/vi/' . $atts['id'] . '/mqdefault.jpg" alt="'.$content.'" loading="lazy"  width="320px" height="180px">';
        $div .=     '</a>';
        $div .= '</div>';

        return $div;
    }
    add_shortcode('ytb', 'putYoutube');


?>