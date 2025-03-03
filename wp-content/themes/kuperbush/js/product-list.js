jQuery(document).ready(function() {



    jQuery('#filter').on('change', 'input', function() {
        filtrar(jQuery("#filter"));
    });

    //cuando hacemos click en algún checkbox
    jQuery('#filter').on('change', 'input', function() {
        var selector = jQuery(this).data("selector");
        var value = jQuery(this).data("value");
        var id = jQuery(this).data("id");
        if (jQuery(this).is(':checked')) {
            jQuery("#profucts-filters-inline").append('<span id="' + selector + '-' + id + '" data-selector="' + selector + '" data-value="' + value + '" data-id="' + id + '">' + value + '</div>');
        } else {
            jQuery("#profucts-filters-inline #" + selector + '-' + id).remove();
        }

        jQuery(".product-filter-dropdown").hide();

        filterClass(selector);

        updateURL();

        showHideFiltersInline();
    });

    //cuando hacemos click en un type of appliance
    jQuery('#product-menu-left').on('change', 'input', function() {
        var selector = jQuery(this).data("selector");
        var value = jQuery(this).data("value");
        var id = jQuery(this).data("id");

        jQuery(".filter-type-of-appliance").attr("value", value);

        if (jQuery(this).is(':checked')) {
            jQuery("#profucts-filters-inline").append('<span id="' + selector + '-' + id + '" data-selector="' + selector + '" data-value="' + value + '" data-id="' + id + '">' + value + '</div>');
        } else {
            jQuery("#profucts-filters-inline #" + selector + '-' + id).remove();
        }

        cleanAllFilters();

        updateURL();

        showHideFiltersInline();

        filtrar(jQuery("#filter"));
    });

    //cuando eliminamos algún filtro desde los accesos directos
    jQuery('#profucts-filters-inline').on('click', "span", function() {
        //console.log("cerrar filtro linea");
        var selector = jQuery(this).data("selector");
        var value = jQuery(this).data("value");
        var id = jQuery(this).data("id");

        jQuery("#filter input[data-id='" + id + "']").attr("checked", false);
        jQuery(this).remove();

        filterClass(selector);

        showHideFiltersInline();

        filtrar(jQuery("#filter"));

        if( jQuery('#product-menu-main-cat-mobile').hasClass('open') ) {
            jQuery('#product-menu-main-cat-mobile').removeClass('open');
            jQuery('#product-menu-left ul').css('display', 'none');
        }
    });

    //eliminar todos los filtros
    jQuery('#profucts-filters-inline').on('click', "#reset-filter", function(e) {

        e.preventDefault();

        cleanAllFilters();

        filtrar(jQuery("#filter"));
    });

    //filtros productos
    jQuery('#products-filters').on('click', ".product-filter > h4", function(e) {

        var parent = jQuery(this).parent();

        jQuery(".product-filter > h4").not(this).parent().removeClass("open");
        parent.toggleClass("open");

        e.preventDefault();

    });
    //cerrar desplegable
    jQuery(".product-filter-dropdown > span").click(function(e) {
        jQuery(this).closest(".product-filter").removeClass("open");
        e.preventDefault();
    });

    //cuando hacemos hover en un producto, cargamos un color
    jQuery('.product-list').on('mouseenter', ".product:not(.color-listed)", function() {
        var este = jQuery(this);
        var img = este.find(".product-list-colors > img");

        if (img.length > 0) {
            var exclude = img.data("exclude");
            var parent_product = img.data("parent_product");

            //console.log("buscamos colores");
            if (parent_product) {
                cargarColores(este, exclude, parent_product);
            }
        }

        este.addClass("color-listed");


        /*
        var selector = jQuery(this).data("selector");
        var value = jQuery(this).data("value");
        var id = jQuery(this).data("id");

        jQuery("#filter input[data-id='"+id+"']").attr("checked",false);
        jQuery(this).remove();

        filterClass(selector);

        filtrar(jQuery("#filter"));
        */

    });
});

function filtrar($filter) {
    //console.log($filter);
    var filter = $filter;
    jQuery.ajax({
        url: filter.attr('action'),
        data: filter.serialize(), // form data
        type: filter.attr('method'), // POST
        beforeSend: function(xhr) {
            filter.find('button').text('Processing...'); // changing the button label
            jQuery('#filter select').prop('disabled', 'disabled');
            jQuery('#filter select').css("opacity", 0.5);
        },
        success: function(data) {
            filter.find('button').text('Apply filter'); // changing the button label back
            jQuery('#filter select').prop('disabled', false);
            jQuery('#filter select').css("opacity", 1);
            jQuery('.et_pb_ajax_pagination_container').html(data); // insert data
            jQuery('.et_pb_ajax_pagination_container').addClass("product-list"); // insert data
        }
    });

}

function filterClass(selector) {
    //console.log(selector);
    if (jQuery(".product-filter-" + selector + " input:checkbox:checked").length > 0) {
        jQuery(".product-filter-" + selector).addClass("checked");
    } else {
        jQuery(".product-filter-" + selector).removeClass("checked");
    }
}

function cargarFiltros(catId, excludes = null) {
    var catId = catId;

    jQuery.ajax({
        url: home_uri + 'wp-admin/admin-ajax.php',
        type: 'post',
        data: {
            action: 'cargar_filtros',
            catId: catId,
            excludes: excludes
        },
        beforeSend: function(xhr) {
            //filter.find('button').text('Processing...'); // changing the button label
            jQuery("#products-filters").fadeTo("slow", 0.3);
        },
        success: function(response) {
            jQuery("#products-filters").fadeTo("slow", 1);
            jQuery('#query-debug').html(response); // insert data
        }
    });
}

function cargarColores(producto, exclude, parent_product) {
    var parent_product = parent_product;

    jQuery.ajax({
        url: home_uri + 'wp-admin/admin-ajax.php',
        type: 'post',
        data: {
            action: 'cargar_colores',
            exclude: exclude,
            parent_product: parent_product
        },
        beforeSend: function(xhr) {
            //filter.find('button').text('Processing...'); // changing the button label
        },
        success: function(response) {
            producto.find(".other-colors").html(response); // insert data

            jQuery(".tooltip:not(.tooltipstered)").tooltipster();
        }
    });
}

function showHideFiltersInline() {
    if (jQuery("#profucts-filters-inline span").length == 0) {
        jQuery("#profucts-filters-inline").hide();
    } else {
        jQuery("#profucts-filters-inline").show();
    }
}

function cleanAllFilters() {


    jQuery("#profucts-filters-inline span").each(function(index) {
        jQuery(this).trigger("click");

        var selector = jQuery(this).data("selector");
        var value = jQuery(this).data("value");
        var id = jQuery(this).data("id");

        jQuery("#filter input[data-id='" + id + "']").attr("checked", false);
        jQuery(this).remove();

        filterClass(selector);

        //console.log( index + ": " + jQuery( this ).text() );
    });


    showHideFiltersInline();

}

function updateURL(){
            //cargar parámetros filtros por GET
        $url = location.protocol + '//' + location.host + location.pathname + "?" + jQuery(jQuery("#filter")[0].elements).not("#input_referencia_de_seccion, #input_filtrar_productos").serialize();
        history.pushState(null, null, $url);
}
