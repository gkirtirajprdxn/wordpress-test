<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package My_Theme
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel="shortcut icon" href="<?php echo home_url(); ?>/wp-content/themes/mytheme/assets/images/favicon.ico" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=1" />

	<?php wp_head(); ?>

</head>
<body>
  <div class="container">
    <header>
      <div class="wrapper">
        <?php if (function_exists('the_custom_logo')) {
          // the_custom_logo();
          $custom_logo_id = get_theme_mod('custom_logo');
          $logo = wp_get_attachment_image_src($custom_logo_id);
        } ?>
				<h1><a href="<?php echo get_home_url() ?>"><img class="logo" src="<?php echo $logo[0] ?>" alt="logo"><span>WP Test</span></a></h1>

        <div class="mainmenu" id="navigationMenu">
          <nav class="menu">
            <?php $args = array('theme_location' => 'primary');
            wp_nav_menu($args); ?>
          </nav>
        </div>

        <div class="search-field">
          <form action="search" method="get">
            <input type="text" name="search_text" value="<?php echo isset($_GET['search_text']) ? htmlspecialchars($_GET['search_text'], ENT_QUOTES) : ''; ?>">
            <button type="submit" name="">Search</button>
          </form>
        </div>

      </div>
    </header>
    <main class="site-main" id="content">

    
    
    
