/**
 * Service/Contact Page Template Scripts
 */

jQuery(document).ready(function($) {
    // Enable submit button when privacy checkbox is checked
    $('.wpcf7-acceptance input').on('change', function() {
        var submitBtn = $(this).closest('form').find('.wpcf7-submit');
        if ($(this).is(':checked')) {
            submitBtn.prop('disabled', false);
        } else {
            submitBtn.prop('disabled', true);
        }
    });
    
    // Form validation highlight
    $('.wpcf7-form-control').on('focus', function() {
        $(this).closest('label').addClass('focused');
    }).on('blur', function() {
        if ($(this).val() === '') {
            $(this).closest('label').removeClass('focused');
        }
    });
});