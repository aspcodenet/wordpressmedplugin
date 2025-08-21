<?php
//about theme info
add_action( 'admin_menu', 'sports_agency_gettingstarted' );
function sports_agency_gettingstarted() {
	add_theme_page( esc_html__('Sports Agency', 'sports-agency'), esc_html__('Sports Agency', 'sports-agency'), 'edit_theme_options', 'sports_agency_about', 'sports_agency_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function sports_agency_admin_theme_style() {
	wp_enqueue_style('sports-agency-custom-admin-style', esc_url(get_template_directory_uri()) . '/includes/getstart/getstart.css');
	wp_enqueue_script('sports-agency-tabs', esc_url(get_template_directory_uri()) . '/includes/getstart/js/tab.js');
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );
}
add_action('admin_enqueue_scripts', 'sports_agency_admin_theme_style');

// Changelog
if ( ! defined( 'SPORTS_AGENCY_CHANGELOG_URL' ) ) {
    define( 'SPORTS_AGENCY_CHANGELOG_URL', get_template_directory() . '/readme.txt' );
}

function sports_agency_changelog_screen() {	
	global $wp_filesystem;
	$sports_agency_changelog_file = apply_filters( 'sports_agency_changelog_file', SPORTS_AGENCY_CHANGELOG_URL );
	if ( $sports_agency_changelog_file && is_readable( $sports_agency_changelog_file ) ) {
		WP_Filesystem();
		$sports_agency_changelog = $wp_filesystem->get_contents( $sports_agency_changelog_file );
		$sports_agency_changelog_list = sports_agency_parse_changelog( $sports_agency_changelog );
		echo wp_kses_post( $sports_agency_changelog_list );
	}
}

function sports_agency_parse_changelog( $sports_agency_content ) {
	$sports_agency_content = explode ( '== ', $sports_agency_content );
	$sports_agency_changelog_isolated = '';
	foreach ( $sports_agency_content as $key => $sports_agency_value ) {
		if (strpos( $sports_agency_value, 'Changelog ==') === 0) {
	    	$sports_agency_changelog_isolated = str_replace( 'Changelog ==', '', $sports_agency_value );
	    }
	}
	$sports_agency_changelog_array = explode( '= ', $sports_agency_changelog_isolated );
	unset( $sports_agency_changelog_array[0] );
	$sports_agency_changelog = '<div class="changelog">';
	foreach ( $sports_agency_changelog_array as $sports_agency_value) {
		$sports_agency_value = preg_replace( '/\n+/', '</span><span>', $sports_agency_value );
		$sports_agency_value = '<div class="block"><span class="heading">= ' . $sports_agency_value . '</span></div><hr>';
		$sports_agency_changelog .= str_replace( '<span></span>', '', $sports_agency_value );
	}
	$sports_agency_changelog .= '</div>';
	return wp_kses_post( $sports_agency_changelog );
}

