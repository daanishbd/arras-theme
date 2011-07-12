<?php
/* Alternate Styles & Layouts Functions */
global $arras_registered_alt_layouts, $arras_registered_style_dirs;

function register_alternate_layout($id, $name) {
	global $arras_registered_alt_layouts;
	$arras_registered_alt_layouts[$id] = $name;
}

function register_style_dir($dir) {
	global $arras_registered_style_dirs;
	$arras_registered_style_dirs[] = $dir;
}

function is_valid_arras_style($file) {
	return (bool)( !preg_match('/^\.+$/', $file) && preg_match('/^[A-Za-z][A-Za-z0-9\-]*.css$/', $file) );
}

function arras_override_styles() {
?>

<!-- Generated by Arras WP Theme -->
<style type="text/css">
<?php do_action('arras_custom_styles'); ?>
</style>
<?php
}

function arras_add_custom_logo() {
	$arras_logo_id = arras_get_option('logo');
	if ($arras_logo_id != 0) {
		$arras_logo = wp_get_attachment_image_src($arras_logo_id, 'full');

		echo '.blog-name a { background: url(' . $arras_logo[0] . ') no-repeat; text-indent: -9000px; width: ' . $arras_logo[1] . 'px; height: ' . $arras_logo[2] . 'px; display: block; }' . "\n";
	}
}

function arras_layout_styles() {
	$sidebar_size = arras_get_image_size('sidebar-thumb');
	$sidebar_size_w = $sidebar_size['w'];
	
	$single_thumb_size = arras_get_image_size('single-thumb');
	?>
	.featured-stories-summary  { margin-left: <?php echo $sidebar_size_w + 15 ?>px; }
	.single .post .entry-photo img, .single-post .entry-photo img  { width: <?php echo $single_thumb_size['w'] ?>px; height: <?php echo $single_thumb_size['h'] ?>px; }
	<?php
}s

function arras_add_layout_css() {
	global $arras_registered_alt_layouts;
	
	if ( count($arras_registered_alt_layouts) > 0 ) {
		
		if ( defined('ARRAS_FORCE_LAYOUT') ) {
			$layout = ARRAS_FORCE_LAYOUT;
		} else {
			$layout = arras_get_option('layout');
		}
	
		?><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/layouts/<?php echo $layout ?>.css" type="text/css" /><?php
	}
}

function arras_add_style_css() {
	global $theme_data, $arras_registered_alt_styles;

	$scheme = arras_get_option('style');
	if ( !isset($scheme) ) $scheme = 'default';

	if ( is_rtl() && file_exists(get_stylesheet_directory() . '/css/styles/' . $scheme . '-rtl.css') ) {
		echo '<link rel="stylesheet" href="' . get_bloginfo('template_url') . '/css/styles/' . $scheme . '-rtl.css" type="text/css" media="screen,projection" />';
	} else {
		echo '<link rel="stylesheet" href="' . get_bloginfo('template_url') . '/css/styles/' . $scheme . '.css" type="text/css" media="screen,projection" />';
	}
}

function arras_add_user_css() {
	if (!ARRAS_CHILD) {
		echo '<link rel="stylesheet" href="' . get_bloginfo('template_url') . '/user.css" type="text/css" media="screen,projection" />';
	} else {
		echo '<link rel="stylesheet" href="' . get_bloginfo('stylesheet_url') . '" type="text/css" media="screen,projection" />';
	}
}

/* End of file styles.php */
/* Location: ./library/styles.php */
