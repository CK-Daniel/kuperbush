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
            // Add hidden input to remember the current tab
            const currentTab = new URLSearchParams(window.location.search).get('tab') || 'general';
            
            $('.kuperbush-admin-form').each(function() {
                if (!$(this).find('input[name="active_tab"]').length) {
                    $(this).append('<input type="hidden" name="active_tab" value="' + currentTab + '">');
                }
            });
        },
        
        /**
         * Handle form submission with validation
         */
        setupFormSubmission: function() {
            $('.kuperbush-admin-form').on('submit', function(e) {
                // For future form validation if needed
                const form = $(this);
                
                // Example validation check (not currently used)
                const isValid = true;
                
                if (!isValid) {
                    e.preventDefault();
                    // Add validation error messages
                }
                
                // Add saving indicator
                const submitButton = form.find('.kuperbush-admin-submit-button');
                submitButton.prop('disabled', true).addClass('updating-message');
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
                
                // Example: Show or hide dependent fields based on checkbox state
                // $('.dependent-on-' + fieldId).toggleClass('hidden', !isChecked);
                
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