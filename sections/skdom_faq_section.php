<?php
/**
 * FAQ section
 *
 * @package sk-dom
 */

$skdom_faq_title    = get_theme_mod( 'skdom_faq_title', esc_html__( 'Нас часто спрашивают', 'skdom' ) );
$skdom_form_title   = get_theme_mod( 'skdom_form_title', esc_html__( 'Спросите нас', 'skdom' ) );

//Section id
$skdom_faq_hash = get_theme_mod( 'skdom_faq_hash', esc_html__( 'faq', 'skdom' ) );
if ( ! empty( $skdom_faq_hash ) ) {
    $id = 'id=' . $skdom_faq_hash;
} else {
    $id = '';
}

//Section background color option
$skdom_section_bg = get_theme_mod( 'skdom_faq_section_bg_color', false );

if ( isset( $skdom_section_bg ) && ( $skdom_section_bg == 1 ) ) {
    $bg = ' section-bg';
} else {
    $bg = '';
}

if ( ! empty( $skdom_faq_title ) || ! empty( $skdom_form_title ) ) {
?>
        <section <?php if ( ! empty( $id ) ) echo esc_attr( $id ); ?> class="section<?php if ( ! empty( $bg ) ) echo esc_attr( $bg ); ?>">
                <div class="container-fluid">
                        <div class="row wrapper">
                            <?php
                                if ( ! empty( $skdom_faq_title ) ) {
                                    if( ! empty( $skdom_form_title ) ) {
                                        $block = 'col-sm-6';
                                    } else {
                                        $block = 'col-sm-10 col-sm-offset-1';
                                    }
                                    
                                    $skdom_faq_mode = get_theme_mod( 'skdom_faq_mode', 'toggle' );
    
                                    if( 'toggle' != $skdom_faq_mode ) {
                                        $faq_mod = 'each';
                                        $active = '';
                                    } else {
                                        $faq_mod = 'toggle';
                                        $active = ' active';
                                    }
                            ?>
                                    <div id="faq" class="section-group <?php echo esc_attr( $block ); ?>">
                                            <h3><?php echo wp_kses_post( $skdom_faq_title ); ?></h3>
                                            <?php
                                                /* 
                                                 * Display FAQ post type
                                                 */
                                                $skdom_faq_number = get_theme_mod( 'skdom_faq_number', 3 );

                                                $args = array( 
                                                    'post_type' => 'faq', 
                                                    'posts_per_page' => $skdom_faq_number,
                                                    'orderby' => array( 'menu_order' => 'ASC' ),
                                                );

                                                $faq = new WP_Query( $args );
                                                
                                                if ( $faq->have_posts() ) {
                                                    
                                                    //Counter for class 'active' on second item
                                                    $it = 1;
                                                    
                                                    while ( $faq->have_posts() ) : $faq->the_post();
                                                    
                                                    $skdom_faq_active = get_theme_mod( 'skdom_faq_active', 2 );
                                            ?>
                                                        <div class="accordion-section">
                                                            <h2 class="accordion-header <?php echo esc_attr( $faq_mod ); ?>">
                                                                <span class="accordion-ui<?php if ( ! empty( $active ) && $it == $skdom_faq_active ) {echo esc_attr( $active );} ?>"></span>
                                                                <a href="#">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h2>
                                                            <div class="accordion-content">
                                                                <?php the_content(); ?>
                                                            </div>
                                                        </div><!-- accordion-section -->
                                            <?php
                                                        $it++;
                                                    endwhile;
                                                    
                                                } else {
                                                    get_template_part( 'inc/demo-content/skdom_faq_section', 'demo' );
                                                }// End if(). 

                                                wp_reset_postdata();
                                            ?>
                                    </div><!-- section-group -->
                            <?php
                                } // End if(). 
                                if ( ! empty( $skdom_form_title ) ) {
                                    if( ! empty( $skdom_faq_title ) ) {
                                        $block = 'col-sm-6';
                                    } else {
                                        $block = 'col-sm-10 col-sm-offset-1';
                                    }
                            ?>
                                    <div id="cform" class="section-group <?php echo esc_attr( $block ); ?>">
                                            <h3><?php echo wp_kses_post( $skdom_form_title ); ?></h3>
                                            <?php
                                                if( ! empty( $skdom_faq_title ) ) {
                                                    $input = '';
                                                } else {
                                                    $input = ' col-sm-6';
                                                }
                                            ?>
                                            <form id="contact-form" class="contact-form">
                                                    <input type="hidden" name="action" value="contact_send">
                                                    <div class="col-xs-12<?php if ( ! empty( $input ) ) echo esc_attr($input); ?>">
                                                            <div class="input-cont">
                                                                    <label>Ваше имя</label>
                                                                    <input type="text" name="fname" required="">
                                                                    <i class="icon_profile"></i>
                                                            </div>
                                                    </div>
                                                    <div class="col-xs-12<?php if ( ! empty( $input ) ) echo esc_attr($input); ?>">
                                                            <div class="input-cont">
                                                                    <label>Ваш телефон</label>
                                                                    <input type="tel" name="phone" required="">
                                                                    <i class="icon_phone"></i>
                                                            </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                            <div class="input-cont">
                                                                    <label>Сообщение</label>
                                                                    <textarea name="message" cols="40" rows="4"></textarea>
                                                            </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                            <input type="submit" name="submit" placeholder="Отправить" class="transparent">
                                                    </div>
                                            </form>
                                    </div><!-- section-group -->
                            <?php
                                } // End if(). ?>
                        </div><!-- row -->
                </div><!-- container-fluid -->
        </section><!-- section -->
<?php
}  // End if().