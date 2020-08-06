<?php
/* 
 * コメント投稿文字のカスタマイズ 
 */
//コメント文言を変更
function custom_comment_form_text($args) {
    $args['comment_notes_before'] = '';
    $args['comment_notes_after'] = '';
    $args['label_submit'] = '投稿';
    $args['title_reply'] = 'キミの意見を投稿してね！';
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

 //コメント入力タブ
 add_filter( "comment_form_defaults", "my_comment_form_defaults");
function my_comment_form_defaults($defaults){
//  'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
    $defaults['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true" placeholder="コメントを書こう"></textarea></p>';
    return $defaults;
}
 /* 
 * コメント表示部分のカスタマイズ
 */
class My_Walker_Comment extends Walker_Comment {
    function html5_comment( $comment, $depth, $args ) {
        $ret = "";
        if( get_comment_author( $comment) == get_the_author() ){
            $ret .= putTalk( array('who'=>'taco','where'=>'r'),get_comment_text());
        }
        else{
            $ret .= putTalk( array('who'=>'visitor','where'=>'l', 'v-name'=>get_comment_author( $comment )),get_comment_text());
        }
        echo $ret;
    }
}

?>