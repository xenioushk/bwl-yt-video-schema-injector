(function ($) {
    "use strict";

    $(function () {
        function bwl_split(val) {
            return val.trim().split(/\s+/);
        }
        function extractLast(term) {
            return bwl_split(term).pop();
        }

        var bwl_available_tags = [
            "section-content-block-minimal",
            "section-pure-white-bg",
            "section-secondary-bg",
            "section-black-overlay",
            "section-black-30-overlay",
            "section-black-50-overlay",
            "no-gutter",
            "horizontal-newsletter",
            "horizontal-newsletter-alt",
            "horizontal-newsletter-square-layout",
            "horizontal-newsletter-square-layout-alt",
            "horizontal-newsletter-semi-square-layout",
            "horizontal-newsletter-semi-square-layout-alt",
            "text-light-color",
            "text-dark-color",
            "theme-custom-text-shadow",
            "theme-border-size-1",
            "theme-semi-rounded-box",
            "text-capitalize",
            "theme-custom-box-shadow",
            "theme-custom-box-animation",
            "block-white-bg",
            "block-white-30-bg",
            "block-white-50-bg",
            "block-white-80-bg",
            "block-black-bg",
            "block-black-30-bg",
            "block-black-50-bg",
            "block-black-80-bg",
            "box-rounded-layout",
            "box-semi-rounded-layout",
            "sk-about-details",
            "price-stripped-item",
            "vbox_icon_square",
            "vbox-no-border",
            "vbox_bottom_left",
            "vbox_bottom_right",
            "btn-theme",
            "btn-theme-invert",
            "btn-theme-small",
            "btn-square",
            "btn-capitalize",
            "no-padding",
            "no-bottom-padding",
            "padding-left-0",
            "padding-right-0",
            "padding-all-4",
            "no-margin",
            "margin-top-rev-24",
            "margin-top-5",
            "margin-top-12",
            "margin-top-16",
            "margin-top-24",
            "margin-top-32",
            "margin-top-36",
            "margin-top-42",
            "margin-top-48",
            "margin-bottom-5",
            "margin-bottom-12",
            "margin-bottom-24",
            "margin-bottom-32",
            "margin-bottom-48",
            "margin-bottom-80",
        ];

        $(".bwl_cont_ext")
            // don't navigate away from the field on tab when selecting an item
            .on("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB && $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                minLength: 0,
                source: function (request, response) {
                    // delegate back to autocomplete, but extract the last term
                    response($.ui.autocomplete.filter(bwl_available_tags, extractLast(request.term)));
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {
                    var terms = bwl_split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.value);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(" ");
                    return false;
                },
            });
    });
})(jQuery);
