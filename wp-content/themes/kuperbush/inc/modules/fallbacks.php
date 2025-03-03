<?php
/**
 * Fallback functions for the menus to ensure the site looks exactly like the original HTML
 * until real WordPress menus are created
 */
if (!function_exists('kuperbush_primary_menu_fallback')) {
    function kuperbush_primary_menu_fallback() {
        echo '<ul id="top-menu" class="nav">
            <li class="menu-principal-productos menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                <a id="menu-item--first" data-menu="auto" href="">מוצרים</a>
                <ul class="sub-menu">
                    <li id="menu-item-ovens-and-compacts" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-ovens-and-compacts">
                        <a id="menu-item-ovens-and-compacts-first" data-menu="auto" href="' . get_template_directory_uri() . '/ovens-and-compacts/index.html">תנורים וקומפקטים</a>
                    </li>
                    <li id="menu-item-hobs" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-hobs">
                        <a id="menu-item-hobs-first" data-menu="auto" href="' . get_template_directory_uri() . '/hobs/index.html">כיריים</a>
                    </li>
                    <li id="menu-item-hoods" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-hoods">
                        <a id="menu-item-hoods-first" data-menu="auto" href="' . get_template_directory_uri() . '/hoods/index.html">סינונים</a>
                    </li>
                    <li id="menu-item-refrigeration" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-refrigeration">
                        <a id="menu-item-refrigeration-first" data-menu="auto" href="' . get_template_directory_uri() . '/refrigeration/index.html">קירור</a>
                    </li>
                    <li id="menu-item-dishwashers" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-dishwashers">
                        <a id="menu-item-dishwashers-first" data-menu="auto" href="' . get_template_directory_uri() . '/dishwashers/index.html">מדיחי כלים</a>
                    </li>
                    <li id="menu-item-laundry" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-laundry">
                        <a id="menu-item-laundry-first" data-menu="auto" href="' . get_template_directory_uri() . '/laundry/index.html">כביסה</a>
                    </li>
                    <li id="menu-item-sinks-and-taps" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-sinks-and-taps">
                        <a id="menu-item-sinks-and-taps-first" data-menu="auto" href="' . get_template_directory_uri() . '/sinks-and-taps/index.html">כיורים וברזים</a>
                    </li>
                </ul>
            </li>
            <li id="menu-item-69858" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-69858">
                <a href="#">על קופרסבוש</a>
                <ul class="sub-menu">
                    <li id="menu-item-69859" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69859">
                        <a href="' . get_template_directory_uri() . '/brand/index.html">מותג</a>
                    </li>
                    <li id="menu-item-69860" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69860">
                        <a href="' . get_template_directory_uri() . '/design/index.html">עיצוב</a>
                    </li>
                    <li id="menu-item-69904" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69904">
                        <a href="' . get_template_directory_uri() . '/in-the-world/index.html">KPH ברחבי העולם</a>
                    </li>
                    <li id="menu-item-69917" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69917">
                        <a href="' . get_template_directory_uri() . '/history/index.html">היסטוריה</a>
                    </li>
                    <li id="menu-item-69861" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69861">
                        <a href="' . get_template_directory_uri() . '/downloads/index.html">הורדות</a>
                    </li>
                </ul>
            </li>
            <li id="menu-item-69862" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69862">
                <a href="' . get_template_directory_uri() . '/service/index.html">שירות</a>
            </li>
        </ul>';
    }
}

if (!function_exists('kuperbush_footer_products_menu_fallback')) {
    function kuperbush_footer_products_menu_fallback() {
        echo '<div id="nav_menu-4" class="fwidget et_pb_widget widget_nav_menu">
            <h4 class="title">מוצרים</h4>
            <div class="menu-products-footer-container">
                <ul id="menu-products-footer" class="menu">
                    <li id="menu-item-69933" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69933">
                        <a href="' . get_template_directory_uri() . '/ovens-and-compacts/index.html">תנורים</a>
                    </li>
                    <li id="menu-item-69934" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69934">
                        <a href="' . get_template_directory_uri() . '/hobs/index.html">כיריים</a>
                    </li>
                    <li id="menu-item-69935" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69935">
                        <a href="' . get_template_directory_uri() . '/hoods/index.html">סינונים</a>
                    </li>
                    <li id="menu-item-69936" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69936">
                        <a href="' . get_template_directory_uri() . '/refrigeration/index.html">קו קר</a>
                    </li>
                    <li id="menu-item-69937" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69937">
                        <a href="' . get_template_directory_uri() . '/dishwashers/index.html">מדיחי כלים</a>
                    </li>
                    <li id="menu-item-69938" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-69938">
                        <a href="' . get_template_directory_uri() . '/laundry/index.html">כביסה</a>
                    </li>
                    <li id="menu-item-76241" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-76241">
                        <a href="' . get_template_directory_uri() . '/sinks-and-taps/index.html">כיורים וברזים</a>
                    </li>
                    <li id="menu-item-76577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-76577">
                        <a href="' . get_template_directory_uri() . '/service/manuals/index.html">מדריכים</a>
                    </li>
                </ul>
            </div>
        </div>';
    }
}

