<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skdom
 */

?>

	</main><!-- #content -->

	<footer id="colophon" class="site-footer">
            <div class="container-fluid site-footer_wrap">
                <?php
                $skdom_footer_bgimage  = get_theme_mod( 'skdom_footer_bgimage', get_template_directory_uri() . '/img/footer-bg.jpg' );
                if ( ! empty( $skdom_footer_bgimage ) ) { ?>
                    <div class="block-bg bg-image bg-center" style="background-image: url(<?php echo esc_url( $skdom_footer_bgimage ); ?>);"></div>
                <?php } ?>
                <div class="block-bg overlay"></div>
                <div class="row wrapper">
                    <div class="footer-widget-wrap clearfix">
                        <?php if( has_nav_menu('footer') ) { ?>
                        <nav class="footer-menu_center col-xs-6 col-sm-12">
                            <?php
                                wp_nav_menu( array(
                                        'container'      => false,
                                        'theme_location' => 'footer',
                                        'menu_class'     => 'footer-menu',
                                ) );
                            ?>
                        </nav>
                        <?php } ?>
                        
                        <?php
                        if ( is_active_sidebar( 'footer-area-3' ) ) {
                            $col = 'col-sm-6 col-md-4';
                        } else {
                            $col = 'col-sm-6';
                        }
                        
			if ( is_active_sidebar( 'footer-area' ) ) {  ?>
                            <div class="clearfix <?php if ( ! empty( $col ) ) echo esc_attr( $col ); ?> footer-widget footer-widget-1">
					<?php
					dynamic_sidebar( 'footer-area' ); ?>
                            </div>
			<?php
			}

			if ( is_active_sidebar( 'footer-area-2' ) ) {  ?>
                            <div class="clearfix <?php if ( ! empty( $col ) ) echo esc_attr( $col ); ?> footer-widget footer-widget-2">
					<?php
					dynamic_sidebar( 'footer-area-2' ); ?>
                            </div>
                            <div class="clearfix hidden-md hidden-lg"></div>
			<?php
			}

			if ( is_active_sidebar( 'footer-area-3' ) ) {  ?>
                            <div class="clearfix <?php if ( ! empty( $col ) ) echo esc_attr( $col ); ?> footer-widget footer-widget-3">
					<?php
					dynamic_sidebar( 'footer-area-3' ); ?>
                            </div>
			<?php
			} ?>
                    </div><!-- footer-widget-wrap -->
                    <?php
                    if ( has_nav_menu( 'social' ) ) { ?>
                    <nav class="social-menu">
                            <?php
                                    wp_nav_menu( array(
                                            'theme_location' => 'social',
                                            'container'      => false,
                                            'menu_class'     => 'social-links-menu',
                                            'depth'          => 1,
                                            'link_before'    => '<span class="screen-reader-text">',
                                            'link_after'     => '</span>' . skdom_get_svg( array( 'icon' => 'chain' ) ),
                                    ) );
                            ?>
                    </nav><!-- .social-menu -->
                    <?php } ?>
                    <div class="rights-info">
                        <?php
                        $skdom_footer_logo  = get_theme_mod( 'skdom_footer_logo', get_template_directory_uri() . '/img/logo-nav.png' );
                        $logo_id = attachment_url_to_postid( $skdom_footer_logo );
                        $image_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
                        if ( empty( $image_alt ) ) {
                            $image_alt = get_bloginfo( 'name', 'display' );
                        }
                        if ( ! empty( $skdom_footer_logo ) ) { ?>
                        <p>
                            <img src="<?php echo esc_url( $skdom_footer_logo ); ?>" class="footer-logo" alt="<?php echo esc_attr( $image_alt ); ?>">
                        </p>
                        <?php }
                        
                        $skdom_footer_copyrights = get_theme_mod( 'skdom_footer_copyrights', __( '<span>"СК ДОМ"</span>, г.Сыктывкар', 'skdom' ) );
                        ?>
                        <p class="rights-text"><?php echo wp_kses_post( $skdom_footer_copyrights ); ?> &copy; <?php echo date( 'Y' ); ?></p>
                    </div><!-- .site-info -->
                </div><!-- wrapper -->
            </div><!-- .container-fluid -->
            <div class="site-info">
                <a href="<?php echo esc_url( __( 'http://imicra.ru/wordpress-themes/', 'skdom' ) ); ?>" target="_blank"><?php
                            /* translators: %s: Theme name. */
                            printf( esc_html__( '%s Theme', 'skdom' ), 'Skdom Pro' );
                    ?></a>
                    <?php
                            /* translators: 1: Theme name, 2: Theme author. */
                            printf( esc_html__( 'powered by %s.', 'skdom' ), '<a href="https://wordpress.org/" target="_blank">WordPress</a>' );
                    ?>
            </div><!-- .site-info -->
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
