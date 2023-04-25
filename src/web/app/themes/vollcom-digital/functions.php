<?php
/**
 * WP Bootstrap Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wp_vollcomdigital_Starter
 */

if (!function_exists('wp_vollcomdigital_starter_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wp_vollcomdigital_starter_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on WP Bootstrap Starter, use a find and replace
         * to change 'wp-vollcom-digital' to the name of your theme in all the template files.
         */
        load_theme_textdomain('wp-vollcom-digital', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'wp-vollcom-digital'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('wp_vollcomdigital_starter_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Custom image sizes
        add_image_size('card-img', 350, 250, true);

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        function wp_boostrap_starter_add_editor_styles()
        {
            add_editor_style('custom-editor-style.css');
        }

        add_action('admin_init', 'wp_boostrap_starter_add_editor_styles');

    }
endif;
add_action('after_setup_theme', 'wp_vollcomdigital_starter_setup');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_vollcomdigital_starter_content_width()
{
    $GLOBALS['content_width'] = apply_filters('wp_vollcomdigital_starter_content_width', 1170);
}

add_action('after_setup_theme', 'wp_vollcomdigital_starter_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_vollcomdigital_starter_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'wp-vollcom-digital'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'wp-vollcom-digital'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4 mb-md-0">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title h5 font-weight-bold text-white">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'wp-vollcom-digital'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'wp-vollcom-digital'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4 mb-md-0">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title h5 font-weight-bold text-white">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'wp-vollcom-digital'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'wp-vollcom-digital'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4 mb-md-0">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title h5 font-weight-bold text-white">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'wp-vollcom-digital'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'wp-vollcom-digital'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4 mb-md-0">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title h5 font-weight-bold text-white">',
        'after_title' => '</h3>',
    ));

    /* Footer 4 area */
    register_sidebar(array(
        'name' => esc_html__('Footer 4', 'wp-vollcom-digital'),
        'id' => 'footer-4',
        'description' => esc_html__('Add widgets here.', 'wp-vollcom-digital'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4 mb-md-0">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title h5 font-weight-bold text-white">',
        'after_title' => '</h3>',
    ));

    /* Footer 5 area */
    register_sidebar(array(
        'name' => esc_html__('Footer 5', 'wp-vollcom-digital'),
        'id' => 'footer-5',
        'description' => esc_html__('Add widgets here.', 'wp-vollcom-digital'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title h5 font-weight-bold text-white">',
        'after_title' => '</h3>',
    ));

    /* Subfooter area */
    register_sidebar(array(
        'name' => esc_html__('Subfooter', 'wp-vollcom-digital'),
        'id' => 'subfooter',
        'description' => esc_html__('Add widgets here.', 'wp-vollcom-digital'),
        'before_widget' => '<section id="%1$s" class="widget %2$s legal-menu">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title h5 font-weight-bold text-white">',
        'after_title' => '</h3>',
    ));

}

add_action('widgets_init', 'wp_vollcomdigital_starter_widgets_init');


/**
 * Enqueue scripts and styles.
 */
function wp_vollcomdigital_starter_scripts()
{
    // load bootstrap css
    wp_enqueue_style('wp-vollcom-digital-bootstrap-css', get_template_directory_uri() . '/inc/assets/css/bootstrap.min.css');
    wp_enqueue_style('wp-vollcom-digital-fontawesome-css', get_template_directory_uri() . '/inc/assets/css/fontawesome.min.css');

    // load WP Bootstrap Starter styles
    wp_enqueue_style('wp-vollcom-digital-style', get_stylesheet_uri());
    if (get_theme_mod('theme_option_setting') && get_theme_mod('theme_option_setting') !== 'default') {
        wp_enqueue_style('wp-vollcom-digital-' . get_theme_mod('theme_option_setting'), get_template_directory_uri() . '/inc/assets/css/presets/theme-option/' . get_theme_mod('theme_option_setting') . '.css', false, '');
    }
    if (get_theme_mod('preset_style_setting') && get_theme_mod('preset_style_setting') !== 'default') {
        wp_enqueue_style('wp-vollcom-digital-' . get_theme_mod('preset_style_setting'), get_template_directory_uri() . '/inc/assets/css/presets/typography/' . get_theme_mod('preset_style_setting') . '.css', false, '');
    }

    // Internet Explorer HTML5 support
    wp_enqueue_script('html5hiv', get_template_directory_uri() . '/inc/assets/js/html5.js', array(), '3.7.0', false);
    wp_script_add_data('html5hiv', 'conditional', 'lt IE 9');

    // load bootstrap js
    wp_enqueue_script('wp-vollcom-digital-popper', get_template_directory_uri() . '/inc/assets/js/popper.min.js', array('jquery'), '', true);
    wp_enqueue_script('wp-vollcom-digital-bootstrapjs', get_template_directory_uri() . '/inc/assets/js/bootstrap.min.js', array('jquery'), '', true);
    wp_enqueue_script('wp-vollcom-digital-mdbootstrapjs', get_template_directory_uri() . '/inc/assets/js/mdb.min.js', array('jquery'), '', true);
    wp_enqueue_script('wp-vollcom-digital-customjs', get_template_directory_uri() . '/inc/assets/js/custom.min.js', array(), 'jquery', true);
    wp_enqueue_script('wp-vollcom-digital-themejs', get_template_directory_uri() . '/inc/assets/js/theme-script.min.js', array(), '', true);
    wp_enqueue_script('wp-vollcom-digital-skip-link-focus-fix', get_template_directory_uri() . '/inc/assets/js/skip-link-focus-fix.min.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'wp_vollcomdigital_starter_scripts');

function wp_vollcomdigital_starter_password_form()
{
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $o = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
    <div class="d-block mb-3">' . __("To view this protected post, enter the password below:", "wp-vollcom-digital") . '</div>
    <div class="form-group form-inline"><label for="' . $label . '" class="mr-2">' . __("Password:", "wp-vollcom-digital") . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" class="form-control mr-2" /> <input type="submit" name="Submit" value="' . esc_attr__("Submit", "wp-vollcom-digital") . '" class="btn btn-primary"/></div>
    </form>';
    return $o;
}

add_filter('the_password_form', 'wp_vollcomdigital_starter_password_form');


/**
 * Async script loading
 */
function add_async_attribute($tag, $handle)
{
    // add script handles to the array below
    $scripts_to_async = array('my-js-handle', 'another-handle');

    foreach ($scripts_to_async as $async_script) {
        if ($async_script === $handle) {
            return str_replace(' src', ' async="async" src', $tag);
        }
    }
    return $tag;
}

add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

/**
 * Add deferred javascript
 */
function add_defer_attribute($tag, $handle)
{
    // add script handles to the array below
    $scripts_to_defer = array('my-js-handle', 'another-handle');

    foreach ($scripts_to_defer as $defer_script) {
        if ($defer_script === $handle) {
            return str_replace(' src', ' defer="defer" src', $tag);
        }
    }
    return $tag;
}

add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load plugin compatibility file.
 */
require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';

/**
 * Load custom WordPress nav walker.
 */
if (!class_exists('wp_bootstrap_navwalker')) {
    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
}

/**
 * Create custom block category
 */
function vollcom_block_category($categories, $post)
{
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'vollcom-blocks',
                'title' => __('Vollcom Digital Blocks', 'vollcom-blocks'),
            ),
        )
    );
}

add_filter('block_categories', 'vollcom_block_category', 10, 2);

/**
 * Add custom gutenberg blocks
 */
add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        /* register multi-item carousel advance block */
        acf_register_block(array(
            'name' => 'customer-logos-carousel',
            'title' => __('Customer Logos Carousel'),
            'description' => __('The carousel is a slideshow for cycling through a series of customer logos'),
            'render_template' => 'template-parts/blocks/carousels/customer-logos-carousel.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/blocks/carousels/inc/js/customer-logos-carousel.min.js',
            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/carousels/inc/css/customer-logos-carousel.min.css',
            'category' => 'vollcom-blocks',
            'icon' => 'format-gallery',
            'keywords' => array('carousel'),
        ));

        /* register expandable card block */
        acf_register_block(array(
            'name' => 'expandable-card',
            'title' => __('Expandable Card'),
            'description' => __('A expandable card'),
            'render_template' => 'template-parts/blocks/cards/expandable-card.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/blocks/cards/inc/js/expandable-card.min.js',
            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/cards/inc/css/expandable-card.min.css',
            'category' => 'vollcom-blocks',
            'icon' => 'format-aside',
            'keywords' => array('card'),
        ));

        /* register blog card deck block */
        acf_register_block(array(
            'name' => 'blog-carddeck',
            'title' => __('Latest Blog Posts Carddeck'),
            'description' => __('A carddeck for the latest blog posts'),
            'render_template' => 'template-parts/blocks/cards/blog-carddeck.php',
            'category' => 'vollcom-blocks',
            'icon' => 'editor-table',
            'keywords' => array('card', 'blog'),
        ));

        /*  register job panel deck block */
        acf_register_block(array(
            'name' => 'job-panel-card-deck',
            'title' => __('Job Panel Card Deck'),
            'description' => __('A Deck for job posts'),
            'render_template' => 'template-parts/blocks/panels/job-panel-card-deck.php',
            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/panels/inc/css/job-panel-card-deck.min.css',
            'category' => 'vollcom-blocks',
            'icon' => 'admin-users',
            'keywords' => array('panel', 'jobs'),
        ));

        /*  register job panel deck block */
        acf_register_block(array(
            'name' => 'vollcom-jobs',
            'title' => __('vollcom jobs'),
            'description' => __('A Deck for  personio jobs '),
            'render_template' => 'template-parts/blocks/panels/vollcom-jobs.php',
//            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/panels/inc/css/panel.min.css',
            'category' => 'vollcom-blocks',
            'icon' => 'admin-users',
            'keywords' => array('panel', 'jobs'),
        ));

        /*  register industries card deck */
        acf_register_block(array(
            'name' => 'industries-card-deck',
            'title' => __('Industries Card Deck'),
            'description' => __('A block for industries card decks'),
            'render_template' => 'template-parts/blocks/cards/industries-card-deck.php',
            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/cards/inc/css/industries-card-deck.min.css',
            'category' => 'vollcom-blocks',
            'icon' => 'media-document',
            'keywords' => array('card', 'customer', 'industries'),
        ));

        /*  register customer card deck */
        acf_register_block(array(
            'name' => 'customer-card-deck',
            'title' => __('Customer Card Deck'),
            'description' => __('A block for customer card decks'),
            'render_template' => 'template-parts/blocks/cards/customer-card-deck.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/blocks/cards/inc/js/customer-card-deck.js',
            'category' => 'vollcom-blocks',
            'icon' => 'media-document',
            'keywords' => array('card', 'customer'),
        ));

        /* register multi-item carousel advance block */
        acf_register_block(array(
            'name' => 'partner-logos-carousel',
            'title' => __('Partner Logos Carousel'),
            'description' => __('The carousel is a slideshow for cycling through a series of partner logos'),
            'render_template' => 'template-parts/blocks/carousels/partner-logos-carousel.php',
            'enqueue_script' => get_template_directory_uri() . '/template-parts/blocks/carousels/inc/js/partner-logos-carousel.min.js',
            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/carousels/inc/css/partner-logos-carousel.min.css',
            'category' => 'vollcom-blocks',
            'icon' => 'format-gallery',
            'keywords' => array('carousel', 'partner'),
        ));

        /*  Register panel block */
        acf_register_block(array(
            'name' => 'panel',
            'title' => __('Panel'),
            'description' => __('A block for panels'),
            'render_template' => 'template-parts/blocks/panels/panel.php',
            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/panels/inc/css/panel.min.css',
            'category' => 'vollcom-blocks',
            'icon' => 'embed-generic',
            'keywords' => array('panel'),
        ));

        /*  register job Details panel and loading from Personio */
        /*acf_register_block(array(
            'name' => 'job-position',
            'title' => __('Job Position'),
            'description' => __('Display a Job position'),
            'render_template' => 'template-parts/blocks/panels/job-position-panel.php',
            'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/panels/inc/css/job-position-panel.min.css',
            'category' => 'vollcom-blocks',
            'icon' => 'dashicons-megaphone',
            'keywords' => array('position', 'job'),
        ));*/

        /* register About Vollcom Digital panel in Single Job page
        acf_register_block(array(
            'name' => 'job-about-vollcom-digital',
            'title' => __('About Vollcom Digital - Job'),
            'description' => __('This panel is used to insert about vollcom digital panel in job description page'),
            'render_template' => 'template-parts/blocks/panels/job-about-vollcom-digital-panel.php',
            'category' => 'vollcom-blocks',
            'icon' => 'format-gallery',
            'keywords' => array('about vollcom digital'),
        ));*/
    }
}


