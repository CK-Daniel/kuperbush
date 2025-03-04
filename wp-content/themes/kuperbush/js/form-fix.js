/**
 * Form Fix Script for Kuperbush Theme Options
 * 
 * This script fixes the save buttons on all tabs of the theme options page.
 * 
 * The issue was nested forms in the General and Tools tabs causing the submit
 * button to only work on the Developer tab.
 */
jQuery(document).ready(function($) {
    console.log('Form Fix Script Loaded');
    
    // Run only on theme options page
    if (window.location.href.indexOf('themes.php?page=kuperbush-options') === -1) {
        return;
    }
    
    // Fix for form submission problems
    function fixForms() {
        console.log('Running form fix...');
        
        // 1. Fix front page form (on General tab)
        const frontPageForm = $('.kuperbush-front-page-form');
        if (frontPageForm.length) {
            console.log('Fixing front page form...');
            
            // Get the submit button
            const frontPageSubmitBtn = frontPageForm.find('input[type="submit"]');
            if (frontPageSubmitBtn.length) {
                // Replace with a button that will submit the main form
                frontPageSubmitBtn.replaceWith(
                    $('<button type="button" class="button button-primary js-fixed-front-page-btn">' + 
                      frontPageSubmitBtn.val() + '</button>')
                );
                
                // Handle the click event
                $('.js-fixed-front-page-btn').on('click', function(e) {
                    e.preventDefault();
                    
                    console.log('Front page button clicked');
                    
                    // Get values from the form
                    const applyFrontPage = frontPageForm.find('input[name="kuperbush_apply_front_page"]').is(':checked');
                    const frontPageNonce = frontPageForm.find('input[name="kuperbush_front_page_nonce"]').val();
                    
                    // Find the main form
                    const mainForm = $('.kuperbush-admin-form');
                    
                    // Add our values to the main form
                    mainForm.append('<input type="hidden" name="kuperbush_setup_front_page" value="1">');
                    
                    if (applyFrontPage) {
                        mainForm.append('<input type="hidden" name="kuperbush_apply_front_page" value="1">');
                    }
                    
                    if (frontPageNonce) {
                        mainForm.append('<input type="hidden" name="kuperbush_front_page_nonce" value="' + frontPageNonce + '">');
                    }
                    
                    // Submit the main form
                    console.log('Submitting main form for front page setup');
                    mainForm.submit();
                });
            }
        }
        
        // 2. Fix template pages form (on Tools tab)
        const templatePagesForm = $('.kuperbush-template-pages-form');
        if (templatePagesForm.length) {
            console.log('Fixing template pages form...');
            
            // Get the submit button
            const templatePagesSubmitBtn = templatePagesForm.find('button[type="submit"]');
            if (templatePagesSubmitBtn.length) {
                // Replace with a button that will submit the main form
                templatePagesSubmitBtn.replaceWith(
                    $('<button type="button" class="button button-primary js-fixed-template-pages-btn">' + 
                      templatePagesSubmitBtn.text() + '</button>')
                );
                
                // Handle the click event
                $('.js-fixed-template-pages-btn').on('click', function(e) {
                    e.preventDefault();
                    
                    console.log('Template pages button clicked');
                    
                    // Get values from the form
                    const createPages = templatePagesForm.find('input[name="kuperbush_create_pages"]').val();
                    const pagesNonce = templatePagesForm.find('input[name="_wpnonce"]').val();
                    
                    // Find the main form
                    const mainForm = $('.kuperbush-admin-form');
                    
                    // Add our values to the main form
                    mainForm.append('<input type="hidden" name="kuperbush_create_pages" value="1">');
                    
                    if (pagesNonce) {
                        mainForm.append('<input type="hidden" name="template_pages_nonce" value="' + pagesNonce + '">');
                    }
                    
                    // Submit the main form
                    console.log('Submitting main form for template pages creation');
                    mainForm.submit();
                });
            }
        }
        
        // 3. Fix the main form submit button
        const mainForm = $('.kuperbush-admin-form');
        const mainSubmitBtn = mainForm.find('.kuperbush-admin-submit-button');
        
        if (mainSubmitBtn.length) {
            console.log('Adding debug handler to main submit button');
            
            // Add event listener to the main submit button
            mainSubmitBtn.on('click', function() {
                console.log('Main submit button clicked');
                
                // Check all form fields
                const formData = {};
                mainForm.find('input, select, textarea').each(function() {
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
                
                console.log('Form data:', formData);
                
                // Make sure option_page and active_tab are set
                if (!mainForm.find('input[name="option_page"]').length) {
                    console.log('Adding missing option_page field');
                    mainForm.append('<input type="hidden" name="option_page" value="kuperbush_options">');
                }
                
                const currentTab = new URLSearchParams(window.location.search).get('tab') || 'general';
                const activeTabInput = mainForm.find('input[name="active_tab"]');
                
                if (!activeTabInput.length) {
                    console.log('Adding missing active_tab field');
                    mainForm.append('<input type="hidden" name="active_tab" value="' + currentTab + '">');
                } else {
                    console.log('Updating active_tab value to', currentTab);
                    activeTabInput.val(currentTab);
                }
            });
        }
        
        console.log('Form fix complete');
    }
    
    // Run the fix with slight delay to ensure all elements are loaded
    setTimeout(fixForms, 500);
});