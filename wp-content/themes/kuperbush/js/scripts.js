var loc = window.location.href;
//if(loc.includes("//cms.teka.com")){
//window.location.href = loc.replace("//cms.teka.com", "//teka.com");
//console.log(loc);
//}

/**
 * jQuery.browser.mobile (http://detectmobilebrowser.com/)
 *
 * jQuery.browser.mobile will be true if the browser is a mobile device
 *
 **/
(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

removeRandomHomeSlide();

if (jQuery(window).width() > 981) {
    posicionarSubMenu();
    posicionarFiltros();
}

jQuery(window).scroll(function() {

    if (jQuery(window).width() > 981) {
        posicionarSubMenu();
        posicionarFiltros();
    }
});


jQuery(window).load(function() {
    //movemos los iconos de compartir donde queramos
    jQuery(".single-project .et_social_inline").appendTo(".single-project .et_pb_column_1_3 .social-container"); //proyectos
    jQuery(".single-post .et_social_inline").appendTo(".single-post .social-container"); //noticias

    jQuery("#home-slider-productos .et-pb-controllers > a:nth-child(1)").html('<span>' + jQuery("#home-slider-productos > div > div.et_pb_slides > div.et_pb_slide.et_pb_slide_2 h2").text() + '</span>');
    jQuery("#home-slider-productos .et-pb-controllers > a:nth-child(2)").html('<span>' + jQuery("#home-slider-productos > div > div.et_pb_slides > div.et_pb_slide.et_pb_slide_3 h2").text() + '</span>');
    jQuery("#home-slider-productos .et-pb-controllers > a:nth-child(3)").html('<span>' + jQuery("#home-slider-productos > div > div.et_pb_slides > div.et_pb_slide.et_pb_slide_4 h2").text() + '</span>');
    jQuery("#home-slider-productos .et-pb-controllers > a:nth-child(4)").html('<span>' + jQuery("#home-slider-productos > div > div.et_pb_slides > div.et_pb_slide.et_pb_slide_5 h2").text() + '</span>');


    //simulamos click en el menu de los proyectos
    setTimeout(clickMenuProyecto, 500);
    resizeCatVideos();


});

jQuery(document).ready(function() {
    jQuery('input').change(function() {
        if (jQuery(".wpcf7-submit").attr('disabled')) {
            jQuery(".wpcf7-submit").parent().removeClass("wpcf7-submit-p-active");
        } else {
            jQuery(".wpcf7-submit").parent().addClass("wpcf7-submit-p-active");
        }
    });

    jQuery("#back-button").click(function() {
        if (document.referrer.indexOf(window.location.host) !== -1) {
            window.history.go(-1);
            return false;
        } else {
            window.location.href = "https://home-kueppersbusch.com";
        }

    });

   //jQuery('.currentCountry').featherlight();
});

jQuery("body").on('click', '.currentCountry', function() {
    loadLighboxCountries();
});

jQuery(".currentCountry").on({
    'click'     :   function(e){
        e.preventDefault();
        // console.log(2);
        jQuery.featherlight("#lighboxCountries",{variant: "lighboxCountries"});
    }
})

function loadLighboxCountries() {
    //cargamos una única vez los paises

    if (jQuery("#lighboxCountries").children().length == 0) {
        //console.log("lighboxCountries");
        jQuery.ajax({
            url: home_uri + 'wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'cargar_paises'
            },
            beforeSend: function(xhr) {
                //filter.find('button').text('Processing...'); // changing the button label
            },
            success: function(response) {
                jQuery("#lighboxCountries").html(response); // insert data

                jQuery.featherlight("#lighboxCountries", {
                    variant: "lighboxCountries"
                });
            }
        });
    } else {
        jQuery.featherlight("#lighboxCountries", {
            variant: "lighboxCountries"
        });
    }
}

//channelsight
function channelsightShowButton($assetId, $reference) {
    //console.log($assetId);
    //console.log($reference);
    jQuery.get("https://api.channelsight.com/api/1.21/feed", {
        key: "bb9a4b72-1afd-4bb8-a179-87d01cf49d35",
        assetId: $assetId,
        pid: $reference
    }).done(function(data) {
        if (jQuery.isArray(data) && data.length > 0 && data[0]["RetailerProducts"].length > 0) {
            if (jQuery("body").hasClass("current_site_2")) {
                var show = true;

                data[0]["RetailerProducts"].forEach(function (valor, indice, array) {
                    console.log(valor["RetailerName"]);
                    if (valor["RetailerName"] != "ElCorteIngles" && valor["RetailerName"] != "MediaMarktES" && valor["RetailerName"] != "LeroyMerlinES") {
                        show = false;
                    }
                });

                if (show) {
                    if (!jQuery(".channelsightButton-" + $reference).hasClass("cswidget")) {
                        //console.dir(initAndRun);
                        jQuery(".channelsightButton-" + $reference).addClass("cswidget");
                    }

                    jQuery(".channelsightButton-" + $reference).show();
                }
            } else {
                if (!jQuery(".channelsightButton-" + $reference).hasClass("cswidget")) {
                    jQuery(".channelsightButton-" + $reference).addClass("cswidget");
                }
                jQuery(".channelsightButton-" + $reference).show();
            }
        }
    });
}

jQuery(".channelsightButton").click(function(event) {
    var nombre = jQuery(this).data("producto-nombre");
    var nombreCorto = jQuery(this).data("producto-nombre-corto");
    var lifestyle = jQuery(this).data("producto-lifestyle");
    var referencia = jQuery(this).data("product-sku");

    var productTitle = '<div id="product-title"><h4>' + lifestyle + '</h4><span class="separator">&gt;</span><h2>' + nombreCorto + '</h2><h1>' + nombre + '</h1></div>';

    setTimeout(function() {
        jQuery(document).find(".csWidgetTitle").replaceWith(productTitle);
        jQuery(document).find(".csWidgetModal-content").show();
        jQuery("#csmodalbox").addClass("product" + referencia);

    }, 1000);
});