/**
 * Saving acf fields automatically
 */
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
    // update path
    $path = get_stylesheet_directory() . '/inc/assets/field-config';
    // return
    return $path;
}

/**
 * Loading acf fields automatically
 */
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths)
{
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/inc/assets/field-config';
    // return
    return $paths;
}

/**
 * Add a options page to backend
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme-Optionen',
        'menu_title' => 'Theme-Optionen',
        'menu_slug' => 'theme-options',
        'capability' => 'edit__posts',
        'parent_slug' => '',
        'position' => false,
        'icon_curl' => false,
        'redirect' => false
    ));
}

/**
 * Add vollcom digital color palette to gutenberg editor
 */
add_theme_support('editor-color-palette', array(
    array(
        'name' => __('Hellblau', 'vollcom-digital'),
        'slug' => 'hellblau',
        'color' => '#25A6B5',
    ),
    array(
        'name' => __('Dunkelblau', 'vollcom-digital'),
        'slug' => 'dunkelblau',
        'color' => '#181347',
    ),
    array(
        'name' => __('Petrol', 'vollcom-digital'),
        'slug' => 'petrol',
        'color' => '#5A7184',
    ),
    array(
        'name' => __('Grün', 'vollcom-digital'),
        'slug' => 'gruen',
        'color' => '#36B37E',
    ),
    array(
        'name' => __('Weiss', 'vollcom-digital'),
        'slug' => 'weiss',
        'color' => '#ffffff',
    ),
    array(
        'name' => __('Hellgrau', 'vollcom-digital'),
        'slug' => 'hellgrau',
        'color' => '#E5EAF4',
    ),
    array(
        'name' => __('Hellgrau Light', 'vollcom-digital'),
        'slug' => 'hellgraulight',
        'color' => '#F9FBFE',
    ),
    array(
        'name' => __('Braun', 'vollcom-digital'),
        'slug' => 'braun',
        'color' => '#2e2e36',
    )
));

