<?php
/**
 * Testimonials section
 *
 * @package sk-dom
 */

$skdom_testimonials_bgimage  = get_theme_mod( 'skdom_testimonials_bgimage', get_template_directory_uri() . '/img/testimonials-bg.jpg' );
$skdom_testimonials_title    = get_theme_mod( 'skdom_testimonials_title', esc_html__( 'Наши клиенты о нас', 'skdom' ) );

//Section id
$skdom_testimonials_hash = get_theme_mod( 'skdom_testimonials_hash', esc_html__( 'testimonials', 'skdom' ) );
if ( ! empty( $skdom_testimonials_hash ) ) {
    $id = 'id=' . $skdom_testimonials_hash;
} else {
    $id = '';
}

/* 
 * Display 3 random testimonials
 */
$skdom_testimonials_number = get_theme_mod( 'skdom_testimonials_number', 3 );

$args = array( 
    'post_type' => 'testimonial', 
    'posts_per_page' => $skdom_testimonials_number,
    'orderby' => 'rand'
);

$testimonials = new WP_Query( $args );

if ( ! empty( $skdom_testimonials_title ) || ( $testimonials->have_posts() ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="section invert">
                <div class="container-fluid">
                    <?php
                        if ( ! empty( $skdom_testimonials_bgimage ) ) { ?>
                            <div class="block-bg bg-image bg-center" style="background-image: url(<?php echo esc_url( $skdom_testimonials_bgimage ); ?>);"></div>
                    <?php } ?>
                        <div class="block-bg overlay"></div>
                        <?php 
                            if ( ! empty( $skdom_testimonials_title ) ) { ?>
                                <div class="row">
                                        <div class="section-heading col-xs-12">
                                                <h2><?php echo wp_kses_post( $skdom_testimonials_title ); ?></h2>
                                                <div class="line-short"></div>
                                        </div>
                                </div><!-- row -->
                        <?php } ?>
                        <?php 
                            if ( $testimonials->have_posts() ) {
                        ?>
                            <div class="row">
                                <div class="testimonials col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
                                    <div class="swiper-container__testimonials">
                                        <div class="swiper-wrapper">
                                            <?php 
                                                while ( $testimonials->have_posts() ) : $testimonials->the_post();
                                            ?>
                                                <div class="testimonials-item swiper-slide">
                                                    <?php if( has_post_thumbnail() ) { ?>
                                                        <figure class="testimonials-pic">
                                                                <?php the_post_thumbnail('skdom-testimonial'); ?>
                                                                <div class="pic-ui">
                                                                        <i class="icon_quotations"></i>
                                                                </div>
                                                        </figure>
                                                    <?php } ?>
                                                        <p>
                                                            <?php echo get_the_excerpt(); ?>
                                                        </p>
                                                        <span class="author">
                                                            <?php the_title(); ?>
                                                        </span>
                                                        <span class="author">г. Сыктывкар</span>
                                                </div><!-- testimonials-item -->
                                            <?php endwhile; ?>
                                        </div><!-- swiper-wrapper -->
                                        <div class="button-slide button-prev"></div>
                                        <div class="button-slide button-next"></div>
                                    </div><!-- swiper-container__testimonials -->
                                </div><!-- testimonials -->
                            </div><!-- row -->
                        <?php
                            } else {
                                get_template_part( 'inc/demo-content/skdom_testimonials_section', 'demo' );
                            }// End if(). 
                            
                            wp_reset_postdata();
                        ?>
                </div><!-- container-fluid -->
        </section><!-- invert -->
<?php
}  // End if().