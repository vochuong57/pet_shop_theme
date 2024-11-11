<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package woocommerce_theme
 */

get_header();
?>

<main id="primary" class="site-main container cart checkout account thankyou post">
    <!-- <div class="container"> -->
    <?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
    <!-- </div> -->
    <div class="post-list">
        <?php
    // Kiểm tra nếu đang ở trang có slug là "bai-viet"
    if ( is_page('bai-viet') ) : ?>
        <!-- <h2>Danh sách bài viết</h2> -->
        <div class="row">
            <?php
            // Khởi tạo truy vấn để lấy các bài viết
            $args = array(
                'post_type' => 'post',     // Loại bài viết
                'posts_per_page' => 10,    // Số lượng bài viết hiển thị
            );
            $the_query = new WP_Query( $args );

            // Kiểm tra nếu có bài viết
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    ?>
            <div class="col-md-4 col-12 mb-4">
                <div class="post-item card h-100">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('high', ['class' => 'card-img-top']); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="post-meta mb-2 text-muted">
                            <span class="author"><i class="fa fa-user"></i> by <?php the_author(); ?></span>
                            <span class="comments"><i class="fa fa-comments"></i>
                                <?php comments_number( '0', '1', '%' ); ?>
                            </span>
                        </div>
                        <div class="post-excerpt card-text">
                            <?php 
                                        // Hiển thị giới hạn 100 ký tự đầu tiên của nội dung
                                        // echo wp_trim_words(get_the_content(), 20, '...');
                                         // Hiển thị giới hạn 100 ký tự đầu tiên của nội dung, không làm bể giao diện
                                        $content = get_the_content();
                                        
                                        // Cắt văn bản để chỉ hiển thị 100 ký tự đầu tiên
                                        echo wp_html_excerpt($content, 100) . '...';
                                    ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="read-more-btn">Đọc thêm</a>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
                // Reset lại các truy vấn sau khi sử dụng WP_Query
                wp_reset_postdata();
            else :
                echo '<p>Không có bài viết nào để hiển thị.</p>';
            endif;
            ?>
        </div>
        <?php endif; ?>
    </div>

</main><!-- #main -->

<?php
// get_sidebar();
get_footer();