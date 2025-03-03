<?php
/**
 * The front page template file
 */

get_header();
?>

<div id="main-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="et-l et-l--post">
            <div class="et_builder_inner_content et_pb_gutters3">
                <div id="kph-home-slider" class="et_pb_section et_pb_section_0 et_pb_fullwidth_section et_section_regular">
                    <div class="et_pb_module et_pb_fullwidth_slider_0 no-shadow et_animated et_pb_slider et_slider_auto et_slider_speed_10000ms">
                        <div class="et_pb_slides">
                            <div class="et_pb_slide et_pb_slide_0 et_clickable et_pb_section_video et_pb_preload et_pb_bg_layout_dark et_pb_media_alignment_center et-pb-active-slide" data-slide-id="et_pb_slide_0">
                                <div class="et_pb_container clearfix">
                                    <div class="et_pb_slider_container_inner">
                                        <div class="et_pb_slide_description">
                                            <div class="et_pb_slide_content">
                                                <h3>ההרמוניה המושלמת.</h3>
                                                <h3>הגדירו מחדש את המרחב שלכם עם כיריים האינדוקציה שתיים באחת שלנו.</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="et_pb_section_video_bg et_pb_section_video_bg_desktop_tablet">
                                    <video loop autoplay="autoplay" playsinline muted="muted" preload="auto">
                                        <source type="video/mp4" src="<?php echo get_template_directory_uri(); ?>/video/KPH_WebVideo_PlacasCampanaIntegrada.mp4" />
                                    </video>
                                </span>
                            </div>
                            <div class="et_pb_slide et_pb_slide_1 et_clickable et_pb_section_video et_pb_preload et_pb_bg_layout_dark et_pb_media_alignment_center et_pb_slider_with_overlay" data-slide-id="et_pb_slide_1">
                                <div class="et_pb_slide_overlay_container"></div>
                                <div class="et_pb_container clearfix">
                                    <div class="et_pb_slider_container_inner">
                                        <div class="et_pb_slide_description">
                                            <div class="et_pb_slide_content">
                                                <h3>יחיד מסוגו.</h3>
                                                <h3>גלו את האומנות של קו העיצוב גרפיט.</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="et_pb_section_video_bg et_pb_section_video_bg_desktop_tablet">
                                    <video loop autoplay="autoplay" playsinline muted="muted" preload="auto">
                                        <source type="video/mp4" src="<?php echo get_template_directory_uri(); ?>/video/KPH_WebVideo_GraphiteDesignLine_Kitchen.mp4" />
                                    </video>
                                </span>
                            </div>
                            <div class="et_pb_slide et_pb_slide_2 et_clickable et_pb_section_video et_pb_preload et_pb_bg_layout_dark et_pb_media_alignment_center" data-slide-id="et_pb_slide_2">
                                <div class="et_pb_container clearfix">
                                    <div class="et_pb_slider_container_inner">
                                        <div class="et_pb_slide_description">
                                            <div class="et_pb_slide_content">
                                                <h3>מט הוא השחור החדש.</h3>
                                                <h3>צעדו אל תוך קו העיצוב שחור מט.</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="et_pb_section_video_bg et_pb_section_video_bg_desktop_tablet">
                                    <video loop autoplay="autoplay" playsinline muted="muted" preload="auto">
                                        <source type="video/mp4" src="<?php echo get_template_directory_uri(); ?>/video/KPH_WebVideo_MattBlackDesignLine_Kitchen.mp4" />
                                    </video>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article> <!-- .et_pb_post -->
</div> <!-- #main-content -->

<?php
get_footer();