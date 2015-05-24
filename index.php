<?php get_header(); ?>
<?php get_template_part( 'lab/luncher' ); ?>

	 
       
       <div class="main-container" id="app-main-content">
            <div class="main">
                 
            <section class="layout">
                <div class="primary" id="primary">
                    <div class="post-area" id="app-post-area"></div>                   
                    <div class="comment-form" id="app-comment-form"></div> 
                    <div class="comment-area" id="app-comment-area"></div>
                </div><!-- primary -->

                <?php get_sidebar(); ?>
                
            </section><!-- layout -->
        </div><!-- main -->
    </div> <!-- main-container -->



<?php get_footer(); ?>
