<?php
/**
 * Workflow section
 *
 * @package sk-dom
 */

$skdom_workflow_title    = get_theme_mod( 'skdom_workflow_title', esc_html__( 'Схема работы', 'skdom' ) );
$skdom_workflow_subtitle = get_theme_mod( 'skdom_workflow_subtitle', esc_html__( 'Мы строим одноэтажные и двухэтажные дома, бани, беседки и прочие деревянные конструкции в Сыктывкаре под ключ', 'skdom' ) );
$skdom_workflow_bgimage  = get_theme_mod( 'skdom_workflow_bgimage', get_template_directory_uri() . '/img/workflow-bg.jpg' );
$default                 = skdom_workflow_get_default_content();
$skdom_workflow_content  = get_theme_mod( 'skdom_workflow_content', $default );

//Section id
$skdom_workflow_hash = get_theme_mod( 'skdom_workflow_hash', esc_html__( 'workflow', 'skdom' ) );
if ( ! empty( $skdom_workflow_hash ) ) {
    $id = 'id=' . $skdom_workflow_hash;
} else {
    $id = '';
}

//Section background color option
$skdom_section_bg = get_theme_mod( 'skdom_workflow_section_bg_color', false );

if ( isset( $skdom_section_bg ) && ( $skdom_section_bg == 1 ) ) {
    $bg = ' section-bg';
} else {
    $bg = '';
}

//WOW effect
$skdom_workflow_wow = get_theme_mod( 'skdom_workflow_wow', true );

if ( isset( $skdom_workflow_wow ) && ( $skdom_workflow_wow == 1 ) ) {
    $wow = ' wow';
} else {
    $wow = '';
}

//Parallax effect
$skdom_workflow_parallax   = get_theme_mod( 'skdom_workflow_parallax', true );
$skdom_workflow_attachment = get_theme_mod( 'skdom_workflow_attachment', 'fixed' );

if ( isset( $skdom_workflow_parallax ) && ( $skdom_workflow_parallax == 1 ) ) {
    $parallax = ' data-stellar-background-ratio=0.5';
} else {
    $parallax = '';
}

if( $skdom_workflow_attachment === 'fixed' ) {
    $bg = ' parallax-bg';
} else {
    $bg = '';
}

