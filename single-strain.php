<?php
    get_header();
?>
<div id="container">
    <main id="primary" class="site-main single">
        <?php
            echo putStrainContent(); 
            echo putInfoScript(); 
            get_template_part( 'sns' ); 

            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        ?>
    </main><!-- #main -->
<?php
    get_sidebar();
    get_footer();