// Menu responsive amb els items de segon nivell amagats
(function($) {

    function setup_collapsible_submenus() {
        var $menu = $('#mobile_menu'),
            top_level_link = '#mobile_menu .menu-item-has-children > a';

        $menu.find('a').each(function() {
            $(this).off('click');

            if ($(this).is(top_level_link)) {
                $(this).attr('href', '#');
            }

            if (!$(this).siblings('.sub-menu').length) {
                $(this).on('click', function(event) {
                    $(this).parents('.mobile_nav').trigger('click');
                });
            } else {
                $(this).on('click', function(event) {
                    event.preventDefault();
                    $(this).parent().toggleClass('visible');
                });
            }
        });
    }

    $(window).load(function() {
        setTimeout(function() {
            setup_collapsible_submenus();
        }, 700);
    });

})(jQuery);

jQuery(document).ready(function() {
    //
    setTimeout(autoLoadVideo, 200);


    //https://www.elegantthemes.com/blog/divi-resources/how-to-give-your-divi-archive-pages-a-masonry-layout
    leftarea = jQuery('#left-area');
    pageNavi = leftarea.find('.wp-pagenavi');
    pageNavigation = leftarea.find('.pagination');

    if (pageNavi.length) {
        pagenav = jQuery('#left-area .wp-pagenavi');
    } else {
        pagenav = jQuery('#left-area .pagination');
    }
    pagenav.detach();
    leftarea.after(pagenav);

    //
    jQuery("#agentes-export-list .et_pb_team_member_description h4").click(function() {
        jQuery("#agentes-export-list .et_pb_team_member_description p").hide();
        jQuery(this).parent().find("p.mostrar").show();
        jQuery(this).parent().find("p").toggle();
        jQuery(this).parent().find("p").toggleClass('mostrar');

    });

    //activamos el buscador del header
    jQuery("#et_top_search_custom > a").click(function(e) {
        jQuery(this).next().toggleClass("search_active");
        temp = jQuery("#se").val();
        jQuery("#se").val('');
        jQuery("#se").val(temp);
        jQuery("#se").focus();

        e.preventDefault();
    });

});



//jQuery("#creacio-left .et_pb_team_member_description").append('<div id="button-back"><a href="" onclick="volver();">< BACK TO CREATIONS</a></div>');

//animación cando hacemos click en flecha de una cabecera full-height
jQuery(".scroll_discover").on("click", function(event) {
    event.preventDefault();
    jQuery("html, body").animate({
        scrollTop: jQuery(window).height()
    }, "slow");

});

//click en cualquier parte del slider de portada
jQuery('#home-main-slide').on('click', '.et_pb_slide', function() {
    // console.log("click");
    window.location.href = jQuery(this).find('a').attr('href');
});

/*redimensionar video home*/

redimensionarVideo();



/*slick product-slider*/

if (jQuery("body").is(".rtl")) {
    directionslider = true;
} else {
    directionslider = false;
}

jQuery('.product-slider .product-list').slick({
    rtl: directionslider,
    slide: '.hentry',
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 2,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: false,
                arrows: true
            }
        }, {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: false,
                arrows: true
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                arrows: true
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});

/*slick related-slider*/

if (jQuery("body").is(".rtl")) {
    directionslider = true;
} else {
    directionslider = false;
}

jQuery('.related-product-slider .product-list').slick({
    rtl: directionslider,
    slide: '.hentry',
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 2,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false,
                arrows: true
            }
        }, {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: false,
                arrows: true
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                arrows: true
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});


jQuery('.recipe-slider').slick({
    rtl: directionslider,
    slide: '.recipe',
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: false,
                arrows: true
            }
        }, {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: false,
                arrows: true
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                arrows: true
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});

/*----- PRODUCTOS -------*/

//tabs products
//https://dobsondev.com/2014/11/12/simple-jquery-tabs/
jQuery('.tabs-menu li:first-child').addClass('active');
jQuery('.tab-content').hide();
jQuery('.tab-content:first').show();

// Click function
jQuery('.tabs-menu li a').click(function() {
    jQuery('.tabs-menu li').removeClass('active');
    jQuery(this).parent().addClass('active');
    jQuery('.tab-content').hide();

    setTimeout(function() {
        jQuery('#product-accesories-slider .product-list').slick('setPosition'); //reset position slider
    }, 100);

    var activeTab = "#" + jQuery(this).data('tab');

    if (activeTab == "#undefined") {
        activeTab = "#" + jQuery(this).attr('class');
    }

    jQuery(activeTab).fadeIn();
    /*
    console.log(jQuery(activeTab).offset().top);
    jQuery('html, body').animate({
        scrollTop: jQuery(activeTab).offset().top - 150
    }, 1000);
    */
    return false;
});

//tabs search
jQuery('.tabs-menu-search li a').click(function() {

    jQuery('.tabs-menu-search li').removeClass('active');
    jQuery(this).parent().addClass('active');
    jQuery('.tab-content-search').hide();

    var activeTab = "#" + jQuery(this).data('tab');
    if (activeTab == "#undefined") {
        activeTab = "#" + jQuery(this).attr('class');
    }
    jQuery(activeTab).fadeIn();

    jQuery('.tab-content-search h2').fadeTo("fast", 0);
    jQuery('.tab-content-search h2').css("padding", "0");

    return false;
});



