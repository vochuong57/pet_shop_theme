<?php
get_header();
?>

<!-- Nội dung của trang chủ -->
<div class="container pt-3"> 
    <div id="carouselExampleIndicators" class="carousel slide">
        <!-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        </div> -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo get_template_directory_uri().'/images/slide-1.jpg' ?>" class="d-block w-100"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?php echo get_template_directory_uri().'/images/slide-2.jpg' ?>" class="d-block w-100"
                    alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<section class="container pt-4">
    <div class="product__row-heading text-center">
        <h2>Popular Products</h2>
        <p>lorem ipsum dolor sit amet consectetur adipiscing elit. Sint, id!</p>
    </div>
    <div class="product__row-content">
        <?php echo do_shortcode('[products limit="4" columns="4"]') ?>
    </div>
</section>

<section class="container pt-4">
    <div class="category__row-heading text-center pb-4">
        <h2>Categories</h2>
        <p>lorem ipsum dolor sit amet consectetur adipiscing elit. Sint, id!</p>
    </div>
    <div class="category__col">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100" src="<?php echo get_template_directory_uri().'/images/toys.jpg' ?>" alt="">
                        <h2 class="position-absolute bottom-0 start-0 w-100 text-center text-white mb-0 pt-2 pb-2">Toys</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100" src="<?php echo get_template_directory_uri().'/images/food.jpg' ?>" alt="">
                        <h2 class="position-absolute bottom-0 start-0 w-100 text-center text-white mb-0 pt-2 pb-2">Food</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100" src="<?php echo get_template_directory_uri().'/images/care.jpg' ?>" alt="">
                        <h2 class="position-absolute bottom-0 start-0 w-100 text-center text-white mb-0 pt-2 pb-2">Care</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="row pt-md-4">
            <div class="col-md-4 col-12">
                <div class="category__col-content position-relative">
                    <a href="">
                        <img class="w-100" src="<?php echo get_template_directory_uri().'/images/accessories.jpg' ?>" alt="">
                        <h2 class="position-absolute bottom-0 start-0 w-100 text-center text-white mb-0 pt-2 pb-2"> Accessories</h2>
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="category__col-content position-relative">
                    <a href="">
                        <div class="category__col-background position-absolute w-100 h-100"></div>
                        <img class="w-100" src="<?php echo get_template_directory_uri().'/images/special-offers.jpg' ?>" alt="">
                        <h2 class="position-absolute bottom-0 start-0 w-100 text-center top-40 text-white mb-0 pt-2 pb-2 h2-last">Special Offers <br> up to 40% Off</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container pt-5">
    <div class="specials__row-heading text-center pb-4">
        <h2>Specials Offers</h2>
        <p>lorem ipsum dolor sit amet consectetur adipiscing elit. Sint, id!</p>
    </div>
    <div class="product__row-content">
        <?php echo do_shortcode('[products limit="4" columns="4"]') ?>
    </div>
</section>

<?php
get_footer();