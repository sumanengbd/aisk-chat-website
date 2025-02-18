jQuery( document ).ready(function() {
    dynamic_title_repeater_accordion('chats', 'title');
    dynamic_title_repeater_accordion('features', 'title');
    dynamic_title_repeater_accordion('stories', 'title');
    dynamic_title_repeater_accordion('steps', 'title');
    dynamic_title_repeater_accordion('faqs', 'question');
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

function hideVisualEditorOnTemplate() {
    const hiddenTemplates = ["aisk-page.php"];

    function toggleVisualEditor(template) {
        const editor = document.querySelector(".editor-visual-editor");
        if (editor) editor.style.display = hiddenTemplates.includes(template) ? "none" : "";
    }

    function init() {
        if (!wp?.data?.subscribe) return setTimeout(init, 100);
        let prevTemplate = wp.data.select("core/editor").getEditedPostAttribute("template");
        toggleVisualEditor(prevTemplate);

        wp.data.subscribe(() => {
            const currentTemplate = wp.data.select("core/editor").getEditedPostAttribute("template");
            if (currentTemplate !== prevTemplate) toggleVisualEditor((prevTemplate = currentTemplate));
        });
    }
    init();
}

document.addEventListener("DOMContentLoaded", hideVisualEditorOnTemplate);
window.addEventListener("load", hideVisualEditorOnTemplate);

