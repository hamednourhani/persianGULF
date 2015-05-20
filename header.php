<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
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