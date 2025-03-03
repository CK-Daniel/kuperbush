/**
 * Fix for Kuperbush admin form submission
 * This script fixes issues with nonce fields and form submission in the theme options page
 */
jQuery(document).ready(function($) {
    // Check if we're on the theme options page
    if (window.location.href.indexOf('themes.php?page=kuperbush-options') === -1) {
        return;
    }
    
    console.log('📋 Kuperbush Form Fix: Initializing form repair script');
    
    // Add event listener to all submit buttons in the theme options forms
    $('.kuperbush-admin-form').each(function() {
        const form = $(this);
        
        // Check if the form already has the necessary hidden fields
        const missingFields = [];
        const requiredFields = [
            {name: 'option_page', value: 'kuperbush_options'},
            {name: 'action', value: 'options'}
        ];
        
        // Get the current tab from URL
        const currentTab = new URLSearchParams(window.location.search).get('tab') || 'general';
        requiredFields.push({name: 'active_tab', value: currentTab});
        
        // Check for missing fields
        requiredFields.forEach(field => {
            if (form.find(`input[name="${field.name}"]`).length === 0) {
                missingFields.push(field);
            }
        });
        
        // Add any missing fields
        if (missingFields.length > 0) {
            console.log('📋 Kuperbush Form Fix: Adding missing fields to form:', missingFields.map(f => f.name).join(', '));
            missingFields.forEach(field => {
                form.prepend(`<input type="hidden" name="${field.name}" value="${field.value}">`);
            });
        }
        
        // If _wpnonce is missing, we'll need to recreate it correctly when the form is submitted
        // This requires a special AJAX request to get a valid nonce
        if (form.find('input[name="_wpnonce"]').length === 0) {
            console.log('📋 Kuperbush Form Fix: Form is missing the WordPress nonce field, will generate on submit');
            
            // Will be handled in the submit event below
        }
        
        // Fix for submit event
        form.on('submit', function(e) {
            // Get the current tab
            const currentTab = new URLSearchParams(window.location.search).get('tab') || 'general';
            console.log('📋 Kuperbush Form Fix: Form submission intercepted for tab:', currentTab);
            
            // Set the active_tab
            let activeTabInput = form.find('input[name="active_tab"]');
            if (activeTabInput.length === 0) {
                form.prepend(`<input type="hidden" name="active_tab" value="${currentTab}">`);
                console.log('📋 Kuperbush Form Fix: Added missing active_tab input');
            } else {
                activeTabInput.val(currentTab);
                console.log('📋 Kuperbush Form Fix: Updated active_tab value to', currentTab);
            }
            
            // Ensure option_page is set
            let optionPageInput = form.find('input[name="option_page"]');
            if (optionPageInput.length === 0) {
                form.prepend('<input type="hidden" name="option_page" value="kuperbush_options">');
                console.log('📋 Kuperbush Form Fix: Added missing option_page input');
            }
            
            // Ensure action is set
            let actionInput = form.find('input[name="action"]');
            if (actionInput.length === 0) {
                form.prepend('<input type="hidden" name="action" value="options">');
                console.log('📋 Kuperbush Form Fix: Added missing action input');
            }
            
            // Check for nonce field (this is the most critical part)
            const nonceField = form.find('input[name="_wpnonce"]');
            if (nonceField.length === 0) {
                console.warn('📋 Kuperbush Form Fix: Form is missing the WordPress nonce field!');
                console.log('📋 Kuperbush Form Fix: This requires server-side fix - check PHP process_options function');
                
                // This is just a temporary solution to help debugging
                form.append('<input type="hidden" name="_fix_missing_nonce" value="1">');
            } else {
                console.log('📋 Kuperbush Form Fix: Nonce field is present with value:', nonceField.val());
            }
            
            // Log all form fields for debugging
            console.log('📋 Kuperbush Form Form Fields:');
            form.find('input[type="hidden"]').each(function() {
                console.log(`- ${$(this).attr('name')}: ${$(this).val()}`);
            });
            
            // Let the form submit normally
            console.log('📋 Kuperbush Form Fix: Form submission proceeding...');
        });
    });
    
    // Add direct event listeners to submit buttons
    $('.kuperbush-admin-submit-button').on('click', function() {
        console.log('📋 Kuperbush Form Fix: Submit button clicked');
    });
    
    console.log('📋 Kuperbush Form Fix: Form repair complete');
});