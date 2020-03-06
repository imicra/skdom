<?php
/**
 * Gallery section
 *
 * @package sk-dom
 */

$skdom_gallery_bgimage  = get_theme_mod( 'skdom_gallery_bgimage', get_template_directory_uri() . '/img/gallery-bg.jpg' );
$skdom_gallery_title    = get_theme_mod( 'skdom_gallery_title', esc_html__( 'Лучшее, что мы построили', 'skdom' ) );
$skdom_gallery_subtitle = get_theme_mod( 'skdom_gallery_subtitle', esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ) );
$skdom_gallery_button   = get_theme_mod( 'skdom_gallery_button', esc_html__( 'Вся галерея', 'skdom' ) );
$skdom_gallery_link     = get_theme_mod( 'skdom_gallery_link', '0' );
$skdom_gallery_item = get_theme_mod( 'skdom_gallery_item', true );

//Section id
$skdom_gallery_hash = get_theme_mod( 'skdom_gallery_hash', esc_html__( 'gallery', 'skdom' ) );
if ( ! empty( $skdom_gallery_hash ) ) {
    $id = 'id=' . $skdom_gallery_hash;
} else {
    $id = '';
}

/* 
 * Display Portfolio post type
 */
$skdom_gallery_number = get_theme_mod( 'skdom_gallery_number', 6 );

$args = array( 
    'post_type' => 'portfolio', 
    'posts_per_page' => $skdom_gallery_number,
    'orderby' => 'DESC',
);

$portfolio = new WP_Query( $args );

if ( ! empty( $skdom_gallery_title ) || ! empty( $skdom_gallery_subtitle ) || ( $portfolio->have_posts() ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="gallery section">
                <div class="container-fluid">
                    <?php
                    if ( ! empty( $skdom_gallery_bgimage ) ) { ?>
                        <div class="block-bg bg-image bg-center" style="background-image: url(<?php echo esc_url( $skdom_gallery_bgimage ); ?>);"></div>
                    <?php } ?>
                        <div class="block-bg overlay"></div>
                        <div class="row wrapper">
                            <?php 
                            if ( ! empty( $skdom_gallery_title ) || ! empty( $skdom_gallery_subtitle )  ) { ?>
                                <div class="section-heading">
                                    <?php
					if ( ! empty( $skdom_gallery_title ) ) { ?>
                                            <h2><?php echo wp_kses_post( $skdom_gallery_title ); ?></h2>
                                            <div class="line-short"></div>
                                    <?php
                                        } ?>
                                    <?php
					if ( ! empty( $skdom_gallery_subtitle ) ) { ?>
                                            <p class="col-sm-8 col-sm-offset-2"><?php echo wp_kses_post( $skdom_gallery_subtitle ); ?></p>
                                    <?php
                                        } ?>
                                </div><!--section-heading-->
                            <?php } ?>
                            <?php
                                if ( $portfolio->have_posts() ) {
                            ?>
                                    <div class="portfolio-wrapper col-md-10 col-md-offset-1">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <?php
                                                        /*Counter for columns in row*/
                                                        $skdom_gallery_col = get_theme_mod( 'skdom_gallery_col', 3 );

                                                        $numOfCols = $skdom_gallery_col;
                                                        $rowCount = 0;
                                                        $bootstrapColWidth = 12 / $numOfCols;

                                                        while ( $portfolio->have_posts() ) : $portfolio->the_post();

                                                            if( has_post_thumbnail() ) {

                                                                $url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                                                    ?>
                                                                <div class="portfolio-item col-sm-<?php echo $bootstrapColWidth; ?>">
                                                                        <figure class="image-frame">
                                                                                <div class="image-wrapper">
                                                                                    <a href="<?php the_permalink(); ?>">
                                                                                            <div class="mask"></div>
                                                                                            <?php the_post_thumbnail('skdom-galley-thumb'); ?>
                                                                                    </a>
                                                                                        <?php
                                                                                            //Class for double link (for Link to portfolio item)
                                                                                            if ( isset( $skdom_gallery_item ) && ( $skdom_gallery_item == 1 ) ) {
                                                                                                $class = ' double';
                                                                                            } else {
                                                                                                $class = '';
                                                                                            }

                                                                                            //Gallery Lightbox Mod
                                                                                            $skdom_gallery_lightbox = get_theme_mod( 'skdom_gallery_lightbox', 'gallery' );

                                                                                            if( 'gallery' != $skdom_gallery_lightbox ) {
                                                                                                $rel = '';
                                                                                                $title = '';
                                                                                            } else {
                                                                                                $rel = 'rel=gallery';
                                                                                                $title = 'title="' . get_the_excerpt( $post->ID ) . '"';
                                                                                            }
                                                                                        ?>
                                                                                        <div class="image-links<?php if ( ! empty( $class ) ) { echo esc_attr( $class ); }?>">
                                                                                                <a class="fancybox" <?php if ( ! empty( $rel ) ) { echo esc_attr( $rel ); }?> href="<?php echo $url[0]; ?>" <?php if ( ! empty( $title ) ) { echo $title; }?>><i class="fa fa-search"></i></a>
                                                                                                <?php if ( isset( $skdom_gallery_item ) && ( $skdom_gallery_item == 1 ) ) { ?>
                                                                                                    <a class="fancybox" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                                                                                <?php } ?>
                                                                                        </div>
                                                                                </div>
                                                                        </figure>
                                                                        <?php if ( isset( $skdom_gallery_item ) && ( $skdom_gallery_item == 1 ) ) { ?>
                                                                            <figcaption class="desc">
                                                                                <a href="<?php the_permalink(); ?>" alt="">
                                                                                    <h5>
                                                                                        <?php the_title(); ?>
                                                                                    </h5>
                                                                                </a>
                                                                            </figcaption>
                                                                        <?php } ?>
                                                                </div>
                                                    <?php
                                                            } // End if(). 
                                                            $rowCount++;
                                                            if( $rowCount % $numOfCols == 0 ) { 
                                                                echo '</div><div class="row">';
                                                            }
                                                    endwhile; ?>
                                                </div><!-- row -->
                                            </div><!-- container-fluid -->
                                            <?php if ( ! empty( $skdom_gallery_button ) ) {

                                                if ( ! empty( $skdom_gallery_link ) || ( $skdom_gallery_link == 1 ) ) {
                                                    $gallery_url = get_permalink( $skdom_gallery_link );
                                                    $onclick = '';
                                                } else {
                                                    $gallery_url = '#';
                                                    $onclick = ' onclick="return false;"';
                                                }
                                            ?>
                                                    <a href="<?php echo $gallery_url; ?>"<?php if ( ! empty( $onclick ) ) {  echo $onclick; } ?> class="button size-2 style-3 full">
                                                            <h4><?php echo wp_kses_post( $skdom_gallery_button ); ?> <i class="fa fa-chevron-right"></i></h4>
                                                    </a>
                                            <?php } ?>
                                    </div><!-- portfolio-wrapper -->
                                <?php
                                    } else {
                                        get_template_part( 'inc/demo-content/skdom_gallery_section', 'demo' );
                                    }// End if(). 

                                    wp_reset_postdata();
                                ?>
                        </div><!-- row -->
                </div><!-- container-fluid -->
        </section><!-- #gallery -->
<?php
}  // End if().