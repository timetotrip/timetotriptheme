<?php
/* 
 * コメント投稿文字のカスタマイズ 
 */
//コメント文言を変更
function custom_comment_form_text($args) {
    $args['comment_notes_before'] = 'コメント前';
    $args['comment_notes_after'] = 'コメントあと';
    $args['label_submit'] = 'コメント送信！';
    $args['title_reply'] = 'みんなの意見は？';
    return $args;
}
add_filter('comment_form_defaults', 'custom_comment_form_text');

//コメントからEmailとウェブサイトを削除
function custom_comment_form_remove($arg) {
    $arg['email'] = '';
    $arg['url'] = '';
    $arg['cookies'] = '';
    return $arg;
 }
 add_filter('comment_form_default_fields', 'custom_comment_form_remove');
 
 /* 
 * コメント表示部分のカスタマイズ
 */
/*
 function original_comment_format( $comment, $args, $depth ) {
    $GLOBALS[ 'comment' ] = $comment;
    comment_date();
    comment_time();
    echo get_avatar( $comment, 75 );
    comment_author();
    echo edit_comment_link();
    comment_text();
    echo comment_reply_link();
}
*/
class My_Walker_Comment extends Walker_Comment {
    function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        $ret = "";
        //$ret .= '<br>';
        //$ret .= comment_class( $this->has_children ? 'parent' : '', $comment );
        //$ret .= get_comment_author( $comment );
        //$ret .= esc_html(get_comment_text());
        if( get_comment_author( $comment) == get_the_author() ){
            $ret .= putTalk( array('who'=>'taco','where'=>'r'),get_comment_text());
        }
        else{
            $ret .= putTalk( array('who'=>'visitor','where'=>'l', 'v-name'=>get_comment_author( $comment )),get_comment_text());
        }
        // $ret .= '<br>';

        echo $ret;
    }
}
class Demo_Walker_Comment extends Walker_Comment {
    function html5_comment( $comment, $depth, $args ) {
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
 
        $commenter = wp_get_current_commenter();
        if ( $commenter['comment_author_email'] ) {
            $moderation_note = __( 'Your comment is awaiting moderation.' );
        } else {
            $moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
        }
        ?>

        <!-- コメント-->
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
            <article class="comment-body">
                <div class="comment-meta">
                    <?php echo get_avatar( $comment, 75 ); ?>
                    <!-- コメント投稿者名 -->
                    <div class="comment-author">
                        <?php
                        if( get_comment_author( $comment) == get_the_author() ){
                            echo '記事執筆者 ' . 
                            $ret .= $tag;;
                        }else{
                            echo 'コメント投稿者 ' . get_comment_author( $comment );
                        }
                       ?>
                    </div>
                     
                    <!-- コメント日付 -->
                    <div class="comment-metadata">
                        <time><?php echo get_comment_date( '', $comment ); ?></time>
                        <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                    <?php endif; ?>
                </div>
 
                 <!-- コメント本文 -->
                <div class="comment-content">
                    <?php 
                    $comment_text = esc_html(get_comment_text());
                    echo  '<p class="guest-comment">' . $comment_text . '</p>';
                    ?>
                </div>
                <?php echo comment_reply_link(); ?>
            </article>
        <?php
    }
}

?>