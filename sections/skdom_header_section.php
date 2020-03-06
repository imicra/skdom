<?php
/**
 * Header section
 *
 * @package sk-dom
 */
?>
<div id="home" class="header-slide">
        <?php if ( get_header_image() ) : ?>
            <div class="header-image" style="background-image: url(<?php header_image(); ?>);"></div>
        <?php endif; // End header image check. ?>
        <?php
            $skdom_site_name = get_theme_mod( 'skdom_site_name', esc_html__( 'Строим дома', 'skdom' ) );
            $skdom_site_description = get_theme_mod( 'skdom_site_description', esc_html__( 'Строительство деревянных частных домов  в Сыктывкаре под ключ', 'skdom' ) );
            $skdom_button_1_name = get_theme_mod( 'skdom_button_1_name', esc_html__( 'заказать', 'skdom' ) );
            $skdom_button_2_name = get_theme_mod( 'skdom_button_2_name', esc_html__( 'наши работы', 'skdom' ) );
            $skdom_button_1_link = get_theme_mod( 'skdom_button_1_link', '0' );
            $skdom_button_1_section = get_theme_mod( 'skdom_button_1_section', '#' );
            $skdom_button_2_link = get_theme_mod( 'skdom_button_2_link', '0' );
            $skdom_button_2_section = get_theme_mod( 'skdom_button_2_section', '#' );
            
            //WOW effect
            $skdom_slider_wow = get_theme_mod( 'skdom_slider_wow', true );
            
            if ( isset( $skdom_slider_wow ) && ( $skdom_slider_wow == 1 ) ) {
                $wow = ' wow';
            } else {
                $wow = '';
            }
            
            if ( ! empty( $skdom_site_name ) || ! empty( $skdom_site_description ) || ! empty( $skdom_button_1_name ) || ! empty( $skdom_button_2_name ) ) {
        ?>
        <div class="container-fluid">
                <div class="row">
                        <div class="block-header col-sm-6 col-sm-offset-1">
                                <div class="table">
                                        <article class="td">
                                            <?php
                                                if ( ! empty( $skdom_button_1_link ) || ( $skdom_button_1_link == 1 ) ) {
                                                    $skdom_url = get_permalink( $skdom_button_1_link );
                                                    $onclick = '';
                                                } else {
                                                    $skdom_url = '#';
                                                    $onclick = ' onclick="return false;"';
                                                    if ( ! empty( $skdom_button_1_section ) && strpos( $skdom_button_1_section, '#' ) === 0 ) {
                                                        $skdom_url = esc_attr( $skdom_button_1_section );
                                                        $anchor = ' data-anchor="' . esc_attr( $skdom_button_1_section ) . '"';
                                                        if ( substr( $skdom_button_1_section, 1 ) != '' ) {
                                                            $onclick = '';
                                                        }
                                                    }
                                                }
                                            ?>
                                            <?php if ( ! empty( $skdom_button_1_name ) ) { ?>
                                                <a class="button size-1 style-1<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?> bounceInLeft" href="<?php echo $skdom_url; ?>"<?php if ( ! empty( $onclick ) ) {  echo $onclick; } ?><?php if ( ! empty( $anchor ) ) {  echo $anchor; } ?> data-wow-delay="1s">
                                                    <?php echo wp_kses_post( $skdom_button_1_name ); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if ( ! empty( $skdom_site_name ) ) { ?>
                                                <h1 class="fadeInLeftBig<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?>" data-wow-delay=".5s"><?php echo wp_kses_post( $skdom_site_name ); ?></h1>
                                            <?php } ?>
                                            <?php if ( ! empty( $skdom_site_description ) ) { ?>
                                                <p class="fadeInLeftBig<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?>" data-wow-delay=".5s"><?php echo wp_kses_post( $skdom_site_description ); ?></p>
                                            <?php } ?>
                                            <?php
                                                if ( ! empty( $skdom_button_2_link ) || ( $skdom_button_2_link == 1 ) ) {
                                                    $skdom_url = get_permalink( $skdom_button_2_link );
                                                    $onclick = '';
                                                } else {
                                                    $skdom_url = '#';
                                                    $onclick = ' onclick="return false;"';
                                                    if ( ! empty( $skdom_button_2_section ) && strpos( $skdom_button_2_section, '#' ) === 0 ) {
                                                        $skdom_url = esc_attr( $skdom_button_2_section );
                                                        $anchor = ' data-anchor="' . esc_attr( $skdom_button_2_section ) . '"';
                                                        if ( substr( $skdom_button_2_section, 1 ) != '' ) {
                                                            $onclick = '';
                                                        }
                                                    }
                                                }
                                            ?>
                                            <?php if ( ! empty( $skdom_button_2_name ) ) { ?>
                                                <a class="button size-1 style-2 full-sm<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?> bounceInRight" href="<?php echo $skdom_url; ?>"<?php if ( ! empty( $onclick ) ) {  echo $onclick; } ?><?php if ( ! empty( $anchor ) ) {  echo $anchor; } ?> data-wow-delay="1s">
                                                    <?php echo wp_kses_post( $skdom_button_2_name ); ?>
                                                </a>
                                            <?php } ?>
                                        </article>
                                </div>
                        </div><!-- block-header -->
                </div><!-- row -->
        </div><!-- container-fluid -->
        <?php
            } //Endif
        ?>
        
</div><!-- header-slide -->