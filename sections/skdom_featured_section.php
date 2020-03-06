<?php
/**
 * Houses section
 *
 * @package sk-dom
 */

$skdom_featured_title        = get_theme_mod( 'skdom_featured_title', esc_html__( 'Строим самые оптимальные типы домов', 'skdom' ) );
$skdom_featured_subtitle     = get_theme_mod( 'skdom_featured_subtitle', esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ) );

$skdom_featured_one_image    = get_theme_mod( 'skdom_featured_one_image', get_template_directory_uri() . '/img/house-left.png' );
$skdom_featured_one_title    = get_theme_mod( 'skdom_featured_one_title', esc_html__( 'Каркасно-панельные дома', 'skdom' ) );
$skdom_featured_one_subtitle = get_theme_mod( 'skdom_featured_one_subtitle', esc_html__( 'Дома из клееного бруса - это последнее достижение деревянного зодчества, которое соединяет в себе “природность” дерева и новейшие технологии строительства.', 'skdom' ) );
$skdom_featured_one_button   = get_theme_mod( 'skdom_featured_one_button', esc_html__( 'Подробнее', 'skdom' ) );
$skdom_featured_one_link     = get_theme_mod( 'skdom_featured_one_link', '0' );
$default_one                 = skdom_featured_one_get_default_content();
$skdom_featured_one_content  = get_theme_mod( 'skdom_featured_one_content', $default_one );

$skdom_featured_two_image    = get_theme_mod( 'skdom_featured_two_image', get_template_directory_uri() . '/img/house-right.png' );
$skdom_featured_two_title    = get_theme_mod( 'skdom_featured_two_title', esc_html__( 'Дома из клееного бруса', 'skdom' ) );
$skdom_featured_two_subtitle = get_theme_mod( 'skdom_featured_two_subtitle', esc_html__( 'Дома из клееного бруса - это последнее достижение деревянного зодчества, которое соединяет в себе “природность” дерева и новейшие технологии строительства.', 'skdom' ) );
$skdom_featured_two_button   = get_theme_mod( 'skdom_featured_two_button', esc_html__( 'Подробнее', 'skdom' ) );
$skdom_featured_two_link     = get_theme_mod( 'skdom_featured_two_link', '0' );
$default_two                 = skdom_featured_two_get_default_content();
$skdom_featured_two_content  = get_theme_mod( 'skdom_featured_two_content', $default_two );

//Section id
$skdom_featured_hash = get_theme_mod( 'skdom_featured_hash', esc_html__( 'featured', 'skdom' ) );
if ( ! empty( $skdom_featured_hash ) ) {
    $id = 'id=' . $skdom_featured_hash;
} else {
    $id = '';
}

//Section background color option
$skdom_section_bg = get_theme_mod( 'skdom_featured_section_bg_color', false );

if ( isset( $skdom_section_bg ) && ( $skdom_section_bg == 1 ) ) {
    $bg = ' section-bg';
} else {
    $bg = '';
}

//WOW effect
$skdom_featured_wow = get_theme_mod( 'skdom_featured_wow', true );

if ( isset( $skdom_featured_wow ) && ( $skdom_featured_wow == 1 ) ) {
    $wow = ' wow';
} else {
    $wow = '';
}

