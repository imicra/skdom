<?php
/**
 * Additional Services section
 *
 * @package sk-dom
 */

$skdom_services_title    = get_theme_mod( 'skdom_services_title', esc_html__( 'Дополнительные услуги', 'skdom' ) );
$skdom_services_subtitle = get_theme_mod( 'skdom_services_subtitle', esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ) );

//Section id
$skdom_services_hash = get_theme_mod( 'skdom_services_hash', esc_html__( 'services', 'skdom' ) );
if ( ! empty( $skdom_services_hash ) ) {
    $id = 'id=' . $skdom_services_hash;
} else {
    $id = '';
}

//Section background color option
$skdom_section_bg = get_theme_mod( 'skdom_services_section_bg_color', true );

if ( isset( $skdom_section_bg ) && ( $skdom_section_bg == 1 ) ) {
    $bg = ' section-bg';
} else {
    $bg = '';
}

/* 
 * Display Services post type
 */
$skdom_services_number = get_theme_mod( 'skdom_services_number', 4 );

$args = array( 
    'post_type' => 'services', 
    'posts_per_page' => $skdom_services_number,
    'orderby' => array( 'menu_order' => 'ASC' ),
);

$services = new WP_Query( $args );

if ( ! empty( $skdom_services_title ) || ! empty( $skdom_services_subtitle ) || ( $services->have_posts() ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="services section<?php if ( ! empty( $bg ) ) echo esc_attr( $bg ); ?>">
                <div class="container-fluid">
                    <?php 
                        if ( ! empty( $skdom_services_title ) || ! empty( $skdom_services_subtitle )  ) { ?>
                            <div class="row wrapper">
                                    <div class="section-heading">
                                        <?php
                                            if ( ! empty( $skdom_services_title ) ) { ?>
                                                <h2><?php echo wp_kses_post( $skdom_services_title ); ?></h2>
                                                <div class="line-short"></div>
                                        <?php
                                            } ?>
                                        <?php
                                            if ( ! empty( $skdom_services_subtitle ) ) { ?>
                                                <p class="col-sm-8 col-sm-offset-2"><?php echo wp_kses_post( $skdom_services_subtitle ); ?></p>
                                        <?php
                                            } ?>
                                    </div>
                            </div><!-- row -->
                    <?php } 
                        if ( $services->have_posts() ) {
                            
                            /*Counter for columns in row*/
                            $skdom_services_col = get_theme_mod( 'skdom_services_col', 4 );

                            $numOfCols = $skdom_services_col;
                            $rowCount = 0;
                            $bootstrapColWidth = 12 / $numOfCols;
                    ?>
                            <div class="row wrapper">
                                <?php while ( $services->have_posts() ) : $services->the_post(); ?>
                                    <div class="block-col col-sm-5 col-sm-offset-1 col-md-<?php echo $bootstrapColWidth; ?> col-md-offset-0">
                                            <div class="block-col__inner">
                                                    <figure class="block-col-pic">
                                                            <div class="hexagon-round">
                                                                    <div class="hexagon-round-back">
                                                                            <div class="hexagon-round-back-inner">
                                                                                    <div class="hexagon-round-back-inner-before"></div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="hexagon-img hexagon2">
                                                                            <div class="hexagon-in1">
                                                                                <?php
                                                                                    $url = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'skdom-services-thumb');
                                                                                ?>
                                                                                    <div class="hexagon-in2" style="background-image: url(<?php echo $url[0]; ?>);"></div>
                                                                            </div>
                                                                    </div>
                                                            </div><!-- hexagon-round -->
                                                    </figure>
                                                    <h2>
                                                        <?php the_title(); ?>
                                                    </h2>
                                                    <div class="line"></div>
                                                    <p>
                                                        <?php echo get_the_excerpt(); ?>
                                                    </p>
                                                    <?php 
                                                        $skdom_services_button = get_theme_mod( 'skdom_services_button', esc_html__( 'Подробнее', 'skdom' ) );
                                                        
                                                        if ( ! empty( $skdom_services_button ) ) { ?>
                                                            <a class="button size-3 style-4" href="<?php the_permalink(); ?>">
                                                                <?php echo wp_kses_post( $skdom_services_button ); ?>
                                                            </a>
                                                        <?php } ?>
                                            </div><!-- block-col__inner -->
                                    </div><!-- block-col -->
                                <?php
                                    $rowCount++;
                                    if( $rowCount % $numOfCols == 0 ) { 
                                        echo '</div><div class="row wrapper">';
                                    }
                                endwhile; ?>
                            </div><!-- row -->
                    <?php
                        } else {
                            get_template_part( 'inc/demo-content/skdom_services_section', 'demo' );
                        }// End if(). 

                        wp_reset_postdata();
                    ?>
                </div><!-- container-fluid -->
        </section><!-- section -->
<?php
}  // End if().