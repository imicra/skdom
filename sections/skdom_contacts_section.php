<?php
/**
 * Contacts section
 *
 * @package sk-dom
 */

$skdom_contacts_bgimage  = get_theme_mod( 'skdom_contacts_bgimage', get_template_directory_uri() . '/img/contacts-bg.jpg' );
$skdom_contacts_title    = get_theme_mod( 'skdom_contacts_title', esc_html__( 'Надеемся на успешное сотрудничество', 'skdom' ) );
$default                 = skdom_contacts_get_default_content();
$skdom_contacts_content     = get_theme_mod( 'skdom_contacts_content', $default );

//Section id
$skdom_contacts_hash = get_theme_mod( 'skdom_contacts_hash', esc_html__( 'contacts', 'skdom' ) );
if ( ! empty( $skdom_contacts_hash ) ) {
    $id = 'id=' . $skdom_contacts_hash;
} else {
    $id = '';
}

if ( ! empty( $skdom_contacts_title ) || ! skdom_general_repeater_is_empty( $skdom_contacts_content ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="section invert">
                <div class="container-fluid">
                    <?php
                    if ( ! empty( $skdom_contacts_bgimage ) ) { ?>
                        <div class="block-bg bg-image bg-center" style="background-image: url(<?php echo esc_url( $skdom_contacts_bgimage ); ?>);"></div>
                    <?php } ?>
                        <div class="block-bg overlay"></div>
                        <div class="section-add row wrapper">
                            <?php 
                                if ( ! empty( $skdom_contacts_title ) ) { ?>
                                    <div class="section-heading">
                                            <h3><?php echo wp_kses_post( $skdom_contacts_title ); ?></h3>
                                    </div><!-- section-heading -->
                            <?php }
                                if ( ! empty( $skdom_contacts_content ) ) {
                                        $skdom_contacts_content_decoded = json_decode( $skdom_contacts_content ); 
                                        
                                        /*Counter for columns in row*/
                                        $skdom_contacts_col = get_theme_mod( 'skdom_contacts_col', 3 );
                                        
                                        $numOfCols = $skdom_contacts_col;
                                        $rowCount = 0;
                                        $bootstrapColWidth = 12 / $numOfCols; ?>
                                    <div class="blocks-wrap">
                                        <?php
                                            foreach ( $skdom_contacts_content_decoded as $skdom_contacts_content_block ) {
                                                $icon_font        = ! empty( $skdom_contacts_content_block->icon_font ) ? $skdom_contacts_content_block->icon_font : '';
                                                $icon             = ! empty( $skdom_contacts_content_block->icon_value ) ? apply_filters( 'skdom_translate_single_string', $skdom_contacts_content_block->icon_value, 'Contacts Section' ) : '';
                                                $title            = ! empty( $skdom_contacts_content_block->title ) ? apply_filters( 'skdom_translate_single_string', $skdom_contacts_content_block->title, 'Contacts Section' ) : '';
                                                $text             = ! empty( $skdom_contacts_content_block->text ) ? apply_filters( 'skdom_translate_single_string', $skdom_contacts_content_block->text, 'Contacts Section' ) : '';
                                                $link             = ! empty( $skdom_contacts_content_block->link ) ? apply_filters( 'skdom_translate_single_string', $skdom_contacts_content_block->link, 'Contacts Section' ) : '';
                                                $section_is_empty = empty( $icon ) && empty( $title ) && empty( $text );
                                        
                                                if ( ! $section_is_empty ) { ?>
                                                    <div class="rect-block col-sm-<?php echo $bootstrapColWidth; ?>">
                                                        <?php if ( ! empty( $link ) ) { ?>
                                                        <a href="<?php echo esc_attr( $link ); ?>" target="_blank">
                                                        <?php } ?> 
                                                                <div class="block-icon__inner">
                                                                    <?php 
                                                                        if( ! empty( $icon ) ) { ?>
                                                                            <div class="icon-wrap">
                                                                                <?php if ( $icon_font === 'ifamily_fa' ) { ?>
                                                                                    <i class="fa <?php echo esc_attr( $icon ); ?>"></i>
                                                                                <?php } else { ?>
                                                                                    <i class="sk <?php echo esc_attr( $icon ); ?>"></i>
                                                                                <?php } ?>
                                                                            </div>
                                                                    <?php } 
                                                                        if( ! empty( $title ) ) { ?>
                                                                            <h4><?php echo wp_kses_post( $title ); ?></h4>
                                                                    <?php } 
                                                                        if( ! empty( $text ) ) { ?>
                                                                            <div class="block-icon__text">
                                                                                <p><?php echo html_entity_decode( $text ); ?></p>
                                                                            </div>
                                                                    <?php } ?>
                                                                </div>
                                                        <?php if ( ! empty( $link ) ) { ?>
                                                            </a>
                                                        <?php } ?> 
                                                    </div><!-- rect-block -->
                                        <?php } // End if()
                                            $rowCount++;
                                            } //End foreach ?>
                                    </div><!-- blocks-wrap -->
                                <?php } // End if(). ?>
                        </div><!-- row -->
                </div><!-- container-fluid -->
        </section><!-- section -->
<?php
}  // End if().