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
                
                // Collect current values for later comparison
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
            });
            
            // Handle the front page form submission in the same way
            $('.kuperbush-front-page-form').on('submit', function(e) {
                const form = $(this);
                const submitButton = form.find('input[type="submit"]');
                
                submitButton.prop('disabled', true)
                           .addClass('updating-message')
                           .attr('data-original-text', submitButton.val())
                           .val('Processing...');
                
                // Add a loading overlay
                const loadingOverlay = $('<div class="kuperbush-loading-overlay"><div class="kuperbush-loading-spinner"></div></div>');
                form.append(loadingOverlay);
                loadingOverlay.fadeIn(150);
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