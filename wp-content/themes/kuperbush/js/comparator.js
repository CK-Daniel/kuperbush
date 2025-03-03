jQuery(window).on("load", function() {
    // Si cargamos en resolución baja cerramos por defecto el comparador
    //if (jQuery('.compare-label').is(':visible')) jQuery('.compare-label').click();
});

jQuery(document).ready(function() {

    // abrir/cerrar comparador
    jQuery('.compare-label').click(function() {
        jQuery('#compare-side-bar').toggleClass('show');
    });

    // MOSTRAR COMPARADOR SI HAY PRODUCTOS SELECCIONADOS PREVIAMENTE AL CARGAR
    var $compare_icons = jQuery('.product-list-compare .button-compare');

    if ($compare_icons.length) {
        // get category from first item
        var active_cat = $compare_icons.first().attr('data-compare-cat');
        if (Compare.getTotalProducts(active_cat)) {
            var showLabels = {
                'name': 'name',
                'id': 'id',
                'img': 'img'
            };

            var template = '<div class="compare-fluid-tab compare-fluid-tab-{id}"><a href="{id}"><img src="{img}"></a><p>{name}</p></div>';
            jQuery("#compare-side-bar .compare-list").html(Compare.parseTemplate(active_cat, template, showLabels));
            jQuery('.compare-fluid-tab').append('<div class="close-overlay"></div>');

            if (Compare.getTotalProducts(active_cat) > 1)
                jQuery('#compare-side-bar .compare-button').show();
            else
                jQuery('#compare-side-bar .compare-button').hide();

            jQuery("a.compare-button").on('click', function(e) {
                var params = Compare.parseCompareParams(active_cat);
                jQuery(this).attr('href', pageProductComparator + '/?' + params);
            });

            jQuery("#compare-side-bar").show();

            jQuery('[data-compare-id]').each(function() {
                var id = jQuery(this).data('compareId');
                if (Compare.exists(id)) jQuery(this).addClass('compare-added');
            });
        }
    }



    //AÑADIR PRODUCTOS AL CARRITO
    jQuery(document).on("click", '.product-list-compare .button-compare', function(e) {
        var $this = jQuery(this);


        if (!$this.hasClass('compare-added')) {
            if (Compare.getTotalProducts($this.attr('data-compare-cat')) <= 3) {
                var item = {
                    cat: $this.attr('data-compare-cat'),
                    name: $this.attr('data-compare-name'),
                    id: $this.attr('data-compare-id'),
                    img: $this.attr('data-compare-img')
                };
                Compare.add(item);
                $this.addClass("compare-added");
                // $this.parent().remove();

                var showLabels = {
                    'name': 'name',
                    'id': 'id',
                    'img': 'img'
                };

                var template = '<div class="compare-fluid-tab compare-fluid-tab-{id}"><a href="{id}"><img src="{img}"></a><p>{name}</p></div>';

                jQuery("#compare-side-bar .compare-list").html(Compare.parseTemplate($this.attr('data-compare-cat'), template, showLabels));

                jQuery('.compare-fluid-tab').append('<div class="close-overlay"></div>');
                // $this.next().addClass("activo");
                // $this.next().after( "<div id='overlay'></div>" );
                // $this.next().after( "<div id='close-overlay'></div>" );

                if (Compare.getTotalProducts($this.attr('data-compare-cat')) > 1)
                    jQuery('#compare-side-bar .compare-button').show();
                else
                    jQuery('#compare-side-bar .compare-button').hide();

                jQuery("a.compare-button").on('click', function(e) {
                    var params = Compare.parseCompareParams($this.attr('data-compare-cat'));
                    jQuery(this).attr('href', pageProductComparator + '/?' + params);
                    // e.preventDefault();
                });

                jQuery("#compare-side-bar").show();
            } else {
                jQuery.featherlight("#compare-max-reached");
            }
        } else {
            removeFromCompare($this.attr('data-compare-id'));
        }


    });

    jQuery(document).on("click", ".icon-share", function(e) {
        jQuery("#main-share-reference").addClass("activo");
        jQuery("#main-share-reference h2").text(jQuery(this).next().find(".get-reference").text());
        jQuery("#main-share-reference .descarga-referencia-asunto").val(jQuery(this).next().find(".get-reference").text());
        jQuery("#main-share-reference .descarga-referencia-mensaje").val(jQuery(this).next().find(".get-datasheet").text());
        jQuery("#main-share-reference").after("<div id='overlay'></div>");
        jQuery("#main-share-reference").after("<div id='close-overlay'></div>");
    });
    jQuery(document).on("click", ".icon-download", function(e) {
        jQuery(this).next().addClass("activo");
        jQuery(this).next().after("<div id='overlay'></div>");
        jQuery(this).next().after("<div id='close-overlay'></div>");
    });

    //ELIMINAR PRODUCTO DE VENTANA
    jQuery(document).on("click", ".compare-fluid-tab .close-overlay", function(e) {
        var id = jQuery(this).closest('.compare-fluid-tab').find('a').attr('href');
        removeFromCompare(id);
    });

    jQuery(document).on("click", ".compare-fluid-tab a", function(e) {
        e.preventDefault();
    });

    jQuery(document).on("click", ".wishlist-continuar-right", function(e) {
        jQuery("#response .activo").removeClass("activo");
        jQuery("#main-share-reference.activo").removeClass("activo");
        jQuery("#overlay").remove();
        jQuery("#close-overlay").remove();
        e.preventDefault();
    });

    function removeFromCompare(id) {
        Compare.remove(id);
        jQuery('[data-compare-id="' + id + '"]').removeClass('compare-added');
        jQuery('.compare-fluid-tab-' + id).remove();

        // console.log("length " + jQuery('.compare-list').find('.compare-fluid-tab').length);
        if (jQuery('.compare-list').find('.compare-fluid-tab').length > 1)
            jQuery('#compare-side-bar .compare-button').show();
        else
            jQuery('#compare-side-bar .compare-button').hide();

        if (!jQuery('.compare-list').find('.compare-fluid-tab').length) jQuery("#compare-side-bar").hide();
    }

});