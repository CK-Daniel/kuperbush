/**
 * Kuperbush Admin JavaScript
 * Handles interactivity for the theme options page
 */
(function($) {
    'use strict';

    // Initialize admin page functionality
    const kuperbushAdmin = {
        /**
         * Initialize the admin interface
         */
        init: function() {
            this.setupTabNavigation();
            this.setupFormSubmission();
            this.setupToggleFields();
            this.setupBulkActions();
            this.preserveTabsOnSubmit();
            this.handleSuccessNotifications();
        },

        /**
         * Handle tab navigation
         */
        setupTabNavigation: function() {
            $('.kuperbush-admin-tab-link').on('click', function(e) {
                // Note: We're allowing default behavior for page refresh
                // This just adds some visual feedback before the page reloads
                $('.kuperbush-admin-tab').removeClass('active');
                $(this).parent('.kuperbush-admin-tab').addClass('active');
            });
        },

        /**
         * Preserve active tab when form is submitted
         */
        preserveTabsOnSubmit: function() {
            // Get the current tab from URL
            const currentTab = new URLSearchParams(window.location.search).get('tab') || 'general';
            
            // Update the active_tab hidden input value
            $('.kuperbush-admin-form').each(function() {
                const activeTabInput = $(this).find('input[name="active_tab"]');
                if (activeTabInput.length) {
                    activeTabInput.val(currentTab);
                }
            });
            
            // Also make sure the front page form has the correct active tab
            $('.kuperbush-front-page-form').each(function() {
                const activeTabInput = $(this).find('input[name="active_tab"]');
                if (activeTabInput.length) {
                    activeTabInput.val(currentTab);
                }
            });
        },
        
        /**
         * Handle success notifications and settings-updated parameter
         */
        handleSuccessNotifications: function() {
            // Check if we have a settings-updated parameter
            const urlParams = new URLSearchParams(window.location.search);
            const settingsUpdated = urlParams.get('settings-updated');
            
            if (settingsUpdated === 'true') {
                // Force add our own success message for better visibility - even if WordPress added one
                // Create a custom success message with more styling
                const successMessage = $('<div class="kuperbush-success-message">' +
                                       '<span class="dashicons dashicons-yes-alt"></span>' +
                                       '<span class="message-text">Settings saved successfully!</span>' +
                                       '<span class="kuperbush-success-message-close dashicons dashicons-no-alt"></span>' +
                                       '</div>');
                
                // Add it at the top of the form
                $('.kuperbush-admin-module-header').before(successMessage);
                
                // Make it dismissible
                successMessage.find('.kuperbush-success-message-close').on('click', function() {
                    successMessage.fadeOut(300, function() { $(this).remove(); });
                });
                
                // Auto-dismiss after 5 seconds
                setTimeout(function() {
                    successMessage.fadeOut(300, function() { $(this).remove(); });
                }, 5000);
                
                // Remove the settings-updated parameter from URL without refreshing
                if (window.history && window.history.replaceState) {
                    // Remove the parameter but keep the other ones
                    urlParams.delete('settings-updated');
                    const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
                    window.history.replaceState({}, document.title, newUrl);
                }
                
                // Highlight saved fields for visual feedback - especially important for checkboxes
                $('.kuperbush-field-checkbox input[type="checkbox"]').each(function() {
                    const checkbox = $(this);
                    const toggleSlider = checkbox.next('.kuperbush-toggle-slider');
                    
                    // Add a brief highlight effect to show the saved state
                    toggleSlider.addClass('kuperbush-saved-highlight');
                    setTimeout(function() {
                        toggleSlider.removeClass('kuperbush-saved-highlight');
                    }, 1500);
                });
            }
        },
        
        /**
         * Handle form submission with validation
         */
        setupFormSubmission: function() {
            $('.kuperbush-admin-form').on('submit', function(e) {
                // For future form validation if needed
                const form = $(this);
                const currentTab = new URLSearchParams(window.location.search).get('tab') || 'general';
                
                console.log('========= FORM SUBMISSION DEBUG =========');
                console.log('Current tab:', currentTab);
                console.log('Form URL:', window.location.href);
                
                // ENHANCED DEBUG: Log form element details
                console.log('Form element details:');
                console.log('- ID:', form.attr('id'));
                console.log('- Classes:', form.attr('class'));
                console.log('- Action:', form.attr('action'));
                console.log('- Method:', form.attr('method'));
                console.log('- Enctype:', form.attr('enctype'));
                
                // Debug form data
                console.log('Submitting form with data:');
                let formData = {};
                form.find('input, select, textarea').each(function() {
                    const input = $(this);
                    const name = input.attr('name');
                    
                    if (name) {
                        if (input.is(':checkbox')) {
                            formData[name] = input.is(':checked') ? '1' : '0';
                        } else {
                            formData[name] = input.val();
                        }
                    }
                });
                console.log(formData);
                
                // ENHANCED DEBUG: Log nonce fields specifically
                const nonceField = form.find('input[name="_wpnonce"]');
                if (nonceField.length) {
                    console.log('Nonce field found:');
                    console.log('- Value:', nonceField.val());
                    console.log('- Parent:', nonceField.parent().prop('tagName'));
                } else {
                    console.error('CRITICAL: Nonce field is missing!');
                }
                
                // ENHANCED DEBUG: Log hidden fields specifically
                console.log('Hidden fields in the form:');
                form.find('input[type="hidden"]').each(function() {
                    const hiddenInput = $(this);
                    console.log(`- ${hiddenInput.attr('name')}: ${hiddenInput.val()}`);
                });
                
                // Dump the entire form HTML for debugging
                console.log('Form HTML:', form.prop('outerHTML'));
                
                // ENHANCED DEBUG: Check for required fields
                console.log('Checking form for required hidden fields:');
                const requiredFields = ['option_page', 'action', '_wpnonce', 'active_tab'];
                requiredFields.forEach(field => {
                    const hasField = form.find(`input[name="${field}"]`).length > 0;
                    console.log(`- ${field}: ${hasField ? 'Present' : 'MISSING'}`);
                });
                
                // Make EXTRA sure the active_tab is set correctly
                const activeTabInput = form.find('input[name="active_tab"]');
                if (activeTabInput.length) {
                    activeTabInput.val(currentTab);
                    console.log('Set active_tab to:', currentTab);
                } else {
                    form.append('<input type="hidden" name="active_tab" value="' + currentTab + '">');
                    console.log('Added missing active_tab field with value:', currentTab);
                }
                
                // Make sure we have a _wpnonce field
                if (!form.find('input[name="_wpnonce"]').length) {
                    console.error('CRITICAL: Form is missing _wpnonce field which is required for security!');
                    
                    // ENHANCEMENT: Try to find settings-fields output in the form and log it
                    const settingsFieldsHTML = form.find('.settings-fields').html();
                    if (settingsFieldsHTML) {
                        console.log('Found settings-fields container:', settingsFieldsHTML);
                    } else {
                        console.log('No settings-fields container found in the form');
                    }
                }
                
                // Store for comparison
                if (window.kuperbushAdminSavedValues === undefined) {
                    window.kuperbushAdminSavedValues = {};
                }
                
                // Save the current form values to compare after submit
                form.find('input, select, textarea').each(function() {
                    const input = $(this);
                    const name = input.attr('name');
                    
                    if (name) {
                        if (input.is(':checkbox')) {
                            window.kuperbushAdminSavedValues[name] = input.is(':checked');
                        } else {
                            window.kuperbushAdminSavedValues[name] = input.val();
                        }
                    }
                });
                
                // Make sure the form action is correct
                const formAction = form.attr('action');
                if (!formAction || formAction === '') {
                    form.attr('action', window.ajaxurl || '/wp-admin/admin-post.php');
                    console.log('Set form action to:', form.attr('action'));
                }
                
                // ENHANCEMENT: Ensure form has proper settings fields
                // WordPress settings API requires these fields to save options
                if (!form.find('input[name="option_page"]').length) {
                    form.append('<input type="hidden" name="option_page" value="kuperbush_options">');
                    console.log('Added missing option_page field');
                }
                
                // Make sure we have required hidden fields
                if (!form.find('input[name="action"]').length) {
                    form.append('<input type="hidden" name="action" value="options">');
                    console.log('Added hidden action field');
                }
                
                // ENHANCEMENT: Add _wp_http_referer if missing
                if (!form.find('input[name="_wp_http_referer"]').length) {
                    form.append('<input type="hidden" name="_wp_http_referer" value="' + window.location.pathname + window.location.search + '">');
                    console.log('Added missing _wp_http_referer field');
                }
                
                // CRITICAL FIX: If form is missing nonce, add wp_nonce_field output
                if (!form.find('input[name="_wpnonce"]').length) {
                    // This is a temporary debug fix - it won't have the correct nonce value
                    // but will help us understand if the issue is with missing nonce fields
                    console.log('ATTEMPTING TO FIX: Adding missing nonce field');
                    form.append('<input type="hidden" name="_wpnonce" value="temp_debug_nonce_fix">');
                }
                
                // Example validation check (not currently used)
                const isValid = true;
                
                if (!isValid) {
                    e.preventDefault();
                    // Add validation error messages
                }
                
                // Add saving indicator
                const submitButton = form.find('.kuperbush-admin-submit-button');
                submitButton.prop('disabled', true)
                            .addClass('updating-message')
                            .attr('data-original-text', submitButton.val())
                            .val('Saving...');
                
                // Add a loading overlay to the form
                const loadingOverlay = $('<div class="kuperbush-loading-overlay"><div class="kuperbush-loading-spinner"></div></div>');
                form.append(loadingOverlay);
                loadingOverlay.fadeIn(150);
                
                // Debug submission
                console.log('Form submitted to:', form.attr('action'));
                console.log('With method:', form.attr('method'));
                console.log('=======================================');
                
                // Add a debug handler for form submission
                try {
                    // Create a fake response handler to log any potential errors
                    const originalSubmit = form[0].submit;
                    form[0].submit = function() {
                        console.log('Form.submit() called');
                        try {
                            originalSubmit.apply(this, arguments);
                        } catch (submitError) {
                            console.error('Error during form submission:', submitError);
                        }
                    };
                } catch (hookError) {
                    console.error('Error setting up form submission hook:', hookError);
                }
                
                // ADD EVENT LISTENER FOR ACTUAL FORM SUBMIT EVENT
                console.log('Added actual submit event listener to track when form is actually submitted');
            });
            
            // Handle the front page form submission in the same way
            $('.kuperbush-front-page-form, .kuperbush-template-pages-form').on('submit', function(e) {
                const form = $(this);
                const submitButton = form.find('input[type="submit"], button[type="submit"]');
                const currentTab = new URLSearchParams(window.location.search).get('tab') || 'general';
                
                console.log('========= CUSTOM FORM SUBMISSION DEBUG =========');
                console.log('Current tab:', currentTab);
                console.log('Form URL:', window.location.href);
                console.log('Form type:', form.hasClass('kuperbush-front-page-form') ? 'Front Page Form' : 'Template Pages Form');
                
                // Debug form data
                console.log('Submitting custom form with data:');
                let formData = {};
                form.find('input, select, textarea').each(function() {
                    const input = $(this);
                    const name = input.attr('name');
                    
                    if (name) {
                        if (input.is(':checkbox')) {
                            formData[name] = input.is(':checked') ? '1' : '0';
                        } else {
                            formData[name] = input.val();
                        }
                    }
                });
                console.log(formData);
                
                // Dump the entire form HTML for debugging
                console.log('Form HTML:', form.prop('outerHTML'));
                
                // Make EXTRA sure the active_tab is set correctly
                const activeTabInput = form.find('input[name="active_tab"]');
                if (activeTabInput.length) {
                    activeTabInput.val(currentTab);
                    console.log('Set active_tab to:', currentTab);
                } else {
                    form.append('<input type="hidden" name="active_tab" value="' + currentTab + '">');
                    console.log('Added missing active_tab field with value:', currentTab);
                }
                
                // Make sure we have a nonce field
                const nonceField = form.find('input[name="_wpnonce"]');
                if (!nonceField.length) {
                    console.error('CRITICAL: Custom form is missing nonce field which is required for security!');
                } else {
                    console.log('Nonce value:', nonceField.val());
                }
                
                // Make sure the form action is correct
                const formAction = form.attr('action');
                if (!formAction || formAction === '') {
                    form.attr('action', window.ajaxurl || '/wp-admin/admin-post.php');
                    console.log('Set form action to:', form.attr('action'));
                }
                
                // Make sure we have the option_page field
                if (!form.find('input[name="option_page"]').length) {
                    form.append('<input type="hidden" name="option_page" value="kuperbush_options">');
                    console.log('Added hidden option_page field');
                }
                
                // Make sure we have required hidden fields
                if (!form.find('input[name="action"]').length) {
                    form.append('<input type="hidden" name="action" value="options">');
                    console.log('Added hidden action field');
                }
                
                submitButton.prop('disabled', true)
                           .addClass('updating-message')
                           .attr('data-original-text', submitButton.val() || submitButton.text())
                           .val('Processing...');
                
                // Add a loading overlay
                const loadingOverlay = $('<div class="kuperbush-loading-overlay"><div class="kuperbush-loading-spinner"></div></div>');
                form.append(loadingOverlay);
                loadingOverlay.fadeIn(150);
                
                // Debug submission
                console.log('Custom form submitted to:', form.attr('action'));
                console.log('With method:', form.attr('method'));
                console.log('=======================================');
                
                // Add a debug handler for form submission
                try {
                    // Create a fake response handler to log any potential errors
                    const originalSubmit = form[0].submit;
                    form[0].submit = function() {
                        console.log('Custom Form.submit() called');
                        try {
                            originalSubmit.apply(this, arguments);
                        } catch (submitError) {
                            console.error('Error during custom form submission:', submitError);
                        }
                    };
                } catch (hookError) {
                    console.error('Error setting up custom form submission hook:', hookError);
                }
            });
        },
        
        /**
         * Setup toggle field interactions
         */
        setupToggleFields: function() {
            // Handle any conditional field visibility based on toggle states
            $('.kuperbush-field-checkbox input[type="checkbox"]').on('change', function() {
                const fieldId = $(this).attr('id');
                const isChecked = $(this).is(':checked');
                
                // Apply the toggled state visually (improves feedback)
                const toggleSlider = $(this).next('.kuperbush-toggle-slider');
                if (isChecked) {
                    toggleSlider.addClass('kuperbush-toggle-checked');
                } else {
                    toggleSlider.removeClass('kuperbush-toggle-checked');
                }
                
                // Example: Show or hide dependent fields based on checkbox state
                $('.dependent-on-' + fieldId).toggleClass('hidden', !isChecked);
                
                // Custom handling for specific fields can be added here
                switch (fieldId) {
                    case 'kuperbush_disable_gutenberg':
                        // Any specific UI updates when Gutenberg toggle changes
                        break;
                        
                    case 'kuperbush_show_template_name':
                        // Any specific UI updates when template toggle changes
                        break;
                }
            });
            
            // Trigger change event on page load to set initial states
            $('.kuperbush-field-checkbox input[type="checkbox"]').trigger('change');
        },
        
        /**
         * Setup bulk action buttons
         */
        setupBulkActions: function() {
            // Select all post types
            $('.kuperbush-select-all-post-types').on('click', function(e) {
                e.preventDefault();
                const section = $(this).closest('.kuperbush-admin-section');
                section.find('input[type="checkbox"]').prop('checked', true).trigger('change');
            });
            
            // Deselect all post types
            $('.kuperbush-deselect-all-post-types').on('click', function(e) {
                e.preventDefault();
                const section = $(this).closest('.kuperbush-admin-section');
                section.find('input[type="checkbox"]').prop('checked', false).trigger('change');
            });
        }
    };

    // Initialize on document ready
    $(document).ready(function() {
        kuperbushAdmin.init();
    });

})(jQuery);