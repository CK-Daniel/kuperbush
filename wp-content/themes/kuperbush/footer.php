        </div> <!-- #et-main-area -->


    </div> <!-- #page-container -->

    <footer id="main-footer">
        <div class="container">
            <div id="footer-widgets" class="clearfix">
                <div class="footer-widget">
                    <?php 
                    if (has_nav_menu('footer-products')) {
                        echo '<div id="nav_menu-4" class="fwidget et_pb_widget widget_nav_menu"><h4 class="title">מוצרים</h4>';
                        wp_nav_menu(array(
                            'theme_location' => 'footer-products',
                            'menu_id' => 'menu-products-footer',
                            'container_class' => 'menu-products-footer-container',
                        ));
                        echo '</div>';
                    } else {
                        // Use hardcoded menu as fallback
                        ?>
                        <div id="nav_menu-4" class="fwidget et_pb_widget widget_nav_menu"><h4 class="title">מוצרים</h4>
                            <div class="menu-products-footer-container">
                                <ul id="menu-products-footer" class="menu">
                                    <li id="menu-item-69933" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69933"><a href="<?php echo home_url(); ?>/ovens-and-compacts/index.html">תנורים</a></li>
                                    <li id="menu-item-69934" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69934"><a href="<?php echo home_url(); ?>/hobs/index.html">כיריים</a></li>
                                    <li id="menu-item-69935" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69935"><a href="<?php echo home_url(); ?>/hoods/index.html">סינונים</a></li>
                                    <li id="menu-item-69936" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69936"><a href="<?php echo home_url(); ?>/refrigeration/index.html">קו קר</a></li>
                                    <li id="menu-item-69937" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69937"><a href="<?php echo home_url(); ?>/dishwashers/index.html">מדיחי כלים</a></li>
                                    <li id="menu-item-69938" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69938"><a href="<?php echo home_url(); ?>/laundry/index.html">כביסה</a></li>
                                    <li id="menu-item-76241" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-76241"><a href="<?php echo home_url(); ?>/sinks-and-taps/index.html">כיורים וברזים</a></li>
                                    <li id="menu-item-76577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-76577"><a href="<?php echo home_url(); ?>/service/manuals/index.html">מדריכים</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div> <!-- end .footer-widget -->
                
                <div class="footer-widget">
                    <?php 
                    if (has_nav_menu('footer-about')) {
                        echo '<div id="nav_menu-12" class="fwidget et_pb_widget widget_nav_menu"><h4 class="title">אודות קופרבוש</h4>';
                        wp_nav_menu(array(
                            'theme_location' => 'footer-about',
                            'menu_id' => 'menu-about-kuppersbusch-footer',
                            'container_class' => 'menu-about-kuppersbusch-footer-container',
                        ));
                        echo '</div>';
                    } else {
                        // Use hardcoded menu as fallback
                        ?>
                        <div id="nav_menu-12" class="fwidget et_pb_widget widget_nav_menu"><h4 class="title">אודות קופרבוש</h4>
                            <div class="menu-about-kuppersbusch-footer-container">
                                <ul id="menu-about-kuppersbusch-footer" class="menu">
                                    <li id="menu-item-69944" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69944"><a href="<?php echo home_url(); ?>/brand/index.html">ערכי מותג</a></li>
                                    <li id="menu-item-69942" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69942"><a href="<?php echo home_url(); ?>/history/index.html">היסטוריה</a></li>
                                    <li id="menu-item-69940" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69940"><a href="<?php echo home_url(); ?>/design/index.html">עיצוב</a></li>
                                    <li id="menu-item-69941" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69941"><a href="<?php echo home_url(); ?>/downloads/index.html">הורדות</a></li>
                                    <li id="menu-item-72896" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-72896"><a href="<?php echo home_url(); ?>/new-energy-label/index.html">תווית אנרגיה חדשה</a></li>
                                    <li id="menu-item-69939" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69939"><a href="<?php echo home_url(); ?>/service/index.html">שירות</a></li>
                                    <li id="menu-item-74079" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-74079"><a href="<?php echo home_url(); ?>/individual/index.html">אישי</a></li>
                                    <li id="menu-item-74080" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-74080"><a href="<?php echo home_url(); ?>/k-series/index.html">סדרת K</a></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div> <!-- end .footer-widget -->
                
                <div class="footer-widget">
                    <div id="media_image-2" class="fwidget et_pb_widget widget_media_image">
                        <img class="image" src="<?php echo get_template_directory_uri(); ?>/img/kuppersbusch-white.svg" alt="" width="300" height="37" decoding="async" loading="lazy" />
                    </div>
                    <div id="custom_html-3" class="widget_text fwidget et_pb_widget widget_custom_html">
                        <div class="textwidget custom-html-widget">
                            <a href="https://www.youtube.com/channel/UCaRoMAFkv5XWgWDPwObus4g" target="_blank" align="right">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/uploads/KPH-youtube-.png">
                            </a>
                            <a href="https://www.linkedin.com/company/k%C3%BCppersbusch-hausger%C3%A4te-gmbh/" target="_blank" align="right">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/uploads/KPH-linkedin-.png">
                            </a>
                            <a href="https://www.instagram.com/kueppersbusch.international/" target="_blank" align="right">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/uploads/KPH-INDIVIDUA.png">
                            </a>
                        </div>
                    </div>
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
                        // Use hardcoded menu as fallback
                        ?>
                        <ul id="menu-legal" class="bottom-nav">
                            <li id="menu-item-22135" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22135"><a href="<?php echo home_url(); ?>/legal-notice/index.html">ייעוץ משפטי</a></li>
                            <li id="menu-item-22140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22140"><a href="<?php echo home_url(); ?>/privacy-policy/index.html">מדיניות פרטיות</a></li>
                            <li id="menu-item-22141" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22141"><a href="<?php echo home_url(); ?>/cookies-policy/index.html">מדיניות עוגיות</a></li>
                        </ul>
                        <?php
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