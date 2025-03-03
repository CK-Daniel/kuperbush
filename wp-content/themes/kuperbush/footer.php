        </div> <!-- #et-main-area -->


    </div> <!-- #page-container -->

    <footer id="main-footer">
        <div class="container">
            <div id="footer-widgets" class="clearfix">
                <div class="footer-widget">
                    <?php 
                    if (is_active_sidebar('footer-1')) {
                        dynamic_sidebar('footer-1');
                    } else {
                        kuperbush_footer_products_menu_fallback();
                    }
                    ?>
                </div> <!-- end .footer-widget -->
                
                <div class="footer-widget">
                    <?php 
                    if (is_active_sidebar('footer-2')) {
                        dynamic_sidebar('footer-2');
                    } else {
                        kuperbush_footer_about_menu_fallback();
                    }
                    ?>
                </div> <!-- end .footer-widget -->
                
                <div class="footer-widget">
                    <?php 
                    if (is_active_sidebar('footer-3')) {
                        dynamic_sidebar('footer-3');
                    } else {
                        kuperbush_footer_brand_info_fallback();
                    }
                    ?>
                </div> <!-- end .footer-widget -->
            </div> <!-- #footer-widgets -->
        </div>	<!-- .container -->

        <div id="footer-bottom">
            <div class="container clearfix">
                <div id="footer-legal">
                    <?php
                    if (has_nav_menu('legal')) {
                        wp_nav_menu(array(
                            'theme_location' => 'legal',
                            'menu_id' => 'menu-legal',
                            'menu_class' => 'bottom-nav',
                            'container' => '',
                        ));
                    } else {
                        kuperbush_legal_menu_fallback();
                    }
                    ?>
                </div> <!-- #et-footer-nav -->

                <div id="footer-copyright">&copy; Copyright <?php echo date('Y'); ?>. Küppersbusch</div>
            </div>	<!-- .container -->
        </div>
    </footer> <!-- #main-footer -->

    <div style="display: none;">
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery("#top-menu .sub-menu-2").each(function( index ) {
                    jQuery( this ).css("height", jQuery(this).parent().find(".sub-menu").outerHeight());
                });
            });
        </script>

        <ul class="sub-menu-2 sub-menu-support">
            <div>
                <span class="menu-support-atencion"><strong><?php esc_html_e('Service', 'kuperbush'); ?></strong> <?php esc_html_e('customers', 'kuperbush'); ?></span>
                <span class="menu-support-telefono">902 111 211</span>
                <span class="menu-support-horario"><?php esc_html_e('Available Monday through Friday,', 'kuperbush'); ?> <br><?php esc_html_e('8 to 20', 'kuperbush'); ?></span>
            </div>
        </ul>
    </div>


    <div id="player-container" style="display:none">
        <iframe id="player" src="about:blank" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen">
        </iframe>
        <span class="close"><i class='itk-cross'></i><span>
    </div>

    <?php wp_footer(); ?>
</body>
</html>