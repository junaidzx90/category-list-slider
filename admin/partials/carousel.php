<?php wp_enqueue_style('carousel'); ?>
<div class="slider">
    <?php 
    $the_query = new WP_Term_Query($atts);
    foreach ($the_query->get_terms() as $term) {
        ?>
        <div class="slide">
            <img src="<?php echo get_term_meta($term->term_id,'term_image',true); ?>" alt="term-img" />
            <div class="slideinfo">
                <a href="<?php echo esc_url(get_term_link( $term->term_id )) ?>"><?php echo _e($term->name); ?></a>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<script>
    jQuery(function ($) {
        $('.slider').slick({
            centerMode: true,
            slidesToShow: <?php echo $atts['slide']; ?>,
            responsive: [
                {
                breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        slidesToShow: 3
                    }
                },
                {
                breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>