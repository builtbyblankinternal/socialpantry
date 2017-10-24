<?php
/**
 * Twenty Sixteen Customizer functionality
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see twentysixteen_header_style()
 */
function twentysixteen_custom_header_and_background() {
	$color_scheme             = twentysixteen_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[3], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Twenty Sixteen.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'twentysixteen_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Twenty Sixteen.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1920.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'twentysixteen_custom_header_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 1920,
		'height'                 => 550,
		'flex-height'            => true,
		'wp-head-callback'       => 'twentysixteen_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'twentysixteen_custom_header_and_background' );

if ( ! function_exists( 'twentysixteen_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own twentysixteen_header_style() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see twentysixteen_custom_header_and_background().
 */
function twentysixteen_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="twentysixteen-header-css">
		.site-branding {
			margin: 10px auto 0 0;
		}

		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // twentysixteen_header_style

/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function twentysixteen_customize_register( $wp_customize ) {
	$color_scheme = twentysixteen_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	/*$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
		'label'       => __( 'Theme Primary Color', 'twentysixteen' ),
		'section'     => 'colors',
	) ) );*/

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'twentysixteen_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'twentysixteen_customize_partial_blogdescription',
		) );
	}

	/*// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'twentysixteen_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'twentysixteen' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => twentysixteen_get_color_scheme_choices(),
		'priority' => 1,
	) );*/

	

	// Add page background color setting and control.
	$wp_customize->add_setting( 'page_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
		'label'       => __( 'Primary Color', 'twentysixteen' ),
		'section'     => 'colors',
	) ) );

	// Add Secondary color setting and control.
	$wp_customize->add_setting( 'secondary_color', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
		'label'       => __( 'Secondary Color', 'twentysixteen' ),
		'section'     => 'colors',
	) ) );

	
}
add_action( 'customize_register', 'twentysixteen_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Twenty Sixteen 1.2
 * @see twentysixteen_customize_register()
 *
 * @return void
 */
function twentysixteen_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Sixteen 1.2
 * @see twentysixteen_customize_register()
 *
 * @return void
 */
function twentysixteen_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Registers color schemes for Twenty Sixteen.
 *
 * Can be filtered with {@see 'twentysixteen_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return array An associative array of color scheme options.
 */
function twentysixteen_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Twenty Sixteen.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters( 'twentysixteen_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'twentysixteen' ),
			'colors' => array(
				'#1a1a1a',
				'#ffffff',
				'#007acc',
				'#1a1a1a',
				'#686868',
			),
		),
		'dark' => array(
			'label'  => __( 'Dark', 'twentysixteen' ),
			'colors' => array(
				'#262626',
				'#1a1a1a',
				'#9adffd',
				'#e5e5e5',
				'#c1c1c1',
			),
		),
		'gray' => array(
			'label'  => __( 'Gray', 'twentysixteen' ),
			'colors' => array(
				'#616a73',
				'#4d545c',
				'#c7c7c7',
				'#f2f2f2',
				'#f2f2f2',
			),
		),
		'red' => array(
			'label'  => __( 'Red', 'twentysixteen' ),
			'colors' => array(
				'#ffffff',
				'#ff675f',
				'#640c1f',
				'#402b30',
				'#402b30',
			),
		),
		'yellow' => array(
			'label'  => __( 'Yellow', 'twentysixteen' ),
			'colors' => array(
				'#3b3721',
				'#ffef8e',
				'#774e24',
				'#3b3721',
				'#5b4d3e',
			),
		),
	) );
}

if ( ! function_exists( 'twentysixteen_get_color_scheme' ) ) :
/**
 * Retrieves the current Twenty Sixteen color scheme.
 *
 * Create your own twentysixteen_get_color_scheme() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function twentysixteen_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = twentysixteen_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // twentysixteen_get_color_scheme

if ( ! function_exists( 'twentysixteen_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for Twenty Sixteen.
 *
 * Create your own twentysixteen_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return array Array of color schemes.
 */
function twentysixteen_get_color_scheme_choices() {
	$color_schemes                = twentysixteen_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // twentysixteen_get_color_scheme_choices


if ( ! function_exists( 'twentysixteen_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for Twenty Sixteen color schemes.
 *
 * Create your own twentysixteen_sanitize_color_scheme() function to override
 * in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function twentysixteen_sanitize_color_scheme( $value ) {
	$color_schemes = twentysixteen_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}

	return $value;
}
endif; // twentysixteen_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = twentysixteen_get_color_scheme();

	// Convert main text hex color to rgba.
	$color_textcolor_rgb = twentysixteen_hex2rgb( $color_scheme[3] );

	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$colors = array(
		//'background_color'      => $color_scheme[0],
		'page_background_color' => $color_scheme[1],
		'secondary_color'            => $color_scheme[2],
		'main_text_color'       => $color_scheme[3],
		'secondary_text_color'  => $color_scheme[4],
		'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),

	);

	$color_scheme_css = twentysixteen_get_color_scheme_css( $colors );

	wp_add_inline_style( 'twentysixteen-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_color_scheme_css' );

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20160412', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', twentysixteen_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'twentysixteen_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_customize_preview_js() {
	wp_enqueue_script( 'twentysixteen-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20160412', true );
}
add_action( 'customize_preview_init', 'twentysixteen_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function twentysixteen_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		//'background_color'      => '',
		'page_background_color' => '',
		'secondary_color'            => '',
		'main_text_color'       => '',
		'secondary_text_color'  => '',
		'border_color'          => '',
	) );

	return <<<CSS
CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_color_scheme_css_template() {
	$colors = array(
		//'background_color'      => '{{ data.background_color }}',
		'page_background_color' => '{{ data.page_background_color }}',
		'secondary_color'            => '{{ data.secondary_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'secondary_text_color'  => '{{ data.secondary_text_color }}',
		'border_color'          => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-twentysixteen-color-scheme">
		<?php echo twentysixteen_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'twentysixteen_color_scheme_css_template' );

/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_page_background_color_css() {
	$color_scheme          = twentysixteen_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Primary Color */
		.main-navigation a:hover, .main-navigation a:focus, .main-navigation .current-menu-item > a, .port-content, .post-link
		{
			background: %1$s !important;
		}
		.imageContainer:hover {
			border-color: %1$s !important;
		}
	';

	wp_add_inline_style( 'twentysixteen-style', sprintf( $css, $page_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_secondary_color_css() {
	$color_scheme    = twentysixteen_get_color_scheme();
	$default_color   = $color_scheme[2];
	$secondary_color = get_theme_mod( 'secondary_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_color === $default_color ) {
		return;
	}

	$css = '
	/* Secondary Color */
		.site-header-menu.toggled-on, .site-footer, .comment-form-comment textarea, .contact-page-form input[type="text"],.contact-page-form input[type="email"], .contact-page-form textarea
		{
			background: %1$s !important;
		}
	
	';

	wp_add_inline_style( 'twentysixteen-style', sprintf( $css, $secondary_color ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_secondary_color_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_main_text_color_css() {
	$color_scheme    = twentysixteen_get_color_scheme();
	$default_color   = $color_scheme[3];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	// Convert main text hex color to rgba.
	$main_text_color_rgb = twentysixteen_hex2rgb( $main_text_color );

	// If the rgba values are empty return early.
	if ( empty( $main_text_color_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );

	$css = '
	';

	wp_add_inline_style( 'twentysixteen-style', sprintf( $css, $main_text_color, $border_color ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentysixteen_secondary_text_color_css() {
	$color_scheme    = twentysixteen_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		
	';

	wp_add_inline_style( 'twentysixteen-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_secondary_text_color_css', 11 );
