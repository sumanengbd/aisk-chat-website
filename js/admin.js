jQuery( document ).ready(function() {
    // Landing
    dynamic_title_repeater_accordion('testimonials', 'name');
});

function dynamic_title_repeater_accordion(repeater_name, field_name) {
    var information_tabs = jQuery("div[data-name='" + repeater_name + "']");

    if (information_tabs.length) {
        var selector = "tr:not(.acf-clone) td.acf-fields .acf-accordion-content div[data-name='" + field_name + "'] input";

        // add lister
        jQuery(information_tabs).on('input', selector, function() {
            var me = jQuery(this);
            var meValue = me.val() ? me.val() : 'Unknown';
            me.closest('td.acf-fields').find('.acf-accordion-title label').text(meValue);
        });

        // trigger the function on load
        information_tabs.find(selector).trigger('input');

    }
}
