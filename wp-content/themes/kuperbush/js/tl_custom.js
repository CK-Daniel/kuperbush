(function ($) {
    $('a[href*="#"]:not([href="#"]), .mobile_nav a').off();

    $('#footer-idioma-mobile, #footer-idioma-mobile a').bind({
        'click'     :   function(){
            console.log("2222");
        }
    })
})