/**
 * Disable Custom Colors
 */
add_theme_support('disable-custom-colors');

/**
 * Add responsive embedded content
 */
add_theme_support('responsive-embeds');

/**
 * Create custom post type jobs
 */
function create_posttype_jobs()
{
    register_post_type('jobs',
        array(
            'labels' => array(
                'name' => __('Jobs'),
                'singular_name' => __('Job')
            ),
            'public' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-universal-access',
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
            'show_in_rest' => true,
            'public_queryable' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'taxonomies' => array('jobs_tag'),
            'rewrite' => array('slug' => 'jobs', 'with_front' => false)
        )
    );
}

add_action('init', 'create_posttype_jobs', 0);

/**
 * Register custom taxonomy for custom post type jobs
 */
function create_job_type_taxonomy()
{
    /* Create team taxonomy */
    $args = array(
        'label' => __('Team'),
        'rewrite' => array('slug' => 'team'),
        'show_in_rest' => true,
        'public_queryable' => true,
        'hierarchical' => true,
    );
    register_taxonomy('team', 'jobs', $args);

    /* Create location taxonomy */
    $args = array(
        'label' => __('Standort'),
        'rewrite' => array('slug' => 'location'),
        'show_in_rest' => true,
        'public_queryable' => true,
        'hierarchical' => true,
    );
    register_taxonomy('location', 'jobs', $args);

    /* Create job type taxonomy */
    $args = array(
        'label' => __('Anstelltungsart'),
        'rewrite' => array('slug' => 'typ'),
        'show_in_rest' => true,
        'public_queryable' => true,
        'hierarchical' => true,
    );
    register_taxonomy('typ', 'jobs', $args);
}

