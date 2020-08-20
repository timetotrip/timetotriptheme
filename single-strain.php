<?php
    get_header();
?>
<div id="container">
    <main id="primary" class="site-main single">
        <?php
            echo putStrainContent(); 
            echo putInfoScript(); 
        ?>
    </main><!-- #main -->
<?php
    get_sidebar();
    get_footer();
