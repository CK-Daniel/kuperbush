/**
 * Debug script for form submission issues
 */
(function($) {
    'use strict';

    // Add event handler for all forms with the kuperbush-admin-form class
    $(document).ready(function() {
        console.log("✅ Kuperbush Save Debug Script Initialized");
        
        // Check if we have nonce fields
        $('.kuperbush-admin-form').each(function() {
            const form = $(this);
            const formId = form.attr('id') || 'unnamed-form';
            const nonceField = form.find('input[name="_wpnonce"]');
            const optionPageField = form.find('input[name="option_page"]');
            
            console.log(`Form ${formId} check:`, {
                hasNonce: nonceField.length > 0,
                nonceValue: nonceField.length > 0 ? nonceField.val() : 'MISSING',
                hasOptionPage: optionPageField.length > 0,
                optionPageValue: optionPageField.length > 0 ? optionPageField.val() : 'MISSING',
                actionUrl: form.attr('action'),
                method: form.attr('method')
            });
        });
        
        // Add click handler to all submit buttons
        $('.kuperbush-admin-submit-button').on('click', function(e) {
            const button = $(this);
            const form = button.closest('form');
            const currentTab = new URLSearchParams(window.location.search).get('tab') || 'general';
            
            console.log('===== FORM SUBMIT BUTTON CLICKED =====');
            console.log('Current tab:', currentTab);
            console.log('Button text:', button.val() || button.text());
            
            // Verify form has the necessary fields
            const criticalFields = ['_wpnonce', 'option_page', 'action', 'active_tab'];
            let missingFields = [];
            
            criticalFields.forEach(fieldName => {
                if (form.find(`input[name="${fieldName}"]`).length === 0) {
                    missingFields.push(fieldName);
                }
            });
            
            if (missingFields.length > 0) {
                console.error('CRITICAL: Form is missing required fields:', missingFields);
                
                // Try to add the fields
                console.log('Attempting to fix missing fields');
                
                if (!form.find('input[name="action"]').length) {
                    console.log('Adding action field');
                    form.prepend('<input type="hidden" name="action" value="options">');
                }
                
                if (!form.find('input[name="option_page"]').length) {
                    console.log('Adding option_page field');
                    form.prepend('<input type="hidden" name="option_page" value="kuperbush_options">');
                }
                
                if (!form.find('input[name="active_tab"]').length) {
                    console.log('Adding active_tab field');
                    form.prepend('<input type="hidden" name="active_tab" value="' + currentTab + '">');
                }
                
                if (!form.find('input[name="_wpnonce"]').length) {
                    console.log('CRITICAL: Cannot add valid nonce field via JavaScript');
                    // You'll need to fix this in PHP
                }
            } else {
                console.log('All required fields present in form');
            }
            
            // Print all form field values
            console.log('Form field values:');
            let formFields = {};
            form.find('input, select, textarea').each(function() {
                const field = $(this);
                const name = field.attr('name');
                if (name) {
                    formFields[name] = field.is(':checkbox') ? field.is(':checked') : field.val();
                }
            });
            console.log(formFields);
            
            // Note: We'll let the form submit normally
            console.log('Form submission will proceed...');
            console.log('===================================');
        });
    });
})(jQuery);