add_action('init', 'create_job_type_taxonomy');

/**
 * Create custom post type customers
 */
function create_posttype_customers()
{
    register_post_type('customers',
        array(
            'labels' => array(
                'name' => __('Kunden'),
                'singular_name' => __('Kunde')
            ),
            'public' => true,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-building',
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
            'show_in_rest' => true,
            'public_queryable' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'taxonomies' => array('industries_tag'),
            'exclude_from_search' => true
        )
    );
}

add_action('init', 'create_posttype_customers', 0);

/**
 * Register Branche taxonomy for custom post type customer
 */
function create_customers_type_taxonomy()
{
    /* Create industries taxonomy */
    $args = array(
        'label' => __('Branche'),
        'rewrite' => array('slug' => 'branchen'),
        'show_in_rest' => true,
        'public_queryable' => true,
        'hierarchical' => true,
    );
    register_taxonomy('branchen', 'customers', $args);
}

add_action('init', 'create_customers_type_taxonomy');

/**
 * Register Projekte taxonomy for custom post type customer
 */
function create_customers_projects_taxonomy()
{
    /* Create projects taxonomy */
    $args = array(
        'label' => __('Projekte'),
        'rewrite' => array('slug' => 'projects'),
        'show_in_rest' => true,
        'public_queryable' => true,
        'hierarchical' => true,
    );
    register_taxonomy('projects', 'customers', $args);
}

