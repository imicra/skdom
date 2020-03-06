<?php
/**
 * Promo section
 *
 * @package sk-dom
 */

$skdom_promo_bgimage  = get_theme_mod( 'skdom_promo_bgimage', get_template_directory_uri() . '/img/promo-bg.jpg' );
$skdom_promo_title    = get_theme_mod( 'skdom_promo_title', esc_html__( 'Дома из дерева', 'skdom' ) );
$skdom_promo_subtitle = get_theme_mod( 'skdom_promo_subtitle', esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ) );
$default              = skdom_promo_get_default_content();
$skdom_promo_content  = get_theme_mod( 'skdom_promo_content', $default );

//Section id
$skdom_promo_hash = get_theme_mod( 'skdom_promo_hash', esc_html__( 'promo', 'skdom' ) );
if ( ! empty( $skdom_promo_hash ) ) {
    $id = 'id=' . $skdom_promo_hash;
} else {
    $id = '';
}

//WOW effect
$skdom_promo_wow = get_theme_mod( 'skdom_promo_wow', true );

if ( isset( $skdom_promo_wow ) && ( $skdom_promo_wow == 1 ) ) {
    $wow = ' wow';
} else {
    $wow = '';
}

if ( ! empty( $skdom_promo_title ) || ! empty( $skdom_promo_subtitle ) || ! skdom_general_repeater_is_empty( $skdom_promo_content ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="section bg-image bg-center" style="background-image: url(<?php echo esc_url( $skdom_promo_bgimage ); ?>);">
                <div class="container-fluid">
                        <div class="row wrapper">
                                <div class="promo-headline col-md-6 col-sm-12">
                                    <?php 
                                    if ( ! empty( $skdom_promo_title ) || ! empty( $skdom_promo_subtitle )  ) { ?>
                                        <div class="verticallign">
                                                <div class="section-heading">
                                                    <?php
                                                        if ( ! empty( $skdom_promo_title ) ) { ?>
                                                            <h2><?php echo wp_kses_post( $skdom_promo_title ); ?></h2>
                                                    <?php
                                                        } ?>
                                                    <?php
                                                        if ( ! empty( $skdom_promo_subtitle ) ) { ?>
                                                            <p><?php echo wp_kses_post( $skdom_promo_subtitle ); ?></p>
                                                    <?php
                                                        } ?>
                                                </div><!--section-heading-->
                                        </div>
                                    <?php } ?>
                                </div><!-- promo-headline -->
                                <?php
                                    if ( ! empty( $skdom_promo_content ) ) {
                                        $skdom_promo_content_decoded = json_decode( $skdom_promo_content );
                                ?>
                                <div class="promo-cont col-md-6 col-sm-12">
                                    <div class="swiper-container__promo">
                                        <div class="swiper-wrapper">
                                            <?php
                                                /*Counter for columns in row*/
                                                $skdom_promo_col = get_theme_mod( 'skdom_promo_col', 2 );
                                                
                                                $numOfCols = $skdom_promo_col;
                                                $rowCount = 0;
                                                $bootstrapColWidth = 12 / $numOfCols;
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <?php
                                                            /*Counter for checking to generate row tags after 3 columns*/
//                                                            $it = 1;
                                                            foreach ( $skdom_promo_content_decoded as $skdom_promo_content_block ) {
                                                                $icon_font        = ! empty( $skdom_promo_content_block->icon_font ) ? $skdom_promo_content_block->icon_font : '';
                                                                $icon             = ! empty( $skdom_promo_content_block->icon_value ) ? apply_filters( 'skdom_translate_single_string', $skdom_promo_content_block->icon_value, 'Promo Block Section' ) : '';
                                                                $title            = ! empty( $skdom_promo_content_block->title ) ? apply_filters( 'skdom_translate_single_string', $skdom_promo_content_block->title, 'Promo Block Section' ) : '';
                                                                $text             = ! empty( $skdom_promo_content_block->text ) ? apply_filters( 'skdom_translate_single_string', $skdom_promo_content_block->text, 'Promo Block Section' ) : '';
                                                                $page_url         = ! empty( $skdom_promo_content_block->page_url ) ? apply_filters( 'skdom_translate_single_string', $skdom_promo_content_block->page_url, 'Promo Block Section' ) : '';
                                                                $section_is_empty = empty( $icon ) && empty( $title ) && empty( $text );

                                                                if ( ! $section_is_empty ) { ?>
                                                                    <div class="col-sm-<?php echo $bootstrapColWidth; ?> block-icon icon-inner<?php if ( ! empty( $wow ) ) { echo esc_attr( $wow ); } ?> bounceInRight">
                                                                        <?php 
                                                                            if( ! empty( $icon_font ) ) { 
                                                                                if ( ! empty( $icon ) && $icon_font === 'ifamily_sk' ) { ?>
                                                                                    <i class="sk <?php echo esc_attr( $icon ); ?>"></i>
                                                                                <?php
                                                                                }
                                                                                if ( ! empty( $icon ) && $icon_font === 'ifamily_fa' ) { ?>
                                                                                    <i class="fa <?php echo esc_attr( $icon ); ?>"></i>
                                                                        <?php
                                                                                }
                                                                            }
                                                                            if( ! empty( $title ) ) {
                                                                                if( ! empty( $page_url ) ) {
                                                                        ?>
                                                                                    <a href="<?php echo get_permalink( $page_url ); ?>">
                                                                                            <h3><?php echo wp_kses_post( $title ); ?></h3>
                                                                                    </a>
                                                                        <?php
                                                                                } else { ?>
                                                                                    <h3><?php echo wp_kses_post( $title ); ?></h3>
                                                                                <?php 
                                                                                }
                                                                            }
                                                                            if( ! empty( $text ) ) {
                                                                        ?>
                                                                            <p><?php echo html_entity_decode( $text ); ?></p>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                    $rowCount++;
                                                                    if ( $rowCount % $numOfCols == 0 ) {
                                                                        echo '</div></div></div><div class="swiper-slide"><div class="container-fluid"><div class="row">';
                                                                    }
//                                                                    if ( $it % 2 == 0 ) {
//                                                                        echo '</div></div></div><div class="swiper-slide"><div class="container-fluid"><div class="row">';
//                                                                    }
                                                                } //End if
//                                                                $it++;
                                                            } //End foreach
                                                        ?>
                                                    </div><!-- row -->
                                                </div><!-- container-fluid -->
                                            </div><!-- swiper-slide -->
                                        </div><!-- swiper-wrapper -->
                                    <div class="swiper-pagination"></div>
                                    </div><!-- swiper-container__promo -->
                                </div><!-- promo-cont -->
                                <?php
                                    } //End if
                                ?>
                        </div><!-- row -->
                </div><!-- container-fluid -->
                <div class="overlay"></div>
        </section><!-- #promo -->
<?php
}  // End if().