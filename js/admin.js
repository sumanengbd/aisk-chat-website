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

// Icon Picker
(function($) {
    document.addEventListener("DOMContentLoaded", function() {
        function formatText(option) {
            if (!option.id) {
                return option.text;
            }
            return "<i class=\"" + option.id + "\"></i> " + option.text;
        }

        function updateRenderedSelection(fieldId) {
            var selectedOption = $("#" + fieldId + " option:selected");
            if (selectedOption.length) {
                var selectedIconClass = selectedOption.val();
                var renderedSelection = $("#" + fieldId).next(".select2-container").find(".select2-selection__rendered");
                renderedSelection.removeClass().addClass("select2-selection__rendered").addClass(selectedIconClass);
            }
        }

        $(".acf-icon-picker").each(function() {
            var fieldId = $(this).attr("id");
            $(this).select2({
                width: "100%",
                allowHtml: true,
                templateResult: formatText,
                dropdownCssClass: 'select2-icon-picker',
                escapeMarkup: function(markup) {
                    return markup;
                }
            });
            updateRenderedSelection(fieldId);
        });

        $(".acf-icon-picker").on("change", function() {
            var fieldId = $(this).attr("id");
            updateRenderedSelection(fieldId);
        });
    });
})(jQuery);