add_action('init', 'create_customers_projects_taxonomy');

/**
 * @param $length
 *
 * @return int
 */
function prefix_custom_excerpt_length($length)
{
    $custom = get_theme_mod('custom_excerpt_length');
    if ($custom != '') {
        return $length = intval($custom);
    } else {
        return $length;
    }
}

add_filter('excerpt_length', 'prefix_custom_excerpt_length', 999);

function vollcom_digital_custom_excerpt_length()
{
    set_theme_mod('custom_excerpt_length', '38');
}

add_action('init', 'vollcom_digital_custom_excerpt_length');

function excerpt($limit)
{
    return wp_trim_words(get_the_excerpt(), $limit);
}

/**
 * Create custom post type partners
 */
function create_posttype_partners()
{
    register_post_type('partners',
        array(
            'labels' => array(
                'name' => __('Partner'),
                'singular_name' => __('Partner')
            ),
            'public' => true,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-building',
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
            'show_in_rest' => true,
            'public_queryable' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'exclude_from_search' => true
        )
    );
}

add_action('init', 'create_posttype_partners', 0);

if (!function_exists('post_pagination')) :
    function post_pagination()
    {
        global $wp_query;
        $pager = 999999999; // need an unlikely integer

        echo paginate_links(array(
            'base' => str_replace($pager, '%#%', esc_url(get_pagenum_link($pager))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages
        ));
    }
endif;


add_filter('get_the_archive_title', 'custom_archive_title');
/**
 * Remove archive labels.
 *
 * @param string $title Current archive title to be displayed.
 * @return string        Modified archive title to be displayed.
 */
function custom_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    } elseif (is_home()) {
        $title = single_post_title('', false);
    }

    return $title;
}

