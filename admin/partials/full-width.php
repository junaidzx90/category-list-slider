<?php wp_enqueue_style('full-width'); ?>

<div class="slider">
    <?php
    $the_query = new WP_Term_Query($atts);
    foreach ($the_query->get_terms() as $term) {
        ?>
        <div class="slide">
            <span class="overley"></span>
            <img src="<?php echo get_term_meta($term->term_id,'term_image',true); ?>" alt="term-img" />
            <div class="slideinfo">
                <h3><a href="<?php echo esc_url(get_term_link( $term->term_id )) ?>"><?php echo _e($term->name); ?></a></h3>
                <p><?php echo _e($term->description); ?></p>
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
            slidesToShow: 1,
        });
    });
</script>