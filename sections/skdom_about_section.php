<?php
/**
 * About section
 *
 * @package sk-dom
 */

$skdom_about_title    = get_theme_mod( 'skdom_about_title', esc_html__( 'Немного о компании ск дом', 'skdom' ) );
$skdom_about_subtitle = get_theme_mod( 'skdom_about_subtitle', esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ) );
$default              = skdom_about_get_default_content();
$skdom_about_content  = get_theme_mod( 'skdom_about_content', $default );

//Section id
$skdom_about_hash = get_theme_mod( 'skdom_about_hash', esc_html__( 'about', 'skdom' ) );
if ( ! empty( $skdom_about_hash ) ) {
    $id = 'id=' . $skdom_about_hash;
} else {
    $id = '';
}

//Section background color option
$skdom_section_bg = get_theme_mod( 'skdom_about_section_bg_color', false );

if ( isset( $skdom_section_bg ) && ( $skdom_section_bg == 1 ) ) {
    $bg = ' section-bg';
} else {
    $bg = '';
}

//WOW effect
$skdom_about_wow = get_theme_mod( 'skdom_about_wow', false );

if ( isset( $skdom_about_wow ) && ( $skdom_about_wow == 1 ) ) {
    $wow = ' wow';
} else {
    $wow = '';
}

if ( ! empty( $skdom_about_title ) || ! empty( $skdom_about_subtitle ) || ! skdom_general_repeater_is_empty( $skdom_about_content ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="section<?php if ( ! empty( $bg ) ) echo esc_attr( $bg ); ?>">
                <div class="container-fluid">
                        <div class="row wrapper">
                            <?php 
                            if ( ! empty( $skdom_about_title ) || ! empty( $skdom_about_subtitle )  ) { ?>
                                <div class="section-heading">
                                    <?php
					if ( ! empty( $skdom_about_title ) ) { ?>
                                            <h2><?php echo wp_kses_post( $skdom_about_title ); ?></h2>
                                            <div class="line-short"></div>
                                    <?php
                                        } ?>
                                    <?php
					if ( ! empty( $skdom_about_subtitle ) ) { ?>
                                            <p class="col-sm-8 col-sm-offset-2"><?php echo wp_kses_post( $skdom_about_subtitle ); ?></p>
                                    <?php
                                        } ?>
                                </div><!--section-heading-->
                            <?php }
                                    if ( ! empty( $skdom_about_content ) ) {
                                        $skdom_about_content_decoded = json_decode( $skdom_about_content );
                                        
                                        /*Counter for columns in row*/
                                        $skdom_about_col = get_theme_mod( 'skdom_about_col', 3 );
                                        
                                        $numOfCols = $skdom_about_col;
                                        $rowCount = 0;
                                        $bootstrapColWidth = 12 / $numOfCols;
                                ?>
                                <div class="row">
                                    <?php
                                        /*Counter for checking to generate row tags after 3 columns*/
//                                        $it = 1;
                                        foreach ( $skdom_about_content_decoded as $skdom_about_content_block ) {
                                            $icon_font        = ! empty( $skdom_about_content_block->icon_font ) ? $skdom_about_content_block->icon_font : '';
                                            $icon             = ! empty( $skdom_about_content_block->icon_value ) ? apply_filters( 'skdom_translate_single_string', $skdom_about_content_block->icon_value, 'About Section' ) : '';
                                            $title            = ! empty( $skdom_about_content_block->title ) ? apply_filters( 'skdom_translate_single_string', $skdom_about_content_block->title, 'About Section' ) : '';
                                            $text             = ! empty( $skdom_about_content_block->text ) ? apply_filters( 'skdom_translate_single_string', $skdom_about_content_block->text, 'About Section' ) : '';
                                            $page_url         = ! empty( $skdom_about_content_block->page_url ) ? apply_filters( 'skdom_translate_single_string', $skdom_about_content_block->page_url, 'About Section' ) : '';
                                            $section_is_empty = empty( $icon ) && empty( $title ) && empty( $text );
                                            
                                            if ( ! $section_is_empty ) { ?>
                                                <div class="col-sm-<?php echo $bootstrapColWidth; ?> block-icon icon-outer<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?> fadeInUp">
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
                                                    if( $rowCount % $numOfCols == 0 ) { 
                                                        echo '</div><div class="row">';
                                                    }
//                                                if ( $it % 3 == 0 ) {
//                                                    echo '</div><div class="row">';
//                                                }
                                            } //End if
//                                            $it++;
                                        } //End foreach
                                    ?>
                                </div><!-- row -->
                                <?php
                                    } //End if
                                ?>
                        </div><!-- row wrapper -->
                </div><!-- container-fluid -->
        </section><!-- #about -->
<?php
}  // End if().