/*
 * Archive pagination
 */
function pagination_nav($pages = '', $range = 3)
{
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<nav aria-label='Page navigation' class='d-flex justify-content-center my-4 fadeIn'><ul class='pagination pg-green'>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
            echo "<li class='page-item'><a class='page-link' aria-label='Previous' href='" . get_pagenum_link(1) . "'>
                        <span aria-hidden='true'>&laquo;</span>
                        <span class='sr-only'>Previous</span>
                    </a></li>";
        }
        if ($paged > 1 && $showitems < $pages) {
            echo "<li class='page-item'><a class='page-link' href='" . get_pagenum_link($paged - 1) . "' aria-label='Previous'><span aria-hidden='true'>&lsaquo;</span><span class='sr-only'>Previous</span></a></li>";
        }

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<li class='page-item active'><span class='page-link'>" . $i . "</span></li>" : "<li class='page-item'><a href='" . get_pagenum_link($i) . "' class='page-link'>" . $i . "</a></li>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<li class='page-item'>
                    <a class='page-link' href='" . get_pagenum_link($paged + 1) . "' aria-label='Next'>
                        <span aria-hidden='true'>&rsaquo;</span>
                        <span class='sr-only'>Next</span>
                    </a>
                </li>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
            echo "<li class='page-item'>
                    <a class='page-link' href='" . get_pagenum_link($pages) . "'>
                        <span aria-hidden='true'>&raquo;</span>
                        <span class='sr-only'>Next</span>
                    </a>
                    </li>";
        }
        echo "</ul></nav>\n";

    }
}

add_filter('wp_nav_menu_items', 'add_search_form', 1, 2);

// Display search icon in menus and toggle search form
function add_search_form($items, $args)
{
    if ($args->theme_location == 'primary') {
        $items .= '<li style="margin-top: 10px;" id="s-icon" class="menu-item menu-item-type-search menu-item-search nav-item text-white mx-3"><i class="far fa-search"></i></li>';
    }
    return $items;
}

/**
 * Register custom query vars
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
 */
function vd_pre_get_posts($query)
{
    if (!is_admin() && $query->is_main_query() && $query->is_search) {
        if (isset($_GET['post_type']) && $_GET['post_type'] == 'page') {
            $query->set('post_type', array('page'));
        }
        $query->set('paged', (get_query_var('paged')) ? get_query_var('paged') : 1);
        $query->set('posts_per_page', 10);
    }

}

add_action('pre_get_posts', 'vd_pre_get_posts', 1);

function add_mobile_body_class($classes)
{
    if (wp_is_mobile()) {
        $classes[] = 'is-mobile';
    }
    return $classes;
}

add_filter('body_class', 'add_mobile_body_class');

/**
 *
 * add excerpt functionality to the page in ordr to display in search result page.
 */
add_post_type_support('page', 'excerpt');

function remove_page_from_query_string($query_string)
{
    if (isset($query_string['name']) && $query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        $query_string['paged'] = $query_string['page'];
    }
    return $query_string;
}

add_filter('request', 'remove_page_from_query_string');

/*
register_activation_hook(__FILE__, 'personio_jobs');
function personio_jobs() {// \/*15 * * * * wget -q -O - http://yourdomain.com/wp-cron.php?doing_wp_cron, https://tommcfarlin.com/wordpress-cron-jobs/
    if (! wp_next_scheduled ( 'my_hourly_event' )) {
        wp_schedule_event(time(), 'hourly', 'check_personio_jobs_event');
    }
}

add_action('check_personio_jobs_event', 'check_personio_jobs');
function check_personio_jobs() {
    // do something every hour

}
*/

