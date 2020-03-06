<?php
/**
 * Front Page Template
 *
 * @package sk-dom
 */

if ( 'posts' == get_option( 'show_on_front' ) ) {
    
        get_header();

        get_template_part( 'sections/skdom_header_section' );
        ?>
        <main>
        <?php
        
                $sections_array = apply_filters( 'skdom_sections_filter', array(
                    'sections/skdom_about_section',
                    'sections/skdom_promo_section',
                    'sections/skdom_gallery_section',
                    'sections/skdom_featured_section',
                    'sections/skdom_cta_section',
                    'sections/skdom_workflow_section',
                    'sections/skdom_testimonials_section',
                    'sections/skdom_addservice_section',
                    'sections/skdom_faq_section',
                    'sections/skdom_contacts_section',
                ) );
                
                if ( ! empty( $sections_array ) ) {
                        foreach ( $sections_array as $section ) {
                                get_template_part( $section );
                        }
                }
        
        ?>
        </main>
        <?php
        
        get_footer();
} else {

	include( get_page_template() );
}