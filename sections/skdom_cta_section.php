<?php
/**
 * CTA section
 *
 * @package sk-dom
 */
$skdom_cta_bgimage  = get_theme_mod( 'skdom_cta_bgimage', get_template_directory_uri() . '/img/cta-bg.jpg' );
$skdom_cta_title  = get_theme_mod( 'skdom_cta_title', esc_html__( 'Позвоните нам:', 'skdom' ) );
$skdom_cta_phone  = get_theme_mod( 'skdom_cta_phone', esc_html__( ' (8212) 555-555', 'skdom' ) );
$skdom_cta_subtitle  = get_theme_mod( 'skdom_cta_subtitle', esc_html__( 'Мы ответим на все ваши вопросы', 'skdom' ) );
$default              = skdom_cta_ico_get_default_content();
$skdom_cta_ico        = get_theme_mod( 'skdom_cta_ico', $default );

//Section id
$skdom_cta_hash = get_theme_mod( 'skdom_cta_hash', esc_html__( 'cta', 'skdom' ) );
if ( ! empty( $skdom_cta_hash ) ) {
    $id = 'id=' . $skdom_cta_hash;
} else {
    $id = '';
}

$skdom_cta_parallax = get_theme_mod( 'skdom_cta_parallax', true );
$skdom_cta_attachment = get_theme_mod( 'skdom_cta_attachment', 'fixed' );

if ( isset( $skdom_cta_parallax ) && ( $skdom_cta_parallax == 1 ) ) {
    $parallax = ' data-stellar-background-ratio=0.5';
} else {
    $parallax = '';
}

if( $skdom_cta_attachment === 'fixed' ) {
    $bg = ' parallax-bg';
} else {
    $bg = '';
}

if ( ! empty( $skdom_cta_title ) || ! empty( $skdom_cta_phone ) || ! empty( $skdom_cta_subtitle ) || ! skdom_general_repeater_is_empty( $skdom_cta_ico ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="section cta-phone">
                <div class="container-fluid">
                    <?php
                    if ( ! empty( $skdom_cta_bgimage ) ) { ?>
                        <div class="block-bg bg-image<?php if ( ! empty( $bg ) ) echo esc_attr( $bg ); ?>"<?php if ( ! empty( $parallax ) ) echo esc_attr( $parallax ); ?> style="background-image: url(<?php echo esc_url( $skdom_cta_bgimage ); ?>);background-position-x: 50%;"></div>
                    <?php } ?>
                        <div class="block-bg overlay"></div>
                        <div class="row wrapper">
                                <div class="block-border col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                                        <div class="triangle-down">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                        </div>
                                        <?php
                                            if ( ! empty( $skdom_cta_ico ) ) {
                                                $skdom_cta_ico_decoded = json_decode( $skdom_cta_ico );
                                                
                                                /*Counter for checking to generate .social-ico if icons more than 1 item*/
                                                $it = 0;
                                                foreach ( $skdom_cta_ico_decoded as $skdom_cta_ico_block ) {
                                                    $icon_font    = ! empty( $skdom_cta_ico_block->icon_font ) ? $skdom_cta_ico_block->icon_font : '';
                                                    $icon         = ! empty( $skdom_cta_ico_block->icon_value ) ? apply_filters( 'skdom_translate_single_string', $skdom_cta_ico_block->icon_value, 'CTA Section' ) : '';
                                                    $link         = ! empty( $skdom_cta_ico_block->link ) ? apply_filters( 'skdom_translate_single_string', $skdom_cta_ico_block->link, 'CTA Section' ) : '';
                                                    $section_is_empty = empty( $icon );
                                                
                                                    if ( ! $section_is_empty ) {
                                                        if ( ! empty( $link ) ) {
                                                    ?>
                                                        <a href="<?php echo esc_attr( $link ); ?>" class="<?php if ( $it != 0 ) { echo 'social-ico'; }?>" target="_blank">
                                                            <?php if ( $icon_font === 'ifamily_fa' ) { ?>
                                                                <i class="fa <?php echo esc_attr( $icon ); ?>"></i>
                                                            <?php } else { ?>
                                                                <i class="sk <?php echo esc_attr( $icon ); ?>"></i>
                                                            <?php } ?>
                                                        </a>
                                                    <?php
                                                        } else {
                                                            if ( $icon_font === 'ifamily_fa' ) { ?>
                                                                <i class="fa <?php echo esc_attr( $icon ); ?>"></i>
                                                            <?php } else { ?>
                                                                <i class="sk <?php echo esc_attr( $icon ); ?>"></i>
                                                            <?php } ?>
                                                        <?php
                                                        }
                                                    }
                                                    $it++;
                                                } //End foreach
                                            } //End if
                                            
                                        if ( ! empty( $skdom_cta_title ) || ! empty( $skdom_cta_phone ) ) { ?>
                                            <h2>
                                                <?php if ( ! empty( $skdom_cta_title ) ) { ?>
                                                    <span><?php echo wp_kses_post( $skdom_cta_title ); ?></span>
                                                <?php
                                                } 
                                                if ( ! empty( $skdom_cta_phone ) ) { ?>
                                                    <span><?php echo wp_kses_post( $skdom_cta_phone ); ?></span>
                                                <?php
                                                } ?>
                                            </h2>
                                        <?php
                                        }
                                        if ( ! empty( $skdom_cta_subtitle ) ) { ?>
                                            <p><?php echo wp_kses_post( $skdom_cta_subtitle ); ?></p>
                                        <?php } ?>
                                </div><!-- block-border -->
                        </div><!-- row -->
                </div><!-- container-fluid -->
        </section><!-- #cta -->
<?php
}  // End if().