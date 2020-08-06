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