if (!function_exists('kuperbush_footer_about_menu_fallback')) {
    function kuperbush_footer_about_menu_fallback() {
        echo '<div id="nav_menu-12" class="fwidget et_pb_widget widget_nav_menu">
            <h4 class="title">אודות קופרבוש</h4>
            <div class="menu-about-kuppersbusch-footer-container">
                <ul id="menu-about-kuppersbusch-footer" class="menu">
                    <li id="menu-item-69944" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69944">
                        <a href="' . get_template_directory_uri() . '/brand/index.html">ערכי מותג</a>
                    </li>
                    <li id="menu-item-69942" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69942">
                        <a href="' . get_template_directory_uri() . '/history/index.html">היסטוריה</a>
                    </li>
                    <li id="menu-item-69940" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69940">
                        <a href="' . get_template_directory_uri() . '/design/index.html">עיצוב</a>
                    </li>
                    <li id="menu-item-69941" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69941">
                        <a href="' . get_template_directory_uri() . '/downloads/index.html">הורדות</a>
                    </li>
                    <li id="menu-item-72896" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-72896">
                        <a href="' . get_template_directory_uri() . '/new-energy-label/index.html">תווית אנרגיה חדשה</a>
                    </li>
                    <li id="menu-item-69939" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-69939">
                        <a href="' . get_template_directory_uri() . '/service/index.html">שירות</a>
                    </li>
                    <li id="menu-item-74079" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-74079">
                        <a href="' . get_template_directory_uri() . '/individual/index.html">אישי</a>
                    </li>
                    <li id="menu-item-74080" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-74080">
                        <a href="' . get_template_directory_uri() . '/k-series/index.html">סדרת K</a>
                    </li>
                </ul>
            </div>
        </div>';
    }
}

if (!function_exists('kuperbush_footer_brand_info_fallback')) {
    function kuperbush_footer_brand_info_fallback() {
        echo '<div id="media_image-2" class="fwidget et_pb_widget widget_media_image">
            <img class="image" src="' . get_template_directory_uri() . '/img/kuppersbusch-white.svg" alt="" width="300" height="37" decoding="async" loading="lazy" />
        </div>
        <div id="custom_html-3" class="widget_text fwidget et_pb_widget widget_custom_html">
            <div class="textwidget custom-html-widget">
                <a href="https://www.youtube.com/channel/UCaRoMAFkv5XWgWDPwObus4g" target="_blank" align="right">
                    <img src="' . get_template_directory_uri() . '/img/uploads/KPH-youtube-.png">
                </a>
                <a href="https://www.linkedin.com/company/k%C3%BCppersbusch-hausger%C3%A4te-gmbh/" target="_blank" align="right">
                    <img src="' . get_template_directory_uri() . '/img/uploads/KPH-linkedin-.png">
                </a>
                <a href="https://www.instagram.com/kueppersbusch.international/" target="_blank" align="right">
                    <img src="' . get_template_directory_uri() . '/img/uploads/KPH-INDIVIDUA.png">
                </a>
            </div>
        </div>';
    }
}

if (!function_exists('kuperbush_legal_menu_fallback')) {
    function kuperbush_legal_menu_fallback() {
        echo '<ul id="menu-legal" class="bottom-nav">
            <li id="menu-item-22135" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22135">
                <a href="' . get_template_directory_uri() . '/legal-notice/index.html">ייעוץ משפטי</a>
            </li>
            <li id="menu-item-22140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22140">
                <a href="' . get_template_directory_uri() . '/privacy-policy/index.html">מדיניות פרטיות</a>
            </li>
            <li id="menu-item-22141" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22141">
                <a href="' . get_template_directory_uri() . '/cookies-policy/index.html">מדיניות עוגיות</a>
            </li>
        </ul>';
    }
}