//guidline for about theme
function sports_agency_mostrar_guide() { 
	//custom function about theme customizer
	$sports_agency_return = add_query_arg( array()) ;
	$sports_agency_theme = wp_get_theme( 'sports-agency' );
?>

    <div class="top-head">
		<div class="top-title">
			<h2><?php esc_html_e( 'Sports Agency', 'sports-agency' ); ?></h2>
		</div>
		<div class="top-right">
			<span class="version"><?php esc_html_e( 'Version', 'sports-agency' ); ?>: <?php echo esc_html($sports_agency_theme['Version']);?></span>
		</div>
    </div>

    <div class="inner-cont">
	    <div class="tab-sec">
	    	<div class="tab">
				<button class="tablinks" onclick="sports_agency_open_tab(event, 'wpelemento_importer_editor')"><?php esc_html_e( 'Setup With Elementor', 'sports-agency' ); ?></button>
				<button class="tablinks" onclick="sports_agency_open_tab(event, 'setup_customizer')"><?php esc_html_e( 'Setup With Customizer', 'sports-agency' ); ?></button>
				<button class="tablinks" onclick="sports_agency_open_tab(event, 'changelog_cont')"><?php esc_html_e( 'Changelog', 'sports-agency' ); ?></button>
			</div>

			<div id="wpelemento_importer_editor" class="tabcontent open">
				<?php if(!class_exists('WPElemento_Importer_ThemeWhizzie')){
					$sports_agency_plugin_ins = Sports_Agency_Plugin_Activation_WPElemento_Importer::get_instance();
					$sports_agency_actions = $sports_agency_plugin_ins->sports_agency_recommended_actions;
					?>
					<div class="sports-agency-recommended-plugins ">
						<div class="sports-agency-action-list">
							<?php if ($sports_agency_actions): foreach ($sports_agency_actions as $sports_agency_key => $sports_agency_actionValue): ?>
									<div class="sports-agency-action" id="<?php echo esc_attr($sports_agency_actionValue['id']);?>">
										<div class="action-inner plugin-activation-redirect">
											<h3 class="action-title"><?php echo esc_html($sports_agency_actionValue['title']); ?></h3>
											<div class="action-desc"><?php echo esc_html($sports_agency_actionValue['desc']); ?></div>
											<?php echo wp_kses_post($sports_agency_actionValue['link']); ?>
										</div>
									</div>
								<?php endforeach;
							endif; ?>
						</div>
					</div>
				<?php }else{ ?>
					<div class="tab-outer-box">
						<h3><?php esc_html_e('Welcome to WPElemento Theme!', 'sports-agency'); ?></h3>
						<p><?php esc_html_e('Click on the quick start button to import the demo.', 'sports-agency'); ?></p>
						<div class="info-link">
							<a  href="<?php echo esc_url( admin_url('admin.php?page=wpelementoimporter-wizard') ); ?>"><?php esc_html_e('Quick Start', 'sports-agency'); ?></a>
						</div>
					</div>
				<?php } ?>
			</div>

			<div id="setup_customizer" class="tabcontent">
				<div class="tab-outer-box">
				  	<div class="lite-theme-inner">
						<h3><?php esc_html_e('Theme Customizer', 'sports-agency'); ?></h3>
						<p><?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'sports-agency'); ?></p>
						<div class="info-link">
							<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'sports-agency'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Help Docs', 'sports-agency'); ?></h3>
						<p><?php esc_html_e('The complete procedure to configure and manage a WordPress Website from the beginning is shown in this documentation .', 'sports-agency'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( SPORTS_AGENCY_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'sports-agency'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Need Support?', 'sports-agency'); ?></h3>
						<p><?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'sports-agency'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( SPORTS_AGENCY_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'sports-agency'); ?></a>
						</div>
						<hr>
						<h3><?php esc_html_e('Reviews & Testimonials', 'sports-agency'); ?></h3>
						<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'sports-agency'); ?></p>
						<div class="info-link">
							<a href="<?php echo esc_url( SPORTS_AGENCY_REVIEW ); ?>" target="_blank"><?php esc_html_e('Review', 'sports-agency'); ?></a>
						</div>
						<hr>
						<div class="link-customizer">
							<h3><?php esc_html_e( 'Link to customizer', 'sports-agency' ); ?></h3>
							<div class="first-row">
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','sports-agency'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','sports-agency'); ?></a>
									</div>
								</div>
							
								<div class="row-box">
									<div class="row-box1">
										<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=header_image') ); ?>" target="_blank"><?php esc_html_e('Header Image','sports-agency'); ?></a>
									</div>
									<div class="row-box2">
										<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','sports-agency'); ?></a>
									</div>
								</div>
							</div>
						</div>
				  	</div>
				</div>
			</div>

			<div id="changelog_cont" class="tabcontent">
				<div class="tab-outer-box">
					<?php sports_agency_changelog_screen(); ?>
				</div>
			</div>
		</div>

		<div class="inner-side-content">
			<h2><?php esc_html_e('Premium Theme', 'sports-agency'); ?></h2>
			<div class="tab-outer-box">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" />
				<h3><?php esc_html_e('Sports Agency Theme', 'sports-agency'); ?></h3>
				<div class="iner-sidebar-pro-btn">
					<span class="premium-btn"><a href="<?php echo esc_url( SPORTS_AGENCY_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Premium', 'sports-agency'); ?></a>
					</span>
					<span class="demo-btn"><a href="<?php echo esc_url( SPORTS_AGENCY_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'sports-agency'); ?></a>
					</span>
					<span class="doc-btn"><a href="<?php echo esc_url( SPORTS_AGENCY_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Theme Bundle', 'sports-agency'); ?></a>
					</span>
				</div>
				<hr>
				<div class="premium-coupon">
					<div class="premium-features">
						<h3><?php esc_html_e('premium Features', 'sports-agency'); ?></h3>
						<ul>
							<li><?php esc_html_e( 'Multilingual', 'sports-agency' ); ?></li>
							<li><?php esc_html_e( 'Drag and drop features', 'sports-agency' ); ?></li>
							<li><?php esc_html_e( 'Zero Coding Required', 'sports-agency' ); ?></li>
							<li><?php esc_html_e( 'Mobile Friendly Layout', 'sports-agency' ); ?></li>
							<li><?php esc_html_e( 'Responsive Layout', 'sports-agency' ); ?></li>
							<li><?php esc_html_e( 'Unique Designs', 'sports-agency' ); ?></li>
						</ul>
					</div>
					<div class="coupon-box">
						<h3><?php esc_html_e('Use Coupon Code', 'sports-agency'); ?></h3>
						<a class="coupon-btn" href="<?php echo esc_url( SPORTS_AGENCY_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('UPGRADE NOW', 'sports-agency'); ?></a>
						<div class="coupon-container">
							<h3><?php esc_html_e( 'elemento20', 'sports-agency' ); ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } ?>