//tabs awards
jQuery('.tabs-awards-menu li a').click(function() {
    jQuery('.tabs-awards-menu li').removeClass('active');
    jQuery(this).parent().addClass('active');
    jQuery('.award').hide();

    var activeTab = "." + jQuery(this).data('tab');
    //console.log(activeTab);
    jQuery(activeTab).fadeIn();

    return false;
});


//sticky product menu
/*
jQuery(document).ready(function() {
    if (jQuery("#product-menu")[0]) {
        //https://www.w3schools.com/howto/howto_js_navbar_sticky.asp
        // When the user scrolls the page, execute stickyProductMenu
        window.onscroll = function() { stickyProductMenu() };
        navbar = jQuery("#product-menu");
        sticky = navbar.offset();
        console.log(sticky);
    }
});
*/
function stickyProductMenu() {
    if (window.pageYOffset >= sticky.top - jQuery("#top-header").height() - jQuery("#main-header").height() - jQuery("#wpadminbar").height() - navbar.height()) {
        navbar.addClass("sticky");
        jQuery("#product-top").css("margin-bottom", navbar.height() + "px");
    } else {
        navbar.removeClass("sticky");
        jQuery("#product-top").css("margin-bottom", "0px");
    }
}

jQuery(document).ready(function() {
    jQuery('#product-icons img').tooltipster({
        theme: ['tooltipster-noir', 'tooltipster-noir-customized'],
        arrow: false,
        side: ['bottom', 'top', 'right', 'left'],
        distance: -5,
    });
    jQuery('.product-list-colors img').tooltipster();

    //ficha producto - cambiamos el nombre del color al pasar por encima
    jQuery(document).on("mouseenter", "#product-top .other-colors img", function() {
        jQuery(".current-color").html(jQuery(this).data("color"));
    });

    jQuery(document).on("mouseleave", "#product-top .other-colors", function() {
        jQuery(".current-color").html(jQuery(".product-colors > img").data("color"));
    });

});
/*
jQuery('body').on('mouseenter', '.tooltip:not(.tooltipstered)', function(){
    console.log("tooltipster");
    jQuery(this).tooltipster();
});
*/
jQuery('#select-manual-download').select2();

function select2Bandera(state) {
    if (!state.id) {
        return state.text;
    }
    var originalOption = state.element;

    return jQuery("<span><img style='width:25px;height:25px' class='flag' src='/wp-content/themes/kuppersbusch/img/paises/" + jQuery(originalOption).data('bandera') + ".svg' alt='" + state.text + "' /><label style='font-weight: bold;    padding: 0 50px;    font-size: x-large;    line-height: 25px;    vertical-align: top;    color: darkslategray;'>" + state.text + "</label></span>");
}
jQuery('#hreflangSelector').select2({
    templateResult: select2Bandera
});