if ( ! empty( $skdom_workflow_title ) || ! empty( $skdom_workflow_subtitle ) || ! skdom_general_repeater_is_empty( $skdom_workflow_content ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="workflow section<?php if ( ! empty( $bg ) ) echo esc_attr( $bg ); ?>">
                <div class="container-fluid">
                        <div class="row">
                                 <?php 
                                    if ( ! empty( $skdom_workflow_title ) || ! empty( $skdom_workflow_subtitle )  ) { ?>
                                        <div class="section-heading">
                                            <?php
                                                if ( ! empty( $skdom_workflow_title ) ) { ?>
                                                    <h2><?php echo wp_kses_post( $skdom_workflow_title ); ?></h2>
                                                    <div class="line-short"></div>
                                            <?php
                                                } ?>
                                            <?php
                                                if ( ! empty( $skdom_workflow_subtitle ) ) { ?>
                                                    <p class="col-sm-8 col-sm-offset-2"><?php echo wp_kses_post( $skdom_workflow_subtitle ); ?></p>
                                            <?php
                                                } ?>
                                        </div><!--section-heading-->
                                <?php }
                                
                                    if ( ! empty( $skdom_workflow_content ) ) {
                                        $skdom_workflow_content_decoded = json_decode( $skdom_workflow_content );
                                ?>    
                                        <div class="col-xs-12">
                                            <?php
                                                if ( ! empty( $skdom_workflow_bgimage ) ) { ?>
                                                    <div id="workflow-bg" class="block-bg bg-image bg-center<?php if ( ! empty( $bg ) ) echo esc_attr( $bg ); ?>"<?php if ( ! empty( $parallax ) ) echo esc_attr( $parallax ); ?> style="background-image: url(<?php echo esc_url( $skdom_workflow_bgimage ); ?>);"></div>
                                            <?php } ?>
                                                <div class="workflow-wrap container-fluid wrapper">
                                                    <?php
                                                        /*Counter for checking odd/even rows*/
                                                        $it = 1;
                                                        foreach ( $skdom_workflow_content_decoded as $skdom_workflow_content_block ) {
                                                            $icon_font        = ! empty( $skdom_workflow_content_block->icon_font ) ? $skdom_workflow_content_block->icon_font : '';
                                                            $icon             = ! empty( $skdom_workflow_content_block->icon_value ) ? apply_filters( 'skdom_translate_single_string', $skdom_workflow_content_block->icon_value, 'Workflow Section' ) : '';
                                                            $title            = ! empty( $skdom_workflow_content_block->title ) ? apply_filters( 'skdom_translate_single_string', $skdom_workflow_content_block->title, 'Workflow Section' ) : '';
                                                            $text             = ! empty( $skdom_workflow_content_block->text ) ? apply_filters( 'skdom_translate_single_string', $skdom_workflow_content_block->text, 'Workflow Section' ) : '';
                                                            $page_url         = ! empty( $skdom_workflow_content_block->page_url ) ? apply_filters( 'skdom_translate_single_string', $skdom_workflow_content_block->page_url, 'Workflow Section' ) : '';
                                                            $section_is_empty = empty( $icon ) && empty( $title ) && empty( $text );
                                                    
                                                            if ( ! $section_is_empty ) {
                                                                $even = ( $it % 2 == 0 ) ? 'even' : 'odd'; ?>
                                                                <div class="workflow-item <?php echo esc_attr( $even ); ?> row">
                                                                    <?php $side = ( $it % 2 == 0 ) ? 'col-sm-offset-5' : 'col-sm-push-5'; ?>
                                                                        <div class="workflow-pic col-sm-2 <?php echo esc_attr( $side ); ?>">
                                                                                <div class="hexagon-round">
                                                                                        <div class="hexagon-round-back">
                                                                                                <div class="hexagon-round-back-inner">
                                                                                                        <div class="hexagon-round-back-inner-before"></div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="hexagon-round-top">
                                                                                                <div class="hexagon-round-top-inner">
                                                                                                        <div class="hexagon-round-top-inner-before"></div>
                                                                                                </div>
                                                                                        </div>
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
                                                                                            } ?>
                                                                                </div>
                                                                        </div><!-- workflow-pic -->
                                                                        <?php 
                                                                            $pull   = ( $it % 2 != 0 ) ? ' col-sm-pull-2' : '';
                                                                            $bounce = ( $it % 2 == 0 ) ? 'bounceInRight' : 'bounceInLeft'; 
                                                                        ?>
                                                                        <div class="workflow-text col-sm-5 col-sm-offset-0<?php if ( ! empty( $pull ) ) echo esc_attr($pull); ?><?php if ( ! empty( $wow ) ) echo esc_attr($wow); ?> <?php echo esc_attr( $bounce ); ?>">
                                                                            <?php
                                                                                if( ! empty( $title ) ) {
                                                                                    if( ! empty( $page_url ) ) {
                                                                            ?>
                                                                                        <a href="<?php echo get_permalink( $page_url ); ?>">
                                                                                            <h4><?php echo wp_kses_post( $title ); ?></h4>
                                                                                        </a>
                                                                                        <div class="line"></div>
                                                                            <?php
                                                                                    } else { ?>
                                                                                        <h4><?php echo wp_kses_post( $title ); ?></h4>
                                                                                        <div class="line"></div>
                                                                                    <?php 
                                                                                    }
                                                                                }
                                                                                
                                                                                if( ! empty( $text ) ) { ?>
                                                                                    <p><?php echo html_entity_decode( $text ); ?></p>
                                                                                <?php } ?>
                                                                                <div class="triangle"></div>
                                                                        </div><!-- workflow-text -->
                                                                </div><!-- workflow-item odd -->
                                                            <?php
                                                            } 
                                                        $it++;
                                                        } //End foreach ?>
                                                            <div class="line-vertical"></div>
                                                </div><!-- workflow-wrap -->
                                        </div>
                                <?php
                                    } //End if
                                ?>
                        </div><!-- row -->
                </div><!-- container-fluid -->
        </section><!-- workflow -->
<?php
}  // End if().