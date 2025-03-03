<?php
/**
 * Template Name: Service Page
 */

// Get the current template directory URI for relative paths
$template_uri = get_template_directory_uri();
$site_url = site_url();

// Get the header
get_header();
?>

<div id="main-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="et-l et-l--post">
            <div class="et_builder_inner_content et_pb_gutters3">
                <!-- Service/Contact page content -->
                
                <div id="kupper-contact-header" class="et_pb_section et_pb_section_0 et_pb_with_background et_section_regular" data-padding="||0px|">
                    <div class="et_pb_row et_pb_row_0 et_pb_equal_columns">
                        <div class="et_pb_column et_pb_column_4_4 et_pb_column_0 et_pb_css_mix_blend_mode_passthrough et-last-child">
                            <div class="et_pb_module et_pb_text et_pb_text_0 et_animated et_pb_text_align_left et_pb_bg_layout_light">
                                <div class="et_pb_text_inner" data-et-multi-view="{&quot;schema&quot;:{&quot;content&quot;:{&quot;desktop&quot;:&quot;&lt;h1&gt;צור קשר&lt;\/h1&gt;&quot;,&quot;phone&quot;:&quot;&lt;h3&gt;צור קשר&lt;\/h3&gt;&quot;}},&quot;slug&quot;:&quot;et_pb_text&quot;}" data-et-multi-view-load-phone-hidden="true">
                                    <h1>צור קשר</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="kupper-contact-forms" class="et_pb_section et_pb_section_2 et_pb_with_background et_section_regular">
                    <div class="et_pb_row et_pb_row_1">
                        <div class="et_pb_column et_pb_column_1_2 et_pb_column_1 et_pb_css_mix_blend_mode_passthrough">
                            <div class="et_pb_module et_pb_text et_pb_text_1 et_pb_text_align_left et_pb_bg_layout_dark">
                                <div class="et_pb_text_inner">
                                    <h3>צור קשר לשירות טכני</h3>
                                    <p>טלפון: 0209 401-631<br>
                                    שני עד חמישי 08:30 עד 18:00<br>
                                    שישי 08:30 עד 17:00</p>
                                </div>
                            </div>
                            
                            <div class="et_pb_module et_pb_code et_pb_code_0">
                                <div class="et_pb_code_inner">
                                    <div class="wpcf7 js" id="wpcf7-f23085-p69677-o1" lang="es-ES" dir="ltr">
                                        <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
                                        <form action="/service/#wpcf7-f23085-p69677-o1" method="post" class="wpcf7-form init" aria-label="טופס יצירת קשר" novalidate="novalidate" data-status="init">
                                            <div style="display: none;">
                                                <input type="hidden" name="_wpcf7" value="23085">
                                                <input type="hidden" name="_wpcf7_version" value="6.0.3">
                                                <input type="hidden" name="_wpcf7_locale" value="es_ES">
                                                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f23085-p69677-o1">
                                                <input type="hidden" name="_wpcf7_container_post" value="69677">
                                                <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                                            </div>
                                            <p>
                                                <label class="col6"> <strong>שם</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="first-name"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="first-name"></span> </label>
                                                <label class="col6"> <strong>שם משפחה</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="last-name"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="last-name"></span> </label><br>
                                                <label class="col6"> <strong>טלפון</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="phone"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="" value="" type="text" name="phone"></span> </label><br>
                                                <label class="col6"> <strong>אימייל</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="email"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" aria-required="true" aria-invalid="false" value="" type="email" name="email"></span> </label><br>
                                                <label class="col6"> <strong>עיר</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="city"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="city"></span> </label><br>
                                                <label class="col6"> <strong>מדינה</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="your-recipient"><select class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="your-recipient"><option value="GLOBAL">GLOBAL</option><option value="España">España</option><option value="Argentina">Argentina</option><option value="België">België</option><option value="България">България</option><option value="Česko">Česko</option><option value="Chile">Chile</option><option value="中国">中国</option><option value="Colombia">Colombia</option><option value="Danmark">Danmark</option><option value="Ecuador">Ecuador</option><option value="France">France</option><option value="Ελλάδα">Ελλάδα</option><option value="Deutschland">Deutschland</option><option value="Israel">Israel</option><option value="Italia">Italia</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Mexico">Mexico</option><option value="Österreich">Österreich</option><option value="Paraguay">Paraguay</option><option value="Perú">Perú</option><option value="Россия">Россия</option><option value="Polska">Polska</option><option value="Portugal">Portugal</option><option value="România">România</option><option value="Suisse">Suisse</option><option value="Thailand">Thailand</option><option value="Türkiye">Türkiye</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="Uruguay">Uruguay</option><option value="Vietnam">Vietnam</option></select></span> </label>
                                            </p>
                                            <div>
                                                <p>
                                                    <label class="col12"> <strong>מה הסיבה לפנייתך?</strong> <span class="wpcf7-form-control-wrap" data-name="comment"><textarea cols="40" rows="10" maxlength="2000" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" name="comment"></textarea></span></label><br>
                                                    <label class="col12 my-30"> <span class="wpcf7-form-control-wrap" data-name="privacy-policy"><span class="wpcf7-form-control wpcf7-acceptance"><span class="wpcf7-list-item"><input type="checkbox" name="privacy-policy" value="1" aria-invalid="false"></span></span></span> <span class="text_check_privacy">קראתי ומסכים למדיניות הפרטיות <a href="<?php echo $site_url; ?>/privacy-policy/">(המדיניות)</a> </span></label>
                                                </p>
                                            </div>
                                            <p>
                                                <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="שלח" disabled=""><span class="wpcf7-spinner"></span>
                                            </p>
                                            <div class="wpcf7-response-output" aria-hidden="true"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="et_pb_column et_pb_column_1_2 et_pb_column_2 et_pb_css_mix_blend_mode_passthrough et-last-child">
                            <div class="et_pb_module et_pb_text et_pb_text_3 et_pb_text_align_left et_pb_bg_layout_dark">
                                <div class="et_pb_text_inner">
                                    <h3>צור קשר מקצועי</h3>
                                </div>
                            </div>
                            
                            <div class="et_pb_module et_pb_code et_pb_code_1">
                                <div class="et_pb_code_inner">
                                    <div class="wpcf7 js" id="wpcf7-f69706-p69677-o2" lang="es-ES" dir="ltr">
                                        <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
                                        <form action="/service/#wpcf7-f69706-p69677-o2" method="post" class="wpcf7-form init" aria-label="טופס יצירת קשר" novalidate="novalidate" data-status="init">
                                            <div style="display: none;">
                                                <input type="hidden" name="_wpcf7" value="69706">
                                                <input type="hidden" name="_wpcf7_version" value="6.0.3">
                                                <input type="hidden" name="_wpcf7_locale" value="es_ES">
                                                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f69706-p69677-o2">
                                                <input type="hidden" name="_wpcf7_container_post" value="69677">
                                                <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                                            </div>
                                            <p>
                                                <label class="col6"> <strong>שם</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="first-name"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="first-name"></span> </label>
                                                <label class="col6"> <strong>שם משפחה</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="last-name"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="last-name"></span> </label><br>
                                                <label class="col6"> <strong>טלפון</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="phone"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="" value="" type="text" name="phone"></span> </label><br>
                                                <label class="col6"> <strong>אימייל</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="email"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" aria-required="true" aria-invalid="false" value="" type="email" name="email"></span> </label><br>
                                                <label class="col6"> <strong>עיר</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="city"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="city"></span> </label><br>
                                                <label class="col6"> <strong>מדינה</strong><br>
                                                <span class="wpcf7-form-control-wrap" data-name="your-recipient"><select class="wpcf7-form-control wpcf7-select" aria-invalid="false" name="your-recipient"><option value="GLOBAL">GLOBAL</option><option value="España">España</option><option value="Argentina">Argentina</option><option value="België">België</option><option value="България">България</option><option value="Česko">Česko</option><option value="Chile">Chile</option><option value="中国">中国</option><option value="Colombia">Colombia</option><option value="Danmark">Danmark</option><option value="Ecuador">Ecuador</option><option value="France">France</option><option value="Ελλάδα">Ελλάδα</option><option value="Deutschland">Deutschland</option><option value="Israel">Israel</option><option value="Italia">Italia</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Mexico">Mexico</option><option value="Österreich">Österreich</option><option value="Paraguay">Paraguay</option><option value="Perú">Perú</option><option value="Россия">Россия</option><option value="Polska">Polska</option><option value="Portugal">Portugal</option><option value="România">România</option><option value="Suisse">Suisse</option><option value="Thailand">Thailand</option><option value="Türkiye">Türkiye</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="Uruguay">Uruguay</option><option value="Vietnam">Vietnam</option></select></span> </label>
                                            </p>
                                            <div>
                                                <p>
                                                    <label class="col12"> <strong>מה הסיבה לפנייתך?</strong> <span class="wpcf7-form-control-wrap" data-name="comment"><textarea cols="40" rows="10" maxlength="2000" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" name="comment"></textarea></span></label><br>
                                                    <label class="col12 my-30"> <span class="wpcf7-form-control-wrap" data-name="privacy-policy"><span class="wpcf7-form-control wpcf7-acceptance"><span class="wpcf7-list-item"><input type="checkbox" name="privacy-policy" value="1" aria-invalid="false"></span></span></span> <span class="text_check_privacy">קראתי ומסכים למדיניות הפרטיות <a href="<?php echo $site_url; ?>/privacy-policy/">(המדיניות)</a> </span></label>
                                                </p>
                                            </div>
                                            <p>
                                                <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="שלח" disabled=""><span class="wpcf7-spinner"></span>
                                            </p>
                                            <div class="wpcf7-response-output" aria-hidden="true"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="et_pb_row et_pb_row_2">
                        <div class="et_pb_column et_pb_column_4_4 et_pb_column_3 et_pb_css_mix_blend_mode_passthrough et-last-child et_pb_column_empty">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<?php
// Add any template-specific styles or scripts
?>

<style type="text/css">
    div.et_pb_section.et_pb_section_0::before {
        background-image: url(<?php echo $template_uri; ?>/img/uploads/KUPPER-Cabecera-8.jpg)!important;
    }
    .et_pb_section_0.et_pb_section {
        padding-bottom: 0px;
        background-color: #000000!important;
    }
    .et_pb_section_0 {
        margin-top: -80px;
    }
    .et_pb_text_0.et_pb_text {
        color: #FFFFFF!important;
    }
    .et_pb_text_0 h1 {
        font-weight: 300;
        color: #ffffff!important;
    }
    .et_pb_text_0 {
        padding-top: 180px!important;
        padding-bottom: 200px!important;
    }
    .et_pb_section_2.et_pb_section {
        background-color: #000000!important;
    }
    .et_pb_row_2.et_pb_row {
        padding-top: 40px!important;
        padding-top: 40px;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Service page specific script
    });
</script>

<?php
// Get the footer
get_footer();