//FAQ
jQuery(document).ready(function() {


    if(typeof selectATopic !== 'undefined') {
        jQuery("#select-faq").select2({
            placeholder: selectATopic,
            ajax: {
                url: home_uri + 'wp-json/wp/v2/faq_cat?parent=0&per_page=100',
                dataType: "json",
                type: "GET",
                delay: 250,
                cache: true,
                data: function (params) {

                    var queryParameters = {
                        search: params.term,
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: jQuery.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.link
                            }
                        })
                    };
                }
            }
        });
    }


    jQuery("#select-faq").on('change', function() {
        window.location.href = this.value;
    });

    if(typeof selectATopic !== 'undefined') {
        jQuery("#select-noticias").select2({
            placeholder: selectATopic,
            ajax: {
                url: home_uri + 'wp-json/wp/v2/categories/?parent=' + cat_news,
                dataType: "json",
                type: "GET",
                delay: 250,
                cache: true,
                data: function (params) {

                    var queryParameters = {
                        search: params.term
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: jQuery.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.link
                            }
                        })
                    };
                }
            }
        });
    }


    jQuery("#select-noticias").on('change', function() {
        window.location.href = this.value;
    });

    if(typeof modelOrSerialNumber !== 'undefined') {
        //SUPPORT - select de garantías
        jQuery("#select-garantia").select2({
            placeholder: modelOrSerialNumber,
            width: '100%',
            language: {
                noResults: function () {
                    return writeSomething;
                }
            },
            ajax: {
                url: home_uri + 'ajax-search-products/',
                dataType: "json",
                type: "GET",
                delay: 250,
                cache: true,
                data: function (params) {

                    var queryParameters = {
                        search: params.term,
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: jQuery.map(data, function (item) {
                            return {
                                text: item.name + " - " + item.reference,
                                id: item.name
                            }
                        })
                    };
                }
            }
        });
    }

    jQuery("#select-garantia").on('change', function() {
        this.closest("form").submit();
    });



    //SUPPORT - select de manuales

    var select_manual_enterPressed = false;
    var select_manual_searchTerm = '';

    console.log("manuales");
    //SUPPORT - select de manuales
    jQuery("#select-manual").select2({
        placeholder: modelOrSerialNumber,
        width: '100%',
        //dropdownParent: jQuery('#form-manual-container'),
        language: {
            noResults: function () {
                return writeSomething;
            }
        },
        ajax: {
            url: function (params) {
                return home_uri + 'wp-json/functions/v1/search/manuals/';
                //return home_uri + 'wp-json/functions/v1/search/manuals/' + params.term;
            },
            dataType: "json",
            type: "GET",
            delay: 250,
            cache: true,
            data: function (params) {
                select_manual_searchTerm = params.term;
                var queryParameters = {
                    search: params.term,
                }
                return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: jQuery.map(data, function (item) {
                        return {
                            text: item.name + " - " + item.reference,
                            id: item.reference
                        }
                    })
                };
            }
        }
    });

    jQuery("#select-manual").on('select2:open', function () {
        jQuery('.select2-search__field').on('keydown', function (e) {
            if (e.keyCode === 13) { // Detectar tecla ENTER
                e.preventDefault(); // Evitar comportamiento por defecto
                select_manual_enterPressed = true;
            }
        });
    });
    jQuery("#select-manual").on('select2:closing', function (e) {
        setTimeout(function () { // Para que se maneje después del keydown
            if (select_manual_enterPressed) {
                e.preventDefault(); // Evitar cierre de Select2
                var option = new Option(select_manual_searchTerm, select_manual_searchTerm, true, true);
                jQuery("#select-manual").append(option).trigger('change'); // Agregar y seleccionar opción
                jQuery(this).closest("form").submit(); // Enviar formulario
                select_manual_enterPressed = false; // Resetear la bandera
            }
        }, 1);
    });
    jQuery("#select-manual").on('change', function () {
        this.closest("form").submit();
    });
    // Agregar controlador de eventos para el botón de lupa
    jQuery("#input-manual-submit").on('click', function (e) {
        e.preventDefault(); // Evitar comportamiento por defecto
        if (select_manual_searchTerm != "") {
            var option = new Option(select_manual_searchTerm, select_manual_searchTerm, true, true);
            jQuery("#select-manual").append(option).trigger('change'); // Agregar y seleccionar opción
            jQuery("#select-manual").closest("form").submit(); // Enviar formulario
        }

    });

    //Warranty registration
    if(typeof selectATopic !== 'undefined') {
        jQuery("#form-warranty-product").select2({
            placeholder: selectATopic
            /*,
            ajax: {
                url: home_uri + 'wp-json/wp/v2/product_cat/',
                dataType: "json",
                type: "GET",
                delay: 250,
                cache: true,
                data: function(params) {

                    var queryParameters = {
                        search: params.term
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: jQuery.map(data, function(item) {
                            return {
                                text: item.acf.name,
                                id: item.name
                            }
                        })
                    };
                }
            }*/
        });
    }
    if(typeof modelOrSerialNumber !== 'undefined') {
        jQuery("#form-warranty-model").select2({
            placeholder: modelOrSerialNumber,
            language: {
                noResults: function () {
                    return writeSomething;
                }
            },
            ajax: {
                url: home_uri + 'ajax-search-products/',
                dataType: "json",
                type: "GET",
                delay: 250,
                cache: true,
                data: function (params) {

                    var queryParameters = {
                        search: params.term,
                    }
                    return queryParameters;
                },
                processResults: function (data) {
                    return {
                        results: jQuery.map(data, function (item) {
                            return {
                                text: item.name + " - " + item.reference,
                                id: item.reference
                            }
                        })
                    };
                }
            }
        });
    }

    //Si recibimos un parámetro GET con el producto lo mostramos.
    var c = getUrlParameter('garantia');

    //console.log(c);

    var data = {
        id: c,
        text: c
    }

    var newOption = new Option(data.text, data.id, false, false);
    jQuery('#form-warranty-model').append(newOption).trigger('change');
    jQuery('#form-warranty-model').val(c).trigger('change');

    //menu
    jQuery(".sub-menu-support").appendTo(".menu-support");
    jQuery(".sub-menu-support").css("height", jQuery(".menu-support .sub-menu").outerHeight());

    ShowBack();

    jQuery(".link-back").on("click", function(event) {
        backClick();
        event.preventDefault();
    });
    jQuery(".add-product-compare").on("click", function(event) {
        backClick();
        event.preventDefault();
    });

    jQuery('b[role="presentation"]').hide();
    jQuery('.select2-selection__arrow').append('<i class="itk-flecha-abajo-filtros"></i>');



    //categorias
    if (jQuery("#products-header-img > video").length) {
        resizeCatVideos();
    }

    //ABOUT TEKA - WORLDWIDE - CARGAR PUNTOS EN EL MAPA
    if (jQuery("#worldwide-map").length) {
        console.log("worldwide");
        /*
        for (var key in worldwidePoints) {
            if (!worldwidePoints.hasOwnProperty(key)) continue;

            var obj = worldwidePoints[key];
            var id = key.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '').replace(/ /g, '');

            var texto_mail = "";

            var mail = obj['mail'];
            var top = obj['top'];
            var left = obj['left'];
            var address = obj['address'];

            if (!(!mail || /^\s*$/.test(mail))) {
                texto_mail = "<p>" + textMail + ":<br><a href='mailto:" + obj['mail'] + "'>" + obj['mail'] + "</a></p>";
            }

            jQuery("#worldwide-map").prepend("<div class='worldwide-point worldwide-" + id + "' style='top: " + top + "px; left: " + left + "px'><div><i class='itk-cross'></i><h4>" + key + "</h4><p>" + address + "</p>" + texto_mail + "</div></div>");
        }
        */
    }

    jQuery(".worldwide-point").on("click", function(event) {
        jQuery("#worldwide-map .worldwide-point").not(this).removeClass("active");
        jQuery(this).toggleClass("active");
    });

    //click en cualquier parte del slider de portada
    jQuery("#worldwide-map").on('click', '.worldwide-point i', function(e) {
        jQuery(this).closest(".worldwide-point").removeClass("active");
        e.preventDefault();
    });

    //mostrar filtros
    jQuery("#seeMoreFilters").click(function(e) {
        showAllFilters();
        e.preventDefault();
    });
    jQuery("#seeLessFilters").click(function(e) {
        hideFilters();
        e.preventDefault();
    });

    //INPUT FILE
    jQuery('.file-label [type=file]').on('change', function updateFileName(event) {
        //jQuery('.file-label [type=file]').on('click', function updateFileName(event) {
        var input = jQuery(this);

        setTimeout(function delayResolution() {
            input.closest('.file-label').find('.file-container span').text(input.val().replace(/([^\\]*\\)*/, ''))
        }, 100)
    });
});