if ( ! empty( $skdom_featured_one_title ) || ! empty( $skdom_featured_one_subtitle ) || ! empty( $skdom_featured_one_image ) || ! skdom_general_repeater_is_empty( $skdom_featured_one_content ) || ! empty( $skdom_featured_two_title ) || ! empty( $skdom_featured_two_subtitle ) || ! empty( $skdom_featured_two_image ) || ! skdom_general_repeater_is_empty( $skdom_featured_two_content ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="section<?php if ( ! empty( $bg ) ) echo esc_attr( $bg ); ?>">
                <div class="container-fluid">
                        <div class="row wrapper">
                            <?php 
                            if ( ! empty( $skdom_featured_title ) || ! empty( $skdom_featured_subtitle )  ) { ?>
                                <div class="section-heading">
                                    <?php
					if ( ! empty( $skdom_featured_title ) ) { ?>
                                            <h2><?php echo wp_kses_post( $skdom_featured_title ); ?></h2>
                                            <div class="line-short"></div>
                                    <?php
                                        }
					if ( ! empty( $skdom_featured_subtitle ) ) { ?>
                                            <p class="col-sm-8 col-sm-offset-2"><?php echo wp_kses_post( $skdom_featured_subtitle ); ?></p>
                                    <?php
                                        } ?>
                                </div><!--section-heading-->
                            <?php }
                            if ( ! empty( $skdom_featured_one_title ) || ! empty( $skdom_featured_one_subtitle ) || ! empty( $skdom_featured_one_image ) || ! skdom_general_repeater_is_empty( $skdom_featured_one_content ) ) { ?>
                                <div class="container-fluid bigimg-left">
                                        <div class="row">
                                            <?php
                                                if ( ! empty( $skdom_featured_one_image ) ) { ?>
                                                    <div class="col-sm-6 section-image">
                                                            <figure class="bounceInLeft<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?>">
                                                                    <img src="<?php echo esc_url( $skdom_featured_one_image ); ?>" alt="">
                                                            </figure>
                                                    </div>
                                            <?php
                                                } ?>
                                                <div class="col-sm-6 section-icons">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <?php 
                                                                    if ( ! empty( $skdom_featured_one_title ) || ! empty( $skdom_featured_one_subtitle )  ) { ?>
                                                                        <div class="section-heading left">
                                                                            <?php
                                                                                if ( ! empty( $skdom_featured_one_title ) ) { ?>
                                                                                <h2><?php echo wp_kses_post( $skdom_featured_one_title ); ?></h2>
                                                                            <?php
                                                                                } 
                                                                                if ( ! empty( $skdom_featured_one_subtitle ) ) {?>
                                                                                <p><?php echo wp_kses_post( $skdom_featured_one_subtitle ); ?></p>
                                                                            <?php
                                                                                } ?>
                                                                        </div>
                                                                <?php
                                                                    }

                                                                    if ( ! empty( $skdom_featured_one_content ) ) {
                                                                        $skdom_featured_one_content_decoded = json_decode( $skdom_featured_one_content );
                                                                        
                                                                        /*Counter for columns in row*/
                                                                        $skdom_featured_col = get_theme_mod( 'skdom_featured_col', 2 );

                                                                        $numOfCols = $skdom_featured_col;
                                                                        $rowCount = 0;
                                                                        $bootstrapColWidth = 12 / $numOfCols; ?>
                                                                        
                                                                        <div class="row">
                                                                        <?php
                                                                            /*Counter for data-wow-delay on each even item*/
                                                                            $it = 1;
                                                                            foreach ( $skdom_featured_one_content_decoded as $skdom_featured_one_content_block ) {
                                                                                $icon_font_one        = ! empty( $skdom_featured_one_content_block->icon_font ) ? $skdom_featured_one_content_block->icon_font : '';
                                                                                $icon_one             = ! empty( $skdom_featured_one_content_block->icon_value ) ? apply_filters( 'skdom_translate_single_string', $skdom_featured_one_content_block->icon_value, 'Featured Section One' ) : '';
                                                                                $title_one            = ! empty( $skdom_featured_one_content_block->title ) ? apply_filters( 'skdom_translate_single_string', $skdom_featured_one_content_block->title, 'Featured Section One' ) : '';
                                                                                $text_one             = ! empty( $skdom_featured_one_content_block->text ) ? apply_filters( 'skdom_translate_single_string', $skdom_featured_one_content_block->text, 'Featured Section One' ) : '';
                                                                                $page_url_one         = ! empty( $skdom_featured_one_content_block->page_url ) ? apply_filters( 'skdom_translate_single_string', $skdom_featured_one_content_block->page_url, 'Featured Section One' ) : '';
                                                                                $section_is_empty_one = empty( $icon_one ) && empty( $title_one ) && empty( $text_one );

                                                                                if ( ! $section_is_empty_one ) {

                                                                                    $wow_delay = ( $it % 2 == 0 ) ? ' data-wow-delay=.2s' : '';
                                                                    ?>
                                                                                    <div class="col-sm-<?php echo $bootstrapColWidth; ?> block-icon icon-inner<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?> bounceInRight"<?php if ( ! empty( $wow_delay ) ) echo esc_attr($wow_delay); ?>>
                                                                                        <?php 
                                                                                            if( ! empty( $icon_font_one ) ) { 
                                                                                                if ( ! empty( $icon_one ) && $icon_font_one === 'ifamily_sk' ) { ?>
                                                                                                    <div class="i-hexagon"><i class="sk <?php echo esc_attr( $icon_one ); ?>"></i></div>
                                                                                                <?php
                                                                                                }
                                                                                                if ( ! empty( $icon_one ) && $icon_font_one === 'ifamily_fa' ) { ?>
                                                                                                    <div class="i-hexagon"><i class="fa <?php echo esc_attr( $icon_one ); ?>"></i></div>
                                                                                        <?php
                                                                                                }
                                                                                            }
                                                                                            if( ! empty( $title_one ) ) {
                                                                                                if( ! empty( $page_url_one ) ) {
                                                                                        ?>
                                                                                                    <a href="<?php echo get_permalink( $page_url_one ); ?>">
                                                                                                            <h3><?php echo wp_kses_post( $title_one ); ?></h3>
                                                                                                    </a>
                                                                                        <?php
                                                                                                } else { ?>
                                                                                                    <h3><?php echo wp_kses_post( $title_one ); ?></h3>
                                                                                                <?php 
                                                                                                }
                                                                                            }
                                                                                            if( ! empty( $text_one ) ) {
                                                                                        ?>
                                                                                            <p><?php echo html_entity_decode( $text_one ); ?></p>
                                                                                        <?php
                                                                                            }
                                                                                        ?>
                                                                                    </div>
                                                                    <?php
                                                                                } //End if
                                                                                $it++;
                                                                                $rowCount++;
                                                                                if( $rowCount % $numOfCols == 0 ) { 
                                                                                    echo '</div><div class="row">';
                                                                                }
                                                                            } //End foreach ?>
                                                                        </div><!-- row -->
                                                                <?php } //End if ?>
                                                            </div><!-- row -->
                                                        </div><!-- container-fluid -->
                                                        <?php if ( ! empty( $skdom_featured_one_button ) ) {
                                                            
                                                            if ( ! empty( $skdom_featured_one_link ) || ( $skdom_featured_one_link == 1 ) ) {
                                                                $featured_one_url = get_permalink( $skdom_featured_one_link );
                                                                $onclick = '';
                                                            } else {
                                                                $featured_one_url = '#';
                                                                $onclick = ' onclick="return false;"';
                                                            }
                                                        ?>
                                                            <a class="button size-1 style-1 full-sm<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?> bounceInRight" href="<?php echo $featured_one_url; ?>"<?php if ( ! empty( $onclick ) ) {  echo $onclick; } ?> data-wow-delay=".5s">
                                                                <?php echo wp_kses_post( $skdom_featured_one_button ); ?>
                                                            </a>
                                                        <?php } ?>
                                                </div><!-- section-icons -->
                                        </div><!-- row -->
                                </div><!-- bigimg-left -->
                            <?php
                            } 
                            if ( ! empty( $skdom_featured_two_title ) || ! empty( $skdom_featured_two_subtitle ) || ! empty( $skdom_featured_two_image ) || ! skdom_general_repeater_is_empty( $skdom_featured_two_content ) ) { ?>
                                <div class="container-fluid bigimg-right">
                                        <div class="row">
                                            <?php
                                                if ( ! empty( $skdom_featured_two_image ) ) { ?>
                                                <div class="col-sm-6 col-sm-push-6 section-image">
                                                        <figure class="bounceInRight<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?>">
                                                                <img src="<?php echo esc_url( $skdom_featured_two_image ); ?>" alt="">
                                                        </figure>
                                                </div>
                                            <?php
                                                } ?>
                                            <?php $icons = ( ! empty( $skdom_featured_two_image ) ) ? ' col-sm-pull-6': ''; ?>
                                            <?php if ( empty( $skdom_featured_two_image ) && empty( $skdom_featured_one_image ) ) { ?>
                                                <style type="text/css">
                                                    .bigimg-right .section-icons {
                                                        position: absolute;
                                                        bottom: 0;
                                                        right: 0;
                                                    }
                                                    @media screen and (max-width: 768px) {
                                                        .bigimg-right .section-icons {
                                                            position: relatve;
                                                        }
                                                    }
                                                </style>
                                            <?php } ?>
                                                <div class="col-sm-6<?php if ( ! empty( $icons ) ) echo esc_attr( $icons ); ?> section-icons">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <?php 
                                                                if ( ! empty( $skdom_featured_two_title ) || ! empty( $skdom_featured_two_subtitle )  ) { ?>
                                                                    <div class="section-heading left">
                                                                        <?php
                                                                            if ( ! empty( $skdom_featured_two_title ) ) { ?>
                                                                            <h2><?php echo wp_kses_post( $skdom_featured_two_title ); ?></h2>
                                                                        <?php
                                                                            } 
                                                                            if ( ! empty( $skdom_featured_two_subtitle ) ) {?>
                                                                            <p><?php echo wp_kses_post( $skdom_featured_two_subtitle ); ?></p>
                                                                        <?php
                                                                            } ?>
                                                                    </div>
                                                            <?php
                                                                }

                                                                if ( ! empty( $skdom_featured_two_content ) ) {
                                                                        $skdom_featured_two_content_decoded = json_decode( $skdom_featured_two_content ); ?>
                                                                        <div class="row">
                                                                        <?php
                                                                            /*Counter for data-wow-delay on each odd item*/
                                                                            $it = 1;
                                                                            foreach ( $skdom_featured_two_content_decoded as $skdom_featured_two_content_block ) {
                                                                                $icon_font_two        = ! empty( $skdom_featured_two_content_block->icon_font ) ? $skdom_featured_two_content_block->icon_font : '';
                                                                                $icon_two             = ! empty( $skdom_featured_two_content_block->icon_value ) ? apply_filters( 'skdom_translate_single_string', $skdom_featured_two_content_block->icon_value, 'Featured Section Two' ) : '';
                                                                                $title_two            = ! empty( $skdom_featured_two_content_block->title ) ? apply_filters( 'skdom_translate_single_string', $skdom_featured_two_content_block->title, 'Featured Section Two' ) : '';
                                                                                $text_two             = ! empty( $skdom_featured_two_content_block->text ) ? apply_filters( 'skdom_translate_single_string', $skdom_featured_two_content_block->text, 'Featured Section Two' ) : '';
                                                                                $page_url_two         = ! empty( $skdom_featured_two_content_block->page_url ) ? apply_filters( 'skdom_translate_single_string', $skdom_featured_two_content_block->page_url, 'Featured Section Two' ) : '';
                                                                                $section_is_empty_two = empty( $icon_two ) && empty( $title_two ) && empty( $text_two );

                                                                                if ( ! $section_is_empty_two ) {

                                                                                    $wow_delay = ( $it % 2 != 0 ) ? ' data-wow-delay=.2s' : '';
                                                                ?>
                                                                                    <div class="col-sm-<?php echo $bootstrapColWidth; ?> block-icon icon-inner<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?> bounceInLeft"<?php if ( ! empty( $wow_delay ) ) echo esc_attr($wow_delay); ?>>
                                                                                        <?php 
                                                                                            if( ! empty( $icon_font_two ) ) { 
                                                                                                if ( ! empty( $icon_two ) && $icon_font_two === 'ifamily_sk' ) { ?>
                                                                                                    <div class="i-hexagon"><i class="sk <?php echo esc_attr( $icon_two ); ?>"></i></div>
                                                                                                <?php
                                                                                                }
                                                                                                if ( ! empty( $icon_two ) && $icon_font_two === 'ifamily_fa' ) { ?>
                                                                                                    <div class="i-hexagon"><i class="fa <?php echo esc_attr( $icon_two ); ?>"></i></div>
                                                                                        <?php
                                                                                                }
                                                                                            }
                                                                                            if( ! empty( $title_two ) ) {
                                                                                                if( ! empty( $page_url_two ) ) {
                                                                                        ?>
                                                                                                    <a href="<?php echo get_permalink( $page_url_two ); ?>">
                                                                                                            <h3><?php echo wp_kses_post( $title_two ); ?></h3>
                                                                                                    </a>
                                                                                        <?php
                                                                                                } else { ?>
                                                                                                    <h3><?php echo wp_kses_post( $title_two ); ?></h3>
                                                                                                <?php 
                                                                                                }
                                                                                            }
                                                                                            if( ! empty( $text_two ) ) {
                                                                                        ?>
                                                                                            <p><?php echo html_entity_decode( $text_two ); ?></p>
                                                                                        <?php
                                                                                            }
                                                                                        ?>
                                                                                    </div>
                                                                    <?php
                                                                                } //End if
                                                                                $it++;
                                                                                $rowCount++;
                                                                                if( $rowCount % $numOfCols == 0 ) { 
                                                                                    echo '</div><div class="row">';
                                                                                }
                                                                            } //End foreach ?>
                                                                        </div><!-- row -->
                                                                <?php } //End if 
                                                                ?>
                                                            </div><!-- row -->
                                                        </div><!-- container-fluid -->
                                                        <?php if ( ! empty( $skdom_featured_two_button ) ) {
                                                            
                                                            if ( ! empty( $skdom_featured_two_link ) || ( $skdom_featured_two_link == 1 ) ) {
                                                                $featured_two_url = get_permalink( $skdom_featured_two_link );
                                                                $onclick = '';
                                                            } else {
                                                                $featured_two_url = '#';
                                                                $onclick = ' onclick="return false;"';
                                                            }
                                                        ?>
                                                            <a class="button size-1 style-1 full-sm right<?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?> bounceInLeft" href="<?php echo $featured_two_url; ?>"<?php if ( ! empty( $onclick ) ) {  echo $onclick; } ?> data-wow-delay=".5s">
                                                                <?php echo wp_kses_post( $skdom_featured_two_button ); ?>
                                                            </a>
                                                        <?php } ?>
                                                </div><!-- section-icons -->
                                        </div><!-- row -->
                                </div><!-- bigimg-right -->
                            <?php
                            } ?>
                        </div><!-- row -->
                </div><!-- container-fluid -->
        </section><!-- #houses -->
<?php
}  // End if().