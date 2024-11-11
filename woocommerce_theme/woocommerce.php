<?php 
    get_header();

    // Đếm lượt view sản phẩm
    if (is_singular('product')) {
        set_product_views(get_the_ID());
    }
?>

<div class="container list-prod">
    <?php woocommerce_content(); ?>
</div>

<?php 
    get_footer();
?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Kiểm tra nếu footer nằm trong .container
        if ($('footer').closest('.container').length) {
            // Di chuyển footer ra ngoài container
            $('footer').appendTo('body');
        }
        
        $('ul').each(function() {
            // Kiểm tra nếu trong <ul> có thẻ <p>
            if ($(this).find('p').length > 0) {
                // Xóa thẻ <p>
                $(this).find('p').remove();
            }
        });
    });
</script>