jQuery(window).resize(function() {
    redimensionarVideo();
    if (jQuery("#products-header-img > video").length) {
        resizeCatVideos();
    }
});

function posicionarSubMenu() {
    var altura_del_header = jQuery('.et_pb_fullwidth_section.et_pb_section_0').outerHeight(true);
    var altura_del_menu = jQuery('#sub-menu').outerHeight(true);

    if (jQuery(window).scrollTop() >= altura_del_header) {
        jQuery('#sub-menu').addClass('fixed');
        jQuery('#sub-menu').next().css('margin-top', (altura_del_menu) + 'px');
    } else {
        jQuery('#sub-menu').removeClass('fixed');
        jQuery('#sub-menu').next().css('margin-top', '0');
    }
}

function posicionarFiltros() {
    var altura_del_header = jQuery('.et_pb_fullwidth_section.et_pb_section_0').outerHeight(true);
    var altura_del_menu = jQuery('.et_pb_portfolio_filters').outerHeight(true);

    altura_del_header = altura_del_header + 97;

    if (jQuery(window).scrollTop() >= altura_del_header) {
        jQuery('.et_pb_portfolio_filters').addClass('fixed');
        jQuery('.et_pb_portfolio_filters').next().css('margin-top', (altura_del_menu) + 'px');
    } else {
        jQuery('.et_pb_portfolio_filters').removeClass('fixed');
        jQuery('.et_pb_portfolio_filters').next().css('margin-top', '0');
    }
}

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

function clickMenuProyecto() {
    var cat_project = getUrlParameter('cat-project');
    if (cat_project) {
        console.log(cat_project);
        jQuery(".et_pb_portfolio_filters li:nth-child(" + cat_project + ") > a").trigger("click");
    }

}

//modificamos video vimeo
function autoLoadVideo() {
    jQuery('.fluid-width-video-wrapper iframe').each(function() {
        jQuery(this).attr('src', jQuery(this).attr('src') + "?loop=1&autopause=0");
    });
    jQuery('#home-video-presentation iframe').each(function() {
        //jQuery(this).attr('src',jQuery(this).attr('src')+"&autoplay=1");
    });

    /*jQuery('.et_pb_video video').attr('webkitallowfullscreen','webkitallowfullscreen');
    jQuery('.et_pb_video video').attr('mozallowfullscreen','mozallowfullscreen');
    jQuery('.et_pb_video video').attr('allowfullscreen','allowfullscreen'); */

}

function backClick() {
    if (document.referrer.indexOf(home_uri) >= 0) {
        history.go(-1);
    }
    return false;
}

function ShowBack() {
    if (document.referrer.indexOf(home_uri) >= 0) {
        jQuery(".link-back").show();
    }
    return false;
}

function resizeCatVideos() {
    jQuery("#products-header-img").css("height", jQuery("#products-header-img > video").height());
}

function redimensionarVideo() {
    $wWidth = jQuery(window).width();
    $wHeight = jQuery(window).height();

    var video = jQuery("#home-video-presentation iframe");
    video.css("max-width", "none");

    if ($wWidth / $wHeight > 1.7777) {
        //console.log("vertical");
        $vWidth = $wWidth;
        $vHeight = $wWidth / 1.7777;

        video.width($vWidth);
        video.height($vHeight);
        video.css("margin-top", -($vHeight - $wHeight) / 2);
        video.css("margin-left", 0);

    } else {
        //console.log("horizontal");
        $vWidth = $wHeight * 1.7777;
        $vHeight = $wHeight;

        video.width($vWidth);
        video.height($vHeight);
        video.css("margin-top", 0);
        video.css("margin-left", -($vWidth - $wWidth) / 2);
    }


    //console.log("ventana " + $wWidth + "x" + $wHeight);
    //console.log("video   " + $vWidth + "x" + $vHeight);
}

jQuery('#ajaxSearch').on('input', function(e) {
    var value = jQuery(this).val();
    if (value.length > 1) {
        ajaxSearch(value);
        jQuery("#ajaxSearchResult").show();
    } else {
        jQuery("#ajaxSearchResult").hide();
    }
});

