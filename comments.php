<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments-view" class="comments-area">
    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
        echo putH2Index('コメント');

        wp_list_comments(array('walker' => new My_Walker_Comment,));
        
        the_comments_navigation();

    else :
        //echo "コメントなし";
    endif; // Check for have_comments().

    
    ?>

</div>
<?php
    if ( ! comments_open() ) :
    else:
        
        $ret = '';
        $ret .= '<div id="comments-post" class="comments-area">';
        $ret .=     '<input type="checkbox" id="comments-post--on">';
        $ret .=     '<div class="comments-post--area">';
        $ret .=         '<div class="comments-post--contant">';
        $ret .=              putH2Index('コメント投稿');
        echo $ret;

        comment_form();

        $ret = '';;
        $ret .=             '<div class="comments-post--talk">';
        $ret .=                 putTalk( array('who'=>'ika','where'=>'r', 'always' => 'true'),
                                    '気軽に書いてほしいか');
        $ret .=                  putTalk( array('who'=>'taco','where'=>'l', 'always' => 'true'),
                                    'チクらないから安心して');
        $ret .=             '</div>';
        $ret .=         '</div>'; 
        $ret .=         '<label for="comments-post--on" class="comments-post--toggle">';
        $ret .=             '<i class="tglbutton-come"></i>';
        $ret .=         '</label>';
        $ret .=     '</div>';
        $ret .= '</div>';
        echo $ret;
    endif;
?>
