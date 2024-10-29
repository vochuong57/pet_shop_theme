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
	elseif ( 'Sale!' === $text ) {
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
    $min_amount = 20;
    $current_amount = WC()->cart->subtotal;
    if($current_amount<$min_amount){
        ?>  
            <div class="woocommerce-message">
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