function ajaxSearch(search) {
    var parent_product = parent_product;
    //console.log(search);

    jQuery.ajax({
        url: home_uri + 'wp-admin/admin-ajax.php',
        type: 'post',
        data: {
            action: 'search_products',
            search: search
        },
        beforeSend: function(xhr) {
            //filter.find('button').text('Processing...'); // changing the button label
            jQuery("#ajaxSearchProducts > div").fadeTo("fast", 0.2);
        },
        success: function(response) {
            jQuery("#ajaxSearchProducts").show();
            jQuery("#ajaxSearchProducts").addClass("active");
            jQuery("#ajaxSearchProducts > div").html(response); // insert data
            jQuery("#ajaxSearchProducts > div").fadeTo("slow", 1);
        }
    });

    jQuery.ajax({
        url: home_uri + 'wp-admin/admin-ajax.php',
        type: 'post',
        data: {
            action: 'search_news',
            search: search
        },
        beforeSend: function(xhr) {
            //filter.find('button').text('Processing...'); // changing the button label
            jQuery("#ajaxSearchNews > div").fadeTo("fast", 0.2);
        },
        success: function(response) {
            jQuery("#ajaxSearchNews").show();
            jQuery("#ajaxSearchNews").addClass("active");
            jQuery("#ajaxSearchNews > div").html(response); // insert data
            jQuery("#ajaxSearchNews > div").fadeTo("slow", 1);
        }
    });

    jQuery.ajax({
        url: home_uri + 'wp-admin/admin-ajax.php',
        type: 'post',
        data: {
            action: 'search_inspiration',
            search: search
        },
        beforeSend: function(xhr) {
            //filter.find('button').text('Processing...'); // changing the button label
            jQuery("#ajaxSearchInspiration > div").fadeTo("fast", 0.2);
        },
        success: function(response) {
            jQuery("#ajaxSearchInspiration").show();
            jQuery("#ajaxSearchInspiration").addClass("active");
            jQuery("#ajaxSearchInspiration > div").html(response); // insert data
            jQuery("#ajaxSearchInspiration > div").fadeTo("slow", 1);
        }
    });

    jQuery.ajax({
        url: home_uri + 'wp-admin/admin-ajax.php',
        type: 'post',
        data: {
            action: 'search_manuals',
            search: search
        },
        beforeSend: function(xhr) {
            //filter.find('button').text('Processing...'); // changing the button label
            jQuery("#ajaxSearchManuals > div").fadeTo("fast", 0.2);
        },
        success: function(response) {
            jQuery("#ajaxSearchManuals").show();
            jQuery("#ajaxSearchManuals").addClass("active");
            jQuery("#ajaxSearchManuals > div").html(response); // insert data
            jQuery("#ajaxSearchManuals > div").fadeTo("slow", 1);
        }
    });

    jQuery.ajax({
        url: home_uri + 'wp-admin/admin-ajax.php',
        type: 'post',
        data: {
            action: 'search_product_cat',
            search: search
        },
        beforeSend: function(xhr) {
            //filter.find('button').text('Processing...'); // changing the button label
            jQuery("#ajaxSearchProductCat > div").fadeTo("fast", 0.2);
        },
        success: function(response) {
            jQuery("#ajaxSearchProductCat").show();
            jQuery("#ajaxSearchProductCat").addClass("active");
            jQuery("#ajaxSearchProductCat > div").html(response); // insert data
            jQuery("#ajaxSearchProductCat > div").fadeTo("slow", 1);
        }
    });

    setTimeout(function() {
        if (jQuery("#ajaxSearchResult .active").length == 0) {
            jQuery("#ajaxSearchNoResult").show();
        } else {
            jQuery("#ajaxSearchNoResult").hide();
        }
    }, 1000);


}

function removeRandomHomeSlide() {
    /*
    // Desktop/Tablet Slider
    $numSlides = jQuery("#home-slider .et_pb_fullwidth_slider_0 .et_pb_slide").length;

    var min = 0;
    var max = $numSlides - 1;
    // and the formula is:
    var randomSlideDelete = Math.floor(Math.random() * (max - min + 1)) + min;

    for (i = 0; i <= $numSlides; i++) {
        if (i != randomSlideDelete) {
            jQuery("#home-slider .et_pb_fullwidth_slider_0 .et_pb_slide_" + i).remove();
            jQuery("#home-slider .et_pb_fullwidth_slider_1 .et_pb_slide_" + (i + $numSlides)).remove();
        }
    }
*/
    setTimeout(function() {
        jQuery("#home-slider").fadeTo("fast", 1, function() {});
    }, 500);

}


function showAllFilters() {
    jQuery('.product-filter.filterActive').show();
    jQuery('#seeMoreFilters').hide();
    jQuery('#seeLessFilters').css("display", "block");

}

function hideFilters() {
    //jQuery('.product-filter.filterActive').show();
    jQuery('#seeMoreFilters').css("display", "block");
    jQuery('#seeLessFilters').hide();
    showOnly4Filters();

}

function showOnly4Filters() {
    var i = 0;
    jQuery('.product-filter.filterActive').each(function(i1, obj) {
        i++;
        if (i1 > 3) {
            jQuery(this).hide();
        }
    });
    if (i <= 4) {
        jQuery('#seeMoreFilters').hide();
        jQuery('#seeLessFilters').hide();
    } else {
        jQuery('#seeMoreFilters').css("display", "block");
    }
}

//jQuery('#lighboxCountries > ul:not(:first)').hide();
jQuery('#lighboxCountries > ul').each(function() {
    if (jQuery(this).css("display") === 'flex') {
        jQuery(this).prev().toggleClass("active");
    }
});

jQuery('#lighboxCountries > a').click(function() {
    var self = jQuery(this);

    self.toggleClass("active");

    var accordionContent = self.next('ul');
    //accordionContent.slideToggle("slow");
    accordionContent.slideToggle('medium', function() {
        //if ($(this).is(':visible'))
        //    $(this).css('display', 'flex');
    });

    return false;
});

// Menu producto responsive
jQuery('#product-menu-main-cat-mobile').click(function() {
    if (jQuery('#product-menu-left ul').css("display") === 'none') {
        jQuery('#product-menu-main-cat-mobile').addClass('open');
        jQuery('#product-menu-left ul').css('display', 'block');
    } else {
        jQuery('#product-menu-main-cat-mobile').removeClass('open');
        jQuery('#product-menu-left ul').css('display', 'none');
    }

    return false;
});

// Filtros producto responsive
jQuery('.products-filters-title-mobile').click(function() {
    if (jQuery('.products-filters-title-mobile').hasClass('open')) {
        jQuery('.products-filters-title-mobile').removeClass('open');
        jQuery('#products-filters-mobile>div').removeClass('important');
    } else {
        jQuery('.products-filters-title-mobile').addClass('open');
        jQuery('#products-filters-mobile>div').addClass('important');
    }

    return false;
});

