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