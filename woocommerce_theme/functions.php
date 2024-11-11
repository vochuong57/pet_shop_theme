<?php
/**
 * woocommerce_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package woocommerce_theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function woocommerce_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on woocommerce_theme, use a find and replace
		* to change 'woocommerce_theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'woocommerce_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'woocommerce_theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'woocommerce_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'woocommerce_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function woocommerce_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'woocommerce_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'woocommerce_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function woocommerce_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'woocommerce_theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'woocommerce_theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'woocommerce_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function woocommerce_theme_scripts() {
	wp_enqueue_style( 'woocommerce_theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'woocommerce_theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'woocommerce_theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	// Thêm thư viện icon, css và font
	wp_enqueue_style('bootstrap.icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css', array(), '1.3.0', 'all');

	// Đường dẫn tới file CSS trong thư mục theme
	wp_enqueue_style('bootstrap.css', get_template_directory_uri() . '/css/style.css', array(), '5.3.1', 'all');

	// Đường dẫn tới file js
	wp_enqueue_script('bootsrap.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js', 'jQuery', '2.3.1', true);

	// Sử dụng wp_enqueue_style cho Google Fonts
	wp_enqueue_style('font.sansource', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,600&display=swap', array(), '1.0.1', 'all');
	wp_enqueue_style('font.nunito', 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap', array(), '1.0.2', 'all');


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'woocommerce_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

//AJAX cart
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> – <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

// Embed woocommerce
add_theme_support('woocommerce'); 

// Hook: woocommerce_archive_description
add_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
function woocommerce_taxonomy_archive_description(){
	?>
		<h5>Chất lượng - Uy tín - An toàn</h5>
	<?php
}

//Hook: woocommerce_before_shop_loop
// add_action( 'woocommerce_before_shop_loop', 'notice', 1 );
// function notice(){
	
// }

// -------------------------------------------------------------------SHOP PAGE------------------------------------------------------------------------


//--------------------------------RESULT SEARCH--------------------------

// Xóa hành động mặc định
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Thêm lại hành động với văn bản tùy chỉnh
add_action( 'woocommerce_before_shop_loop', 'custom_woocommerce_result_count', 20 );

function custom_woocommerce_result_count() {
    global $wp_query;
    
    if ( ! woocommerce_products_will_display() ) {
        return;
    }

    $total    = $wp_query->found_posts;
    $per_page = $wp_query->query_vars['posts_per_page'];
    $current  = max( 1, $wp_query->get( 'paged' ) );
    $first    = ( $per_page * $current ) - $per_page + 1;
    $last     = min( $total, $per_page * $current );

    // Thay đổi nội dung hiển thị dựa vào tổng sản phẩm
    if ( $total <= 10 ) {
        $result_text = sprintf( __( 'Chỉ có %d sản phẩm', 'text-domain' ), $total );
    } elseif ( $total > 10 && $total <= 20 ) {
        $result_text = sprintf( __( 'Đang hiển thị %d–%d của %d sản phẩm', 'text-domain' ), $first, $last, $total );
    } else {
        $result_text = sprintf( __( 'Có tổng cộng %d sản phẩm', 'text-domain' ), $total );
    }
    
    echo '<p class="woocommerce-result-count">' . $result_text . '</p>';
}

// -----------------------------------BANNER AFTER-------------------------------

add_action('woocommerce_before_shop_loop', 'add_custom_banner_after_second_row', 5);
function add_custom_banner_after_second_row() {
    // Biến tĩnh để đếm số sản phẩm đã hiển thị
    static $product_count = 0;

    // Chạy trước mỗi sản phẩm được hiển thị
    add_action('woocommerce_after_shop_loop_item', function() use (&$product_count) {
        $product_count++; // Tăng bộ đếm sản phẩm
        
        // Chèn banner sau sản phẩm thứ 8 (sau 2 dòng)
        if ($product_count === 8) { 
            echo '<li class="shop-banner" style="clear: both; margin: 20px 0; width: 100%;">';
            echo '<img src="' . get_template_directory_uri() . '/images/slide-1.jpg" alt="Banner quảng cáo" style="width: 100%; height: auto;">';
            echo '</li>';
        }
    });
}


// add_action('woocommerce_after_shop_loop', 'add_custom_banner_after_products');
// function add_custom_banner_after_products() {
//     echo '<div class="shop-banner">';
//     echo '<img src="' . get_template_directory_uri() . '/images/slide-1.jpg" alt="Banner quảng cáo">';
//     echo '</div>';
// }


// ------------------------------------- BEFORE LOOP ITEM ----------------------------------

add_action( 'woocommerce_before_shop_loop_item_title', 'custom_middle_content', 15 );
function custom_middle_content() {
    echo '<hr>';
}

// --------------------------------- PRODUCT NAME --------------------------------------

// set up css

// --------------------------------- PRODUCT PRICE --------------------------------------

// Xóa các filter mặc định liên quan đến giá
remove_filter( 'woocommerce_variable_empty_price_html', 'woocommerce_variable_empty_price_html', 10 );
remove_filter( 'woocommerce_variable_price_html', 'woocommerce_variable_price_html', 10 );
remove_filter( 'woocommerce_get_price_html', 'woocommerce_get_price_html', 10 );

// Tùy chỉnh hàm hiển thị giá
add_filter( 'woocommerce_get_price_html', 'custom_price_display', 10, 2 );
function custom_price_display( $price, $product ) {
    // Kiểm tra xem sản phẩm là loại biến thể hay không
    if ( $product->is_type( 'variable' ) ) {
        // Lấy giá biến thể
        $prices = $product->get_variation_prices( true );

        // Kiểm tra xem có giá không
        if ( empty( $prices['price'] ) ) {
            // Nếu không có giá, hiển thị thông báo mặc định
            return '<span class="price">Sản phẩm này chưa có giá</span>';
        } else {
            // Xử lý giá nằm trong khoảng nếu có
            $min_price = current( $prices['price'] );
            $max_price = end( $prices['price'] );

            if ( $min_price !== $max_price ) {
                $price = wc_format_price_range( $min_price, $max_price );
            } else {
                $price = wc_price( $min_price );
            }

            // Trả về giá đã định dạng
            return '<span class="sale-price" style="font-weight: bold;">' . $price . '</span>';
        }
    } elseif ( $product->is_type( 'simple' ) ) {
		// Xử lý sản phẩm đơn giản
		$regular_price = $product->get_regular_price();
		$sale_price = $product->get_sale_price();
	
		if ( empty( $regular_price ) ) {
			return '<span class="price-prod">Sản phẩm này chưa có giá</span>';
		} else {
			// Xây dựng giá hiển thị với giá gốc gạch ngang bên trái và giá khuyến mãi bên phải
			$price_html = '<span class="regular-price" style="text-decoration: line-through; color: #999;">' . wc_price( $regular_price ) . '</span>';
			
			if ( $sale_price ) {
				// Nếu có giá khuyến mãi, thêm giá khuyến mãi bên phải
				$price_html .= ' <span class="sale-price" style="font-weight: bold;">' . wc_price( $sale_price ) . '</span>';
			} else {
				// Nếu giá khuyến mãi bằng giá gốc
				$price_html .= ' <span class="sale-price" style="font-weight: bold;">' . wc_price( $regular_price ) . '</span>';
			}
			
			return $price_html;
		}
	}

    // Nếu không phải sản phẩm biến thể hay đơn giản, trả về giá mặc định
    return $price;
}


//-----------------------------------STATUS PRODUCT-----------------------------------

// Hook: woocommerce_after_shop_loop_item_title
add_action( 'woocommerce_after_shop_loop_item_title', 'by_archive_stock', 10 );
// Hàm hiển thị thông tin số lượng và trạng thái tồn kho của sản phẩm trên trang lưu trữ (archive page)
function by_archive_stock() {
    // Lấy thông tin sản phẩm hiện tại từ biến toàn cục $post
    global $post;
    
    // Lấy ID của sản phẩm hiện tại
    $prod_id = $post->ID;
    
    // Tạo đối tượng sản phẩm WooCommerce từ ID sản phẩm
    $product = wc_get_product( $prod_id );
    
    // Lấy trạng thái tồn kho của sản phẩm ('instock' hoặc 'outofstock')
    $stock_status = $product->get_stock_status();
    
    // Lấy số lượng hàng tồn kho của sản phẩm
    $stock_quantity = $product->get_stock_quantity();
    
    // Lấy giá khuyến mãi (nếu có) của sản phẩm
    $sale_price = $product->get_sale_price();
    
    // Lấy loại sản phẩm (simple, grouped, variable, etc.)
    $product_type = $product->get_type();
    
    // Nếu sản phẩm có giá khuyến mãi và số lượng tồn kho lớn hơn hoặc bằng 1
    if ( $sale_price && $stock_quantity >= 1 ) {
        // Hiển thị thông báo còn lại bao nhiêu sản phẩm với màu đỏ
        echo '<div style="color:orange;">Còn ' . $stock_quantity . ' sản phẩm</div>';
    }
    // Nếu số lượng tồn kho lớn hơn hoặc bằng 1 nhưng không có giá khuyến mãi
    elseif ( $stock_quantity >= 1 && !$sale_price ) {
        // Hiển thị số lượng sản phẩm còn lại với định dạng thông thường
        echo '<div style="color:green;">(' . $stock_quantity . ' sản phẩm' . ')</div>';
    } 
    // Nếu sản phẩm thuộc loại "grouped"
    elseif( $product_type == 'grouped' ) {
        // Lấy các sản phẩm con trong nhóm
        $grouped = $product->get_children();
        
        // Khởi tạo mảng để lưu trữ trạng thái tồn kho của từng sản phẩm con
        $stock = [];
        
        // Lặp qua từng sản phẩm con
        foreach( $grouped as $single ) {
            // Lấy đối tượng sản phẩm con
            $product = wc_get_product( $single );
            
            // Thêm trạng thái tồn kho của sản phẩm con vào mảng $stock
            $stock[] = $product->get_stock_status( $single );
        }
        
        // Nếu bất kỳ sản phẩm con nào còn trong kho
        if ( in_array( 'instock', $stock )) {
            // Hiển thị "In Stock"
            echo '<div style="color:green;">Sẵn hàngk</div>';
        } else {
            // Nếu không có sản phẩm con nào còn trong kho, hiển thị "Out of Stock"
            echo '<div style="color:red;">Hết hàng</div>';
        }
    }
    // Nếu sản phẩm không thuộc loại "grouped"
    else {
        // Nếu trạng thái tồn kho của sản phẩm là 'instock'
        if ( $stock_status == 'instock' ) {
            // Hiển thị "In Stock"
            echo '<div style="color:green;">Sẵn hàng</div>';
        }
        // Nếu trạng thái tồn kho của sản phẩm là 'outofstock'
        if ( $stock_status == 'outofstock' ) {
            // Hiển thị "Out of Stock"
            echo '<div style="color:red;">Hết hàng</div>';
        }
    }
}

//------------------------------------RATING-START------------------------------------

// Xóa action hiển thị sao đánh giá mặc định trên trang sản phẩm
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Thêm action tùy chỉnh để hiển thị thông báo nếu chưa có đánh giá
add_action('woocommerce_after_shop_loop_item', 'custom_woocommerce_no_reviews_text', 5);

function custom_woocommerce_no_reviews_text() {
    global $product;

    // Kiểm tra nếu sản phẩm có số đánh giá lớn hơn 0
    if ($product->get_review_count() > 0) {
        // Nếu có đánh giá, hiển thị rating
		echo '<p class="woocommerce-product-rating">';
        woocommerce_template_loop_rating(); 
        echo '</p>';
    } else {
        // Nếu chưa có đánh giá, hiển thị thông báo tùy chỉnh
        echo '<p class="no-reviews-text">Sản phẩm này chưa có đánh giá</p>';
    }
}


// --------------------------BUTTON---------------------------------

// Thay đổi văn bản nút "Thêm vào giỏ hàng"
add_filter('woocommerce_product_add_to_cart_text', 'custom_shop_add_to_cart_text', 10, 2);
function custom_shop_add_to_cart_text($text, $product) {
    // Nếu không có sản phẩm, trả về văn bản gốc
    if (!$product) {
        return $text;
    }

    // Kiểm tra nếu biến $product không phải null
    if ($product instanceof WC_Product) {
        // Kiểm tra nếu sản phẩm không còn hàng
        if (!$product->is_in_stock()) {
            return __('Hết hàng', 'woocommerce');
        }

        // Kiểm tra nếu sản phẩm không có giá (giá bằng 0 hoặc không có)
        if (!$product->get_price() || $product->get_price() <= 0) {
            return __('Xem chi tiết', 'woocommerce');
        }
    }

    return __('Thêm giỏ hàng', 'woocommerce');
}


// -----------------------------------CHANGE ANNOUNCEMENT------------------------------------
add_filter( 'gettext', function( $text ) {
	if ( 'View cart' === $text ) {
		$text = 'Xem giỏ hàng';
	}
	elseif ( 'Giảm giá!' === $text ) {
        // Lấy sản phẩm hiện tại một cách an toàn
        global $post;
        $product = wc_get_product( $post->ID );

        if ( $product ) {
            // Lấy giá gốc và giá khuyến mãi
            $regular_price = $product->get_regular_price();
            $sale_price = $product->get_sale_price();

            // Kiểm tra xem sản phẩm có nhiều phiên bản hay không
            if ( $product->is_type( 'variable' ) ) {
				$text = 'Giảm giá!';
            }
            // Kiểm tra cho sản phẩm không phải là biến thể
            elseif ( is_numeric( $regular_price ) && $regular_price > 0 && 
                     is_numeric( $sale_price ) && $sale_price < $regular_price ) {
                $discount_percentage = 100 - ( ( $sale_price / $regular_price ) * 100 );
                $discount_percentage = round( $discount_percentage );
                $text = 'Giảm giá ' . $discount_percentage . '%';
            } else {
                // Nếu không có khuyến mãi nào
                // $text = 'Sản phẩm không có khuyến mãi.';
            }
        }
    }
	return $text;
} );

// // Thay đổi thông báo "Hết hàng" khi sản phẩm không còn hàng
// add_filter('woocommerce_product_add_to_cart_text', 'custom_out_of_stock_text');
// function custom_out_of_stock_text($text) {
//     global $product;

//     if (!$product->is_in_stock()) {
//         return __('Hết hàng', 'woocommerce');
//     }
    
//     return $text;
// }

// // Thay đổi văn bản nút "Thanh toán"
// add_filter('woocommerce_order_button_text', 'custom_proceed_to_checkout_text');
// function custom_proceed_to_checkout_text() {
//     return __('Thanh toán ngay', 'woocommerce');
// }

// // Thay đổi văn bản nút "Đặt hàng"
// add_filter('woocommerce_order_button_text', 'custom_place_order_button_text');
// function custom_place_order_button_text() {
//     return __('Đặt hàng ngay', 'woocommerce');
// }

// --------------------------------------------------------------SINGLE PRODUCT PAGE------------------------------------------------------------------------

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 1);

// Đổi nút "Add to cart" thành "Thêm vào giỏ hàng" trên trang sản phẩm đơn
add_filter('woocommerce_product_single_add_to_cart_text', 'change_add_to_cart_text');
function change_add_to_cart_text() {
    return 'Thêm vào giỏ hàng'; // Thay đổi văn bản ở đây
}


// --------------------TAB PRODUCT FILTER------------------------------------------

add_filter('woocommerce_product_tabs', 'short_description_custom_2');
function short_description_custom_1($tabs){
	unset($tabs['description']);
	unset($tabs['additional_information']);
	unset($tabs['reviews']);

	$tabs['description_product'] = array(
		'title' => 'Mô tả',
		'priority' => '5',
		'callback' => 'woocommerce_description'
	);

	$tabs['discount'] = array(
		'title' => 'Sản phẩm khuyến mãi',
		'priority' => '10',
		'callback' => 'woocommerce_discount'
	);

	return $tabs;
}

function woocommerce_description(){
	?>
		<div><?php the_content(); ?></div>
	<?php
}

function woocommerce_discount() {
    global $product;

    // Kiểm tra nếu sản phẩm có nhiều biến thể
    if ( $product->is_type( 'variable' ) ) {
		echo '<div>' . get_the_title() . ' đang được khuyến mãi </div>';
    } else {
        // Nếu sản phẩm không phải biến thể
        if ( $product->is_on_sale() ) { 
            $regular_price = $product->get_regular_price(); 
            $sale_price = $product->get_sale_price(); 

            // Tính phần trăm giảm giá
            $discount_percentage = 100 - ( ( $sale_price / $regular_price ) * 100 );
            $discount_percentage = round( $discount_percentage );

            echo '<div>' . get_the_title() . ' đang được khuyến mãi ' . $discount_percentage . '%</div>';
        } else {
            echo '<div>' . get_the_title() . ' không có khuyến mãi</div>';
        }
    }
}


function short_description_custom_2($tabs){
	?>
		<div class="woocommerce-tabs wc-tabs-wrapper">
            <h2 class="title-description-product">Mô tả sản phẩm</h2>
			<?php
				$tabs = the_content();
				return $tabs;
			?>
		</div>
	<?php
}

// ----------------------------------------CHANGE TITLE PRODUCT RELATED --------------------------------------

remove_filter('woocommerce_product_related_products_heading', 'woocommerce_related_products_heading');
add_filter('woocommerce_product_related_products_heading', function() {
    return 'Sản phẩm liên quan';
});

//------------------------- Thay đổi số lượng sản phẩm liên quan trên trang sản phẩm đơn lẻ-----------------------
add_filter('woocommerce_output_related_products_args', 'change_related_products_count');
function change_related_products_count($args) {
    $args['posts_per_page'] = 3; // Số lượng sản phẩm liên quan
    $args['columns'] = 3; // Số cột hiển thị sản phẩm
    return $args;
}

// ----------------------------------- REVIEWS ----------------------------------------

// Xóa tab đánh giá khỏi danh sách tab chính
add_filter('woocommerce_product_tabs', 'remove_reviews_tab', 98);
function remove_reviews_tab($tabs) {
    unset($tabs['reviews']); // Xóa tab 'Đánh giá'
    return $tabs;
}

// Hiển thị tab đánh giá ở cuối trang sản phẩm
add_action('woocommerce_after_single_product_summary', 'move_reviews_to_bottom', 30);
function move_reviews_to_bottom() {
    comments_template(); // Hiển thị template đánh giá mặc định của WooCommerce
}

// --------------------------------------------------------------CART PAGE------------------------------------------------------------------------

// Xuất thông báo điều kiện free ship
add_action('woocommerce_before_cart_table', 'show_notice_free_ship');
function show_notice_free_ship(){
    $min_amount = 500000;
    $current_amount = WC()->cart->subtotal;
    if($current_amount<$min_amount){
        ?>  
            <div class="woocommerce-info">
                Bạn cần mua thêm <?php echo wc_price($min_amount - $current_amount) ?> để được Free Ship
            </div>
        <?php
    }
}

//Xuất thông báo sử dụng mã khuyễn mãi
add_filter('woocommerce_cart_coupon','show_time_coupon');
function show_time_coupon(){
    // class="woocommerce-error"
    ?>
        <div class="woocommerce-info mt-2">Bạn hãy nhập mã giảm giá nếu có</div>
    <?php
}


//Xuất thông báo thời gian giao hàng
add_action('woocommerce_before_cart', 'show_time_shipping');
function show_time_shipping(){
    ?>
        <div class="woocommerce-info mt-2">Sản phẩm sẽ được giao trong 7 ngày !!!</div>
    <?php
}

//Thêm nút return to shopping
add_action('woocommerce_after_cart_table', 'button_return_to_shopping');
function button_return_to_shopping(){
    ?>
        <div class="wc-proceed-to-checkout" style="width: max-content;">
            <a href="<?php echo site_url('/shop') ?>" class="checkout-button button alt wc-forward">
                Tiếp tục mua sắm
            </a>
        </div>
    <?php
}

// --------------------------------------------------------------CHECKOUT PAGE------------------------------------------------------------------------

// -------------------Kiểm tra mảng form checkout để tùy chỉnh

// add_filter( 'woocommerce_checkout_fields', 'misha_print_all_fields' );
// function misha_print_all_fields( $fields ) {
//     echo '<pre>';
//     print_r( $fields );
//     echo '</pre>';
//     return $fields;
// }

// -----------------------Xóa span optional

// add_filter('woocommerce_form_field', 'remove_optional_text', 10, 4);
// function remove_optional_text($field, $key, $args, $value) {
//     // Kiểm tra xem khóa 'required' có tồn tại và không bắt buộc
//     if (isset($args['required']) && !$args['required']) {
//         $field = preg_replace('/<span class="optional">\(\s*optional\s*\)<\/span>/', '', $field);
//     }
//     return $field;
// }

// ------------------ Tắt function Ship to a different address?

// Tắt hoàn toàn địa chỉ giao hàng
// add_filter('woocommerce_shipping_enabled', '__return_false');

add_filter('woocommerce_cart_needs_shipping_address', '__return_false');

// --------------------- Tắt các field không cần thiết
add_filter('woocommerce_checkout_fields', 'remove_fields');
function remove_fields($data) {
    unset($data["billing"]["billing_company"]);
    unset($data["billing"]["billing_country"]);
    return $data;
}

// --------------------- Thêm trường billing_hotline
add_filter('woocommerce_checkout_fields', 'bloomer_add_custom_checkout_field');
function bloomer_add_custom_checkout_field($data) {
    $data['billing']['billing_hotline'] = array(
        'type' => 'text',
        'class' => array('form-row-wide'),
        'label' => 'Hotline',
        'placeholder' => 'Nhập số điện thoại bàn...',
        'required' => false,
        // 'default' => '0xxxxxxxxx', 
    );
    return $data;
}
// Lưu dữ liệu trường billing_hotline vào meta của đơn hàng
add_action('woocommerce_checkout_update_order_meta', 'save_billing_hotline_field');
function save_billing_hotline_field($order_id) {
    if (!empty($_POST['billing_hotline'])) {
        update_post_meta($order_id, '_billing_hotline', sanitize_text_field($_POST['billing_hotline']));
    }
}

// Hiển thị trường billing_hotline trong trang quản trị đơn hàng
add_action('woocommerce_admin_order_data_after_billing_address', 'display_billing_hotline_in_admin');
function display_billing_hotline_in_admin($order) {
    $billing_hotline = get_post_meta($order->get_id(), '_billing_hotline', true);
    if ($billing_hotline) {
        echo '<p><strong>Hotline Number:</strong> ' . esc_html($billing_hotline) . '</p>';
    }
}


// ------------------------------- Xóa phần shipping trong hóa đơn

// add_filter('woocommerce_cart_needs_payment', '__return_false');
// add_filter('woocommerce_cart_ready_to_calc_shipping', '__return_false');

// ------------------------------- Xóa phần cuối chi tiết giao hàng ở trang cảm ơn

add_filter( 'wc_get_template', 'hide_order_recieved_customer_details', 10 , 1 );
function hide_order_recieved_customer_details( $template_name ) {
    // Targeting thankyou page and the customer details
    if( is_wc_endpoint_url( 'order-received' ) && strpos($template_name, 'order-details-customer.php') !== false ) {
        return false;
    }
    return $template_name;
}


//------------------------------------------------------------------------ ACCOUNT PAGE-------------------------------------------------------------

// Dịch thuật lại phần heading ở my order trong trang account
add_filter('woocommerce_my_account_my_orders_columns', 'custom_my_account_my_orders_columns');

function custom_my_account_my_orders_columns() {
    return array(
        'order-number'  => esc_html__( 'Đơn hàng', 'woocommerce' ),
        'order-date'    => esc_html__( 'Trạng thái', 'woocommerce' ),
        'order-total'   => esc_html__( 'Ngày đặt', 'woocommerce' ),
        'order-status'  => esc_html__( 'Tổng cộng', 'woocommerce' ),
        'order-actions' => esc_html__( 'Thao tác', 'woocommerce' ),
    );
}

// Dịch trạng thái đơn hàng đang làm


// thêm một thẻ p ở trang account
add_action( 'woocommerce_account_content', 'action_woocommerce_account_content' );
function action_woocommerce_account_content(  ) {
    global $current_user; // The WP_User Object

    echo '<p>' . __("Created by Group 10", "woocommerce") . '</p>';
};


// Loại bỏ mục "Tải xuống" khỏi menu tài khoản WooCommerce
add_filter( 'woocommerce_account_menu_items', 'remove_downloads_my_account', 10, 1 );

function remove_downloads_my_account( $items ) {
    unset( $items['downloads'] ); // Xóa mục Tải xuống
    return $items;
}

// ------------------------------------------------------------ FOOTER-----------------------------------------------------------------
// Bài 10 : Tạo widget cho footer 
add_action( 'widgets_init', 'widget_footer_menu_one' );

function widget_footer_menu_one() {
	$args = array( 
		"id" => "footer_col_one",
		"name" => __('Footer Widget One', 'woocommerce_theme'), 
		"description" => __( 'Hello, this is Footer Widget for col 1', 'woocommerce_theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
	);
    
	register_sidebar( $args );
}


//Footer Widget col 2 
add_action( 'widgets_init', 'widget_footer_menu_two' );

function widget_footer_menu_two() {
	$args = array( 
		"id" => "footer_col_two",
		"name" => __('Footer Widget Two', 'woocommerce_theme'), 
		"description" => __( 'Hello, this is Footer Widget for col 2', 'woocommerce_theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
	);
    
	register_sidebar( $args );
}



//Footer Widget Col 3 
add_action( 'widgets_init', 'widget_footer_menu_three' );

function widget_footer_menu_three() {
	$args = array( 
		"id" => "footer_col_three",
		"name" => __('Footer Widget Three', 'woocommerce_theme'), 
		"description" => __( 'Hello, this is Footer Widget for col 3', 'woocommerce_theme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
	);
    
	register_sidebar( $args );
}

// Tạo shortcode Delivery & Shipping
function custom_delivery_shipping_content() {
    ob_start();
    ?>
    <!-- <h2>Delivery & Shipping Information</h2> -->
    <p>Chúng tôi cung cấp các tùy chọn vận chuyển đa dạng để đáp ứng nhu cầu của bạn. Dưới đây là chính sách giao hàng và vận chuyển tiêu chuẩn của chúng tôi:</p>
    <ul>
        <li><strong>Vận chuyển tiêu chuẩn:</strong> 3-5 ngày làm việc.</li>
        <li><strong>Vận chuyển nhanh:</strong> 1-2 ngày làm việc.</li>
        <li><strong>Vận chuyển quốc tế:</strong> Chưa có dịch vụ này!</li>
    </ul>
    <p>Vui lòng tham khảo <a href="/shipping-policy">chính sách vận chuyển</a> của chúng tôi để biết thêm chi tiết.</p>
    <?php
    return ob_get_clean();
}
add_shortcode('delivery_shipping', 'custom_delivery_shipping_content');

// Tạo shortcode About Us
function custom_about_us_content() {
    ob_start();
    ?>
    <div class="about-us-content">
        <!-- <h2>Về Chúng Tôi</h2> -->
        <p>Chúng tôi là một công ty chuyên cung cấp các sản phẩm và dịch vụ chất lượng cao nhằm đáp ứng nhu cầu của khách hàng. Với đội ngũ chuyên nghiệp và tận tâm, chúng tôi cam kết mang đến sự hài lòng và giá trị bền vững cho mọi khách hàng.</p>
        <p>Chúng tôi tin tưởng vào sự phát triển lâu dài thông qua uy tín, chất lượng, và dịch vụ hoàn hảo. Hãy cùng chúng tôi xây dựng những giá trị đích thực và tạo nên thành công.</p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('about_us', 'custom_about_us_content');

// Tạo shortcode Policies
function custom_policies_content() {
    ob_start();
    ?>
    <div class="policies-content">
        <!-- <h2>Chính Sách Của Chúng Tôi</h2> -->
        <h3>Chính Sách Vận Chuyển</h3>
        <p>Chúng tôi cung cấp nhiều tùy chọn vận chuyển nhằm đáp ứng nhu cầu của khách hàng:</p>
        <ul>
            <li><strong>Giao hàng tiêu chuẩn:</strong> 3-5 ngày làm việc.</li>
            <li><strong>Giao hàng nhanh:</strong> 1-2 ngày làm việc.</li>
            <li><strong>Giao hàng quốc tế:</strong> Chưa có dịch vụ này!</li>
        </ul>

        <h3>Chính Sách Đổi Trả</h3>
        <p>Chúng tôi cam kết mang đến sự hài lòng tối đa cho khách hàng. Nếu bạn không hài lòng với sản phẩm đã mua, vui lòng xem xét các chính sách đổi trả của chúng tôi:</p>
        <ul>
            <li><strong>Thời gian đổi trả:</strong> Trong vòng 30 ngày kể từ ngày nhận hàng.</li>
            <li><strong>Điều kiện sản phẩm:</strong> Sản phẩm phải còn nguyên vẹn, chưa qua sử dụng và còn nguyên bao bì.</li>
            <li><strong>Chi phí vận chuyển:</strong> Khách hàng chịu chi phí vận chuyển khi đổi trả.</li>
        </ul>

        <p>Để biết thêm chi tiết, vui lòng xem trang <a href="/shipping-policy">chính sách vận chuyển</a> và <a href="/return-policy">chính sách đổi trả</a> của chúng tôi.</p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('policies', 'custom_policies_content');

// Tạo shortcode Free Shipping
function custom_free_shipping_content() {
    ob_start();
    ?>
    <div class="free-shipping-content">
        <h2>Chính Sách Giao Hàng Miễn Phí</h2>
        <p>Chúng tôi cung cấp dịch vụ giao hàng miễn phí cho tất cả các đơn hàng đủ điều kiện:</p>
        <ul>
            <li><strong>Đơn hàng nội địa:</strong> Miễn phí vận chuyển cho các đơn hàng từ 500,000₫ trở lên.</li>
            <li><strong>Đơn hàng quốc tế:</strong> Chưa có dịch vụ này!</li>
        </ul>
        <p>Hãy tận hưởng chính sách giao hàng miễn phí khi mua sắm tại cửa hàng của chúng tôi!</p>
        <p>Để biết thêm chi tiết, vui lòng xem <a href="/shipping-policy">chính sách giao hàng</a> của chúng tôi.</p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('free_shipping', 'custom_free_shipping_content');

add_action('template_redirect', 'allow_guest_access_to_shop');
function allow_guest_access_to_shop() {
    if (!is_user_logged_in() && is_shop()) {
        // Kiểm tra xem nếu người dùng chưa đăng nhập và đang truy cập trang shop
        remove_action('template_redirect', 'woocommerce_template_redirect'); // Bỏ qua ràng buộc của WooCommerce
    }
}

// --------------------------------------------FORM REGISTER/LOGIN & SEND EMAIL ------------------------------------------

// Thêm tùy chọn đăng nhập và đăng ký vào trang thanh toán nếu người dùng chưa đăng nhập
add_action('woocommerce_before_checkout_form', 'custom_login_register_message_on_checkout', 5);
function custom_login_register_message_on_checkout() {
    if ( !is_user_logged_in() ) {
        ?>
        <div class="woocommerce-info">
            <p>
                Bạn đã có tài khoản? <a href="#" class="showlogin">Ấn vào đây để đăng nhập</a> hoặc <a href="#" class="showregister">Đăng ký tài khoản mới</a>.
            </p>
        </div>

        <!-- Hiển thị form đăng nhập -->
        <div class="login-form" style="display:none;">
            <h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

            <form class="woocommerce-form woocommerce-form-login login" method="post">

                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
                </p>

                <?php do_action( 'woocommerce_login_form' ); ?>

                <p class="form-row">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                    </label>
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
                </p>
                <p class="woocommerce-LostPassword lost_password">
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
                </p>

                <?php do_action( 'woocommerce_login_form_end' ); ?>

            </form>
        </div>

        <!-- Hiển thị form đăng ký -->
        <div class="register-form" style="display:none;">
            <h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

                <?php do_action( 'woocommerce_register_form_start' ); ?>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" />
                    </p>

                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" />
                </p>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
                    </p>

                <?php else : ?>

                    <p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

                <?php endif; ?>

                <?php do_action( 'woocommerce_register_form' ); ?>

                <p class="woocommerce-form-row form-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                </p>

                <?php do_action( 'woocommerce_register_form_end' ); ?>

            </form>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.showlogin').click(function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Login link clicked');
                    $('.login-form').slideToggle();
                    $('.register-form').slideUp();
                });
                $('.showregister').click(function(e) {
                    e.preventDefault();
                    $('.register-form').slideToggle();
                    $('.login-form').slideUp();
                });
            });
        </script>
        <?php
    }
}

//---------------------------------------------------------- ORDER RECEIVED PAGE -----------------------------------------------------------

add_action('woocommerce_thankyou_bacs', function($order_id){
    $bacs_info = get_option('woocommerce_bacs_accounts');
    if(!empty($bacs_info) && count($bacs_info) > 0):
        $order = wc_get_order( $order_id );
        $content = 'Don hang ' . $order->get_order_number(); // Nội dung chuyển khoản
    ?>
        <div class="vdh_qr_code">
	    <?php foreach($bacs_info as $item): ?>
	    <span class="vdh_bank_item">
	        <img class="img_qr_code" src="https://img.vietqr.io/image/<?php echo $item['bank_name']?>-<?php echo $item['account_number']?>-print.jpg?amount=<?php echo $order->get_total() ?>&addInfo=<?php echo $content ?>&accountName=<?php echo $item['account_name']?>" alt="QR Code">
	    </span>
	    <?php endforeach; ?>

            <div id="modal_qr_code" class="modal">
	        <img class="modal-content" id="img01">
	    </div>
        </div>

	

	<script>
        $(document).ready(function() {
            $('.vdh_bank_item').on('click', function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định
                e.stopPropagation();
            });
        });

	    const modal = document.getElementById('modal_qr_code');
	    const modalImg = document.getElementById("img01");
	    var img = document.querySelectorAll('.img_qr_code');
	    for (var i=0; i<img.length; i++){
	        img[i].onclick = function(){
		    modal.style.display = "block";
		    modalImg.src = this.src;
		    modalImg.alt = this.alt;
		}
	    }
	    modal.onclick = function() {
	        img01.className += " out";
		setTimeout(function() {
		    modal.style.display = "none";
		    img01.className = "modal-content";
		}, 400);
	    }
	</script>
    <?php
    endif;
});

// ------------------------------------------------------------- THEME OPTION --------------------------------------------------------------

// ----------------- SECTION TOPBAR & COPYRIGHT
add_action( 'customize_register', 'theme_option_customize' );

function theme_option_customize($wp_customize) {
    // --------------------------- SECTION TOPBAR ------------------------------
    // Add section
	$wp_customize->add_section("sec-topbar", array(
		"title" => "Topbar Settings",
		"description" => "Settings for the topbar"
	));

	// Phone Number Setting
	$wp_customize->add_setting("set-topbar-phone", array(
		"type" => "theme_mod",
		"default" => "+84 123 456 789",
		"sanitize_callback" => "sanitize_text_field"
	));

	$wp_customize->add_control("set-topbar-phone", array(
		"label" => "Phone Number",
		"section" => "sec-topbar",
		"type" => "text"
	));

	// Email Setting
	$wp_customize->add_setting("set-topbar-email", array(
		"type" => "theme_mod",
		"default" => "vochuong57@gmail.com",
		"sanitize_callback" => "sanitize_email"
	));

	$wp_customize->add_control("set-topbar-email", array(
		"label" => "Email Address",
		"section" => "sec-topbar",
		"type" => "email"
	));

	// Free Shipping Text Setting
	$wp_customize->add_setting("set-topbar-shipping", array(
		"type" => "theme_mod",
		"default" => "Free VN Shipping",
		"sanitize_callback" => "sanitize_text_field"
	));

	$wp_customize->add_control("set-topbar-shipping", array(
		"label" => "Free Shipping Text",
		"section" => "sec-topbar",
		"type" => "text"
	));

	// Return Policy Text Setting
	$wp_customize->add_setting("set-topbar-return", array(
		"type" => "theme_mod",
		"default" => "30 Day Menu Back",
		"sanitize_callback" => "sanitize_text_field"
	));

	$wp_customize->add_control("set-topbar-return", array(
		"label" => "Return Policy Text",
		"section" => "sec-topbar",
		"type" => "text"
	));

	// Customer Support Text Setting
	$wp_customize->add_setting("set-topbar-support", array(
		"type" => "theme_mod",
		"default" => "24/7 Customer Support",
		"sanitize_callback" => "sanitize_text_field"
	));

	$wp_customize->add_control("set-topbar-support", array(
		"label" => "Customer Support Text",
		"section" => "sec-topbar",
		"type" => "text"
	));


    // --------------------------- SECTION COPYRIGHT ------------------------------
	//Add Section 
	$wp_customize->add_section("sec-copyright", array(
		"title" => "Copyright Settings",
		"description" => "This is a Description for copy right"
	));

	//Add setting
	$wp_customize->add_setting("set-copyright", array(
		"type" => "theme_mod",
		"default" => "© Woocommerce Pet Shop 2024 created by Group 10 Dev",
		"sanitize_callback" => "sanitize_text_field"
	));

	//Add Control 
    $wp_customize->add_control("set-copyright", array(
		"label" => "Copyright",
		"description" =>"Please fill description for copyright",
		"section" => "sec-copyright",
		"type" => "text"
	));

}

// ----------------- SECTION DISPLAY PRODUCTS
add_action('customize_register', 'product_section_customize');

function product_section_customize($wp_customize) {
    // Add Section
    $wp_customize->add_section('sec-product-display', array(
        'title' => 'Product Display Settings',
        'description' => 'Customize the display of products in different sections'
    ));

    // Setting for Product Limit (Best Selling)
    $wp_customize->add_setting('set-product-limit-best-selling', array(
        'type' => 'theme_mod',
        'default' => 4,
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control('set-product-limit-best-selling', array(
        'label' => 'Best Selling Products Limit',
        'description' => 'Number of best-selling products to display',
        'section' => 'sec-product-display',
        'type' => 'number',
    ));

    // Setting for Columns (Best Selling)
    $wp_customize->add_setting('set-product-columns-best-selling', array(
        'type' => 'theme_mod',
        'default' => 4,
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control('set-product-columns-best-selling', array(
        'label' => 'Best Selling Products Columns',
        'description' => 'Number of columns for best-selling products',
        'section' => 'sec-product-display',
        'type' => 'number',
    ));

    // Setting for Sorting Order (Best Selling)
    $wp_customize->add_setting('set-product-orderby-best-selling', array(
        'type' => 'theme_mod',
        'default' => 'best_selling',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('set-product-orderby-best-selling', array(
        'label' => 'Best Selling Products Order',
        'section' => 'sec-product-display',
        'type' => 'select',
        'choices' => array(
            'best_selling' => 'Best Selling',
            'popularity' => 'Popularity',
            'rating' => 'Rating',
            'date' => 'Newest',
        ),
    ));

    // Setting for Product Limit (On Sale)
    $wp_customize->add_setting('set-product-limit-on-sale', array(
        'type' => 'theme_mod',
        'default' => 4,
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control('set-product-limit-on-sale', array(
        'label' => 'On Sale Products Limit',
        'description' => 'Number of on-sale products to display',
        'section' => 'sec-product-display',
        'type' => 'number',
    ));

    // Setting for Columns (On Sale)
    $wp_customize->add_setting('set-product-columns-on-sale', array(
        'type' => 'theme_mod',
        'default' => 4,
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control('set-product-columns-on-sale', array(
        'label' => 'On Sale Products Columns',
        'description' => 'Number of columns for on-sale products',
        'section' => 'sec-product-display',
        'type' => 'number',
    ));

    // Setting for Sorting Order (On Sale)
    $wp_customize->add_setting('set-product-orderby-on-sale', array(
        'type' => 'theme_mod',
        'default' => 'popularity',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('set-product-orderby-on-sale', array(
        'label' => 'On Sale Products Order',
        'section' => 'sec-product-display',
        'type' => 'select',
        'choices' => array(
            'popularity' => 'Popularity',
            'rating' => 'Rating',
            'date' => 'Newest',
            'price' => 'Price',
        ),
    ));
}

// ----------------- SECTION PRODUCT ROW HEADING
add_action('customize_register', 'product_row_heading_customize');

function product_row_heading_customize($wp_customize) {
    // Add Section for Product Row Heading 1
    $wp_customize->add_section('sec-product-row-heading-1', array(
        'title' => 'Product Row Heading 1',
        'description' => 'Customize the Product Row Heading 1 section'
    ));

    // Setting for Product Row Heading 1 Title
    $wp_customize->add_setting('set-product-row-heading-1-title', array(
        'type' => 'theme_mod',
        'default' => 'Popular Products',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('set-product-row-heading-1-title', array(
        'label' => 'Product Row Heading 1 Title',
        'description' => 'Enter the title for Product Row Heading 1',
        'section' => 'sec-product-row-heading-1',
        'type' => 'text'
    ));

    // Setting for Product Row Heading 1 Description
    $wp_customize->add_setting('set-product-row-heading-1-description', array(
        'type' => 'theme_mod',
        'default' => 'lorem ipsum dolor sit amet consectetur adipiscing elit. Sint, id!',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    $wp_customize->add_control('set-product-row-heading-1-description', array(
        'label' => 'Product Row Heading 1 Description',
        'description' => 'Enter the description for Product Row Heading 1',
        'section' => 'sec-product-row-heading-1',
        'type' => 'textarea'
    ));

    // Add Section for Product Row Heading 2
    $wp_customize->add_section('sec-product-row-heading-2', array(
        'title' => 'Product Row Heading 2',
        'description' => 'Customize the Product Row Heading 2 section'
    ));

    // Setting for Product Row Heading 2 Title
    $wp_customize->add_setting('set-product-row-heading-2-title', array(
        'type' => 'theme_mod',
        'default' => 'Specials Offers',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('set-product-row-heading-2-title', array(
        'label' => 'Product Row Heading 2 Title',
        'description' => 'Enter the title for Product Row Heading 2',
        'section' => 'sec-product-row-heading-2',
        'type' => 'text'
    ));

    // Setting for Product Row Heading 2 Description
    $wp_customize->add_setting('set-product-row-heading-2-description', array(
        'type' => 'theme_mod',
        'default' => 'lorem ipsum dolor sit amet consectetur adipiscing elit. Sint, id!',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));
    $wp_customize->add_control('set-product-row-heading-2-description', array(
        'label' => 'Product Row Heading 2 Description',
        'description' => 'Enter the description for Product Row Heading 2',
        'section' => 'sec-product-row-heading-2',
        'type' => 'textarea'
    ));
}