jQuery(window).resize(function() {

    if (jQuery(window).width() > 981) {
        jQuery('#product-menu-left ul').css('display', 'block');
    }
    if (jQuery(window).width() <= 981) {
        jQuery('#product-menu-left ul').css('display', 'none');
    }
});

// Product menu horizontal scroll
jQuery(document).ready(function() {
    // duration of scroll animation
    var scrollDuration = 300;
    // paddles
    var leftPaddle = document.getElementsByClassName('left-paddle');
    var rightPaddle = document.getElementsByClassName('right-paddle');
    // get items dimensions
    var itemSize = 0;
    jQuery('#product-menu ul li').each(function() {
        var $this = jQuery(this);
        itemSize += $this.outerWidth(true);
    });
    // get some relevant size for the paddle triggering point
    var paddleMargin = 0;

    // get wrapper width
    var getMenuWrapperSize = function() {
        return jQuery('#product-menu .et_pb_text_inner').outerWidth();
    }
    var menuWrapperSize = getMenuWrapperSize();

    // the wrapper is responsive
    jQuery(window).on('resize', function() {
        menuWrapperSize = getMenuWrapperSize();
        menuVisibleSize = menuWrapperSize;
        menuInvisibleSize = menuSize - menuWrapperSize;

        if (menuInvisibleSize <= 20) {
            jQuery(rightPaddle).addClass('hidden');
            jQuery(leftPaddle).addClass('hidden');
        } else {
            jQuery(rightPaddle).removeClass('hidden');
        }
    });
    // size of the visible part of the menu is equal as the wrapper size
    var menuVisibleSize = menuWrapperSize;

    // get total width of all menu items
    var getMenuSize = function() {
        return itemSize;
    };
    var menuSize = getMenuSize();

    // get how much of menu is invisible
    var menuInvisibleSize = menuSize - menuWrapperSize;

    // get how much have we scrolled to the left
    var getMenuPosition = function() {
        return jQuery('#product-menu ul').scrollLeft();
    };

    if (menuInvisibleSize <= 0) {
        jQuery(rightPaddle).addClass('hidden');
    }

    // finally, what happens when we are actually scrolling the menu
    jQuery('#product-menu ul').on('scroll', function() {

        // get how much of menu is invisible
        menuInvisibleSize = menuSize - menuWrapperSize;
        // get how much have we scrolled so far
        var menuPosition = getMenuPosition();

        var menuEndOffset = menuInvisibleSize - paddleMargin;

        // show & hide the paddles
        // depending on scroll position
        if (menuPosition <= paddleMargin) {
            jQuery(leftPaddle).addClass('hidden');
            jQuery(rightPaddle).removeClass('hidden');
        } else if (menuPosition < menuEndOffset) {
            // show both paddles in the middle
            jQuery(leftPaddle).removeClass('hidden');
            jQuery(rightPaddle).removeClass('hidden');
        } else if (menuPosition >= menuEndOffset) {
            jQuery(leftPaddle).removeClass('hidden');
            jQuery(rightPaddle).addClass('hidden');
        }

    });

    // scroll to left
    jQuery(rightPaddle).on('click', function() {
        jQuery('#product-menu ul').animate({
            scrollLeft: menuInvisibleSize + 20
        }, scrollDuration);
    });

    // scroll to right
    jQuery(leftPaddle).on('click', function() {
        jQuery('#product-menu ul').animate({
            scrollLeft: '0'
        }, scrollDuration);
    });
});

jQuery(document).ready(function() {
    if (jQuery(location.hash).offset() != null) {
        jQuery('html,body').animate({
            scrollTop: jQuery(location.hash).offset().top
        }, 1800);
    }
});

//console.log("Teka.com");
if (typeof country_redirector_redirect === 'function') {
    var _country_redirector_redirect = country_redirector_redirect;
    country_redirector_redirect = function(r) {
        if ('null' != r) {
            if (r.includes('other_country')) {
                $("#footer-idioma>a").trigger("click");
            } else {
                _country_redirector_redirect(r);
            }
        }
    }
}
const observer = lozad();
observer.observe();

//reproductor
jQuery(".video .play").click(function(e) {
    e.preventDefault();
    loadReproductor(jQuery(this).data('video'));
});

jQuery(function() {
    jQuery(".close").on("click", function() {
        jQuery('#player-container').removeClass("show");
        jQuery('body').removeClass("playeron");
        jQuery("#player")[0].src = "about:blank";
        if (!jQuery.browser.mobile) {
            jQuery.fullscreen.exit();
        }
    });

    jQuery("#player-container").on("fscreenclose", function() {
        jQuery('#player-container').removeClass("show");
        jQuery('body').removeClass("playeron");
        jQuery("#player")[0].src = "about:blank";
        if (!jQuery.browser.mobile) {
            jQuery.fullscreen.exit();
        }
    });

});

//https://github.com/radiovisual/get-video-id/blob/master/index.js
function getYoutubeVideoID(str) {
    // shortcode
    var shortcode = /youtube:\/\/|https?:\/\/youtu\.be\/|http:\/\/y2u\.be\//g;

    if (shortcode.test(str)) {
        var shortcodeid = str.split(shortcode)[1];
        return stripParameters(shortcodeid);
    }

    // /v/ or /vi/
    var inlinev = /\/v\/|\/vi\//g;

    if (inlinev.test(str)) {
        var inlineid = str.split(inlinev)[1];
        return stripParameters(inlineid);
    }

    // v= or vi=
    var parameterv = /v=|vi=/g;

    if (parameterv.test(str)) {
        var arr = str.split(parameterv);
        return arr[1].split('&')[0];
    }

    // v= or vi=
    var parameterwebp = /\/an_webp\//g;

    if (parameterwebp.test(str)) {
        var webp = str.split(parameterwebp)[1];
        return stripParameters(webp);
    }

    // embed
    var embedreg = /\/embed\//g;

    if (embedreg.test(str)) {
        var embedid = str.split(embedreg)[1];
        return stripParameters(embedid);
    }

    // ignore /user/username pattern
    var usernamereg = /\/user\/([a-zA-Z0-9]*)$/g;

    if (usernamereg.test(str)) {
        return undefined;
    }

    // user
    var userreg = /\/user\/(?!.*videos)/g;

    if (userreg.test(str)) {
        var elements = str.split('/');
        return stripParameters(elements.pop());
    }

    // attribution_link
    var attrreg = /\/attribution_link\?.*v%3D([^%&]*)(%26|&|$)/;

    if (attrreg.test(str)) {
        return str.match(attrreg)[1];
    }
}

function stripParameters(str) {
    // Split parameters or split folder separator
    if (str.indexOf('?') > -1) {
        return str.split('?')[0];
    } else if (str.indexOf('/') > -1) {
        return str.split('/')[0];
    }
    return str;
}


function loadReproductor(urlVideo) {
    jQuery('#player-container').addClass("show");
    jQuery('body').addClass("playeron");

    jQuery("#player")[0].src = "https://www.youtube.com/embed/" + getYoutubeVideoID(urlVideo) + "?wmode=opaque&feature=oembed&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&autoplay=1";
    if (!jQuery.browser.mobile) {
        jQuery('#player-container').fullscreen();
    }
    jQuery('.close').show();

}
//

jQuery(document).ready(function() {
    jQuery('.open_fullscreen').on('click', function(e) {
        e.preventDefault();

        loadReproductor(jQuery(this).attr("href"));

        /*
        var video = jQuery(this).attr("href");
        video = video.replace("watch?v=", "embed/");
        video = video + "?wmode=opaque&feature=oembed&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&autoplay=1";

        var timestamp = new Date().getUTCMilliseconds();
        var id = 'iframe' + timestamp;
        jQuery(this).parent().append('<iframe id="' + id + '" style="position: fixed; z-index:9999999;top:0;width:100%" src="' + video + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen"></iframe>');
        jQuery(this).data("iframeid", id);




        jQuery("#" + id).on("fscreenclose", function() {
            jQuery(this)[0].src = "about:blank"
            jQuery(this).hide();
            jQuery(this).remove();
        });

        jQuery("#" + id).show();
        const target = $("#" + id)[0]; // Get DOM element from jQuery collection
        jQuery("#" + id).fullscreen();
        */

    });
});



/* Botón cerrar en acordeón */

jQuery(document).ready(function() {

    setTimeout(function(){
        jQuery('.et_pb_slide_image img').each(function(){
            jQuery(this).attr('loading','');
        });
    }, 3000);


    jQuery(function($){
        $('.et_pb_toggle_title').click(function(){
            var $toggle = $(this).closest('.et_pb_toggle');
            if (!$toggle.hasClass('et_pb_accordion_toggling')) {
              var $accordion = $toggle.closest('.et_pb_accordion');
              if ($toggle.hasClass('et_pb_toggle_open')) {
                $accordion.addClass('et_pb_accordion_toggling');
                $toggle.find('.et_pb_toggle_content').slideToggle(700, function() {
                  $toggle.removeClass('et_pb_toggle_open').addClass('et_pb_toggle_close');

                });
              }
              setTimeout(function(){
                $accordion.removeClass('et_pb_accordion_toggling');
              }, 750);
            }
        });

        var $body_custom = $('body');
        var $search_outer_custom = $('.et_search_outer_custom');
        var $search_container_custom = $('.et_search_form_container_custom');

        $('#et_top_search_custom').click(function () {
            $body_custom.addClass('__active');
            $search_outer_custom.addClass('__active');
            $search_container_custom.find('input').focus();
        });

        $('.et_close_search_field_custom').click(function (e) {
            e.preventDefault();
            $('input.orig').blur().val('');
            $('input.autocomplete').blur().val('');
            $('div.asp_r.vertical').css({ 'opacity' : 0, 'display' : 'none', 'visibility' : 'hidden' });
            $body_custom.removeClass('__active');
            $search_outer_custom.removeClass('__active');
        });
        $('.et_search_outer_custom').bind({
            'click' :   function (e) {
                e.stopPropagation();
                e.preventDefault();
            }
        })






    });
});

var tekaCurrencySymbol = tekaCurrencySymbol || '€';
var tekaCurrencySymbolPosition = tekaCurrencySymbolPosition || 'right';
var tekaPriceDecimals = tekaPriceDecimals || 0;

function formatPrice(pvpr) {
    // Convertir pvpr a string para asegurar que el método indexOf funcione
    pvpr = pvpr.toString();

    // Determinar los decimales a utilizar
    var decimals = (pvpr.indexOf(".00") !== -1) ? 0 : (tekaPriceDecimals === 1 ? 2 : 0);

    // Formatear el número
    var formattedPvpr = Number(pvpr).toLocaleString('es-ES', {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals
    });

    // Agregar el símbolo de la moneda
    if (tekaCurrencySymbolPosition === "left") {
        return tekaCurrencySymbol + formattedPvpr;
    } else {
        return formattedPvpr + tekaCurrencySymbol;
    }
}
