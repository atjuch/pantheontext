<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php elegant_titles(); ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta name="blogcatalog" content="9BC10318018" />
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />

<link rel="stylesheet" href="/wp-content/themes/unicornbooty2/style.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="http://feeds.feedburner.com/UnicornBootyFeed" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService("ca-pub-1450092088373934");
GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
GA_googleAddSlot("ca-pub-1450092088373934", "Content-BottomSkyscraper");
GA_googleAddSlot("ca-pub-1450092088373934", "Content-Leaderboard");
GA_googleAddSlot("ca-pub-1450092088373934", "Content-MidRight");
GA_googleAddSlot("ca-pub-1450092088373934", "Content-TopRight");
GA_googleAddSlot("ca-pub-1450092088373934", "Homepage-LeaderBoard");
GA_googleAddSlot("ca-pub-1450092088373934", "Homepage-MidRight");
GA_googleAddSlot("ca-pub-1450092088373934", "Homepage-Skyscraper");
GA_googleAddSlot("ca-pub-1450092088373934", "Homepage-TopRight");
GA_googleAddSlot("ca-pub-1450092088373934", "Homepage_LeaderboardBottom");
</script>
<script type='text/javascript'>
GA_googleFetchAds();
</script>



<!--[if lt IE 7]>
    <link rel="stylesheet" type="text/css" href="http://unicornbooty.com/wp-content/themes/unicornbooty2/css/ie6style.css" />
    <script type="text/javascript" src="http://unicornbooty.com/wp-content/themes/unicornbooty2/js/DD_belatedPNG_0.0.8a-min.js"></script>
    <script type="text/javascript">DD_belatedPNG.fix('img#logo, #search-form, .thumbnail .overlay, .big .thumbnail .overlay, .entry-content, .bottom-bg, #controllers span#left-arrow, #controllers span#right-arrow, #content-bottom-bg, .post, #comment-wrap, .post-content, .single-thumb .overlay, .post ul.related-posts li, .hr, ul.nav ul li a, ul.nav ul li a:hover, #comment-wrap #comment-bottom-bg, ol.commentlist, .comment-icon, #commentform textarea#comment, .avatar span.overlay, li.comment, #footer .widget ul a, #footer .widget ul a:hover, #sidebar .widget, #sidebar h3.widgettitle, #sidebar .widgetcontent ul li, #tabbed-area, #tabbed-area li a, #tabbed .tab ul li');</script>
<![endif]-->
<!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="http://unicornbooty.com/wp-content/themes/unicornbooty2/css/ie7style.css" />
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" type="text/css" href="http://unicornbooty.com/wp-content/themes/unicornbooty2/css/ie8style.css" />
<![endif]-->
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>



</head>
 <body <?php body_class($class); ?>>
    <div id="container">
      <div id="container1">
        <div id="container2">

            <div id="headeraddiv">
        <div id="headeraddiv-wrapper">
            <div id="headeraddiv-content">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('HeaderAds') ) : ?>
                <?php endif; ?>
            </div> <!-- end #headeraddiv-content -->

        </div> <!-- end #headeraddiv-wrapper -->
    </div> <!-- end #headeraddiv -->

        <?php if (is_front_page()) { ?>

          <div id="header">
          <a href="/become-a-daily-partner"><img src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/images/badge.png" alt="gay blog" id="badge"/></a>
          <a href="<?php bloginfo('url'); ?>" class="homelink"><img src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/images/gayblogunicornbootylogo.png" alt="gay blog" id="logo"/></a>


              <ul id="topnav">

        <li><a href="/submit-a-storytip">Submit a Tip</a></li>

              </ul>

              <div id="header-bottom" class="clearfix">
                          <?php $menuClass = 'nav';
                    $menuID = 'primary';
                    $primaryNav = '';
                    if (function_exists('wp_nav_menu')) {
                        $primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
                    };
                    if ($primaryNav == '') { ?>
                        <ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
                            <?php if (get_option('thestyle_home_link') == 'on') { ?>
                                <li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php bloginfo('url'); ?>"><?php _e('Home','TheStyle') ?></a></li>
                            <?php }; ?>

                            <?php show_page_menu($menuClass,false,false); ?>

                            <?php show_categories_menu($menuClass,false); ?>
                        </ul> <!-- end ul#nav -->
                    <?php }
                    else echo($primaryNav); ?>


                              </div> <!-- end #header-bottom -->
          </div>

        <?php } else { ?>

          <div id="header2"> <a href="/become-a-daily-partner"><img src="http:///wp-content/themes/unicornbooty2/images/badge.png" alt="gay blog" id="badge"/></a>
          <a href="<?php bloginfo('url'); ?>" class="homelink"><img src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/images/logo2.png" alt="gay blog" id="logo"/></a>
          <a href="/become-a-daily-partner"><img src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/images/directoryad.png" alt="gay blog" id="directoryad"/></a>

          <ul id="topnav">
             <!--<li><a href="#">Business Directory</a></li>-->
             <li><a href="/submit-a-storytip">Submit a Tip</a></li>
          </ul>
              <div id="header-bottom" class="clearfix" style="margin-top:40px;">
                          <?php $menuClass = 'nav';
                    $menuID = 'primary';
                    $primaryNav = '';
                    if (function_exists('wp_nav_menu')) {
                        $primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
                    };
                    if ($primaryNav == '') { ?>
                        <ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
                            <?php if (get_option('thestyle_home_link') == 'on') { ?>
                                <li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php bloginfo('url'); ?>"><?php _e('Home','TheStyle') ?></a></li>
                            <?php }; ?>

                            <?php show_page_menu($menuClass,false,false); ?>

                            <?php show_categories_menu($menuClass,false); ?>
                        </ul> <!-- end ul#nav -->
                    <?php }
                    else echo($primaryNav); ?>


                              </div> <!-- end #header-bottom -->
                              </div>

        <?php } ?>
