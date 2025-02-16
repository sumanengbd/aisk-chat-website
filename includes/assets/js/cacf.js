(function($) {
    // Icon Picker
    function initializeIconPicker($select) {
        var $fieldId = $select.attr("id");
        var $allowNull = $("#" + $fieldId).data("allow_null") === 1;
        
        var $args = {
            ui: true, 
            width: '100%',
            allowHtml: true,
            escapeMarkup: markup => markup,
            dropdownCssClass: 'select2-cicon-picker',
            templateResult: option => !option.id ? option.text : "<i class=\"" + option.id + "\"></i> " + "<span class=\"iconname\">"+ option.text +"</span>",
        };

        if ($allowNull) {
            $args.allowClear = true;
        }
        
        if ($select.hasClass('acf-cicon-picker')) {

            if (isWooCommercePage()) {
                $select.select2($args);
            } else {
                acf.newSelect2($select, $args);
            }

            $select.on('select2:open', function() {
                $('.select2-search--dropdown .select2-search__field').attr('placeholder', 'Search icons...');
            });

            updateRenderedSelection($select);
        }
    }

    function isWooCommercePage() {
        return $('body').hasClass('woocommerce-admin-page');
    }

    function updateRenderedSelection($select) {
        var $fieldId = $select.attr("id");
        var selectedOption = $("#" + $fieldId + " option:selected");

        if (selectedOption.length) {
            var selectedIconClass = selectedOption.val();
            $("#" + $fieldId).next(".select2-container").find(".select2-selection__rendered").removeClass().addClass("select2-selection__rendered").addClass(selectedIconClass);
        }
    }

    function initialize_field( $field ) {
        $(".acf-cicon-picker").each(function() {
            initializeIconPicker($(this));
        }).on("change", function() {
            updateRenderedSelection($(this));
        });

        $(document).on('click', '.acf-repeater-add-row, .acf-icon[data-event="add-row"], .acf-icon[data-event="duplicate-row"]', function() {
            var $repeaterRows = $(this).closest('.acf-repeater').find('.acf-row:not(.acf-clone)');

            $repeaterRows.find('.acf-cicon-picker').each(function() {
                initializeIconPicker($(this));
            }).on("change", function() {
                updateRenderedSelection($(this));
            });
        });
    }

    if( typeof acf.add_action !== 'undefined' ) {
        acf.add_action( 'ready_field', initialize_field );
        acf.add_action( 'append_field', initialize_field );
    }

})(jQuery);