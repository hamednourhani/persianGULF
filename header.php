<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]--> 
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

       
        <title>Site Tilte</title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="siteUrl" id="siteUrl" content="<?php echo esc_url(home_url()); ?>">
        <!--[if lt IE 8]>
            script type="text/javascript" src="js/lib/html5shiv.js"></script>
        <![endif]--> 
        

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <?php wp_head(); ?>
    </head><!-- head -->
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <div class="body-in-wrapper">
       <header class="top-bar">
           <section class="layout">
               
               <div class="hero" id="banner" role="banner">
                   
                       <hgroup>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url()); ?>">persianGULF Wordpress Theme</a></h1>
                            <h2 class="site-description">New Wordpress Theme</h2>
                        </hgroup><!-- site-title-description -->               
                  
               </div><!-- hero -->

               <div class="navigation">
                    <a class="menu-toggler"><i class="fa fa-navicon"></i></a>
                    <li>
                        <ul class="menu-container">
                           <li class="menu-item item1">menu1</li>
                           <li class="menu-item item2">menu2</li>
                           <li class="menu-item item3">menu3</li>
                           <li class="menu-item item4">menu4</li>
                        </ul>
                    </li>
                   
               </div><!-- navigation -->
           </section><!-- layout -->
       </header><!-- header -->