<?php
$url_encode=urlencode(get_permalink());
$title_encode=urlencode(get_the_title()).'｜'.get_bloginfo('name');
?>

<div id="sns-share">
    <input type="checkbox" id="sns-share--on">
    <div class="sns-share--area">
        <div class="sns-share--contant">

            <?php 
                echo putH2Index('SNSでシェア');
            ?>
            
            <div class="sns-button">
                <div class="sns-button--fb">
                    <a href="//www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
                        <i class="fab fa-facebook-square"></i><span> facebook</span>
                    </a>
                </div>

                <div class="sns-button--tw">
                    <a href="//twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&tw_p=tweetbutton" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
                        <i class="fab fa-twitter-square"></i><span> tweet</span>
                    </a>
                </div>

                <div class="sns-button--ln">
                    <a href="//social-plugins.line.me/lineit/share?url=<?php echo $url_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=500');return false;">
                        <i class="fab fa-line"></i><span>LINE</span>
                    </a>
                </div>
            </div>
            <div class="sns-button--talk">
                <?php 
                    echo putTalk( array('who'=>'taco','where'=>'l', 'always' => 'true'),
                                        '友達におしえよう！');
                ?>  
            </div> 
        </div> 
        <label for="sns-share--on" class="sns-share--toggle">
            <i class="tglbutton-come"></i>
        </label>
    </div>

</div>