// Image Uploader.

function bwl_cmb_set_uploader(field, styling) {
  var bwl_cmb_uploader

  jQuery(document).on("click", "#upload_" + field + "_button", function (event) {
    event.preventDefault()

    var bg_img_box_id = jQuery(this).data("bg_img_box_id")

    bwl_cmb_uploader = wp.media.frames.bwl_cmb_uploader = wp.media({
      title: "Choose Image",

      library: { type: "image" },

      button: { text: "Select" },

      multiple: false,
    })

    bwl_cmb_uploader.on("select", function () {
      var selection = bwl_cmb_uploader.state().get("selection")

      selection.map(function (attachment) {
        attachment = attachment.toJSON()

        jQuery("#" + bg_img_box_id).attr("value", attachment.url)
      })
    })

    bwl_cmb_uploader.open()
  })
}

;(function ($) {
  $(function () {
    //Background color.

    if ($(".bgcolor")) {
      $(".bgcolor").each(function () {
        var colorbox = $(this)

        colorbox.ColorPicker({
          onShow: function (colpkr) {
            jQuery(colpkr).slideDown(200)

            return false
          },

          onHide: function (colpkr) {
            jQuery(colpkr).slideUp(200)

            //                                    colorbox.attr("readonly","true");

            return false
          },

          onChange: function (hsb, hex, rgb) {
            colorbox.val("#" + hex).css({
              "text-transform": "lowercase",
            })
          },
        })
      })
    }

    if ($(".kdesk_repeat_field").length) {
      let $kdesk_repeat_field = $(".kdesk_repeat_field")

      function bwl_cmb_generate_repeat_field($field_type, $field_name, $count_val, $label_text, $delete_text) {
        var $repeat_row = ""

        $repeat_row += '<li class="bwl_cmb_repeat_row" data-row_count="' + $count_val + '">' + '<span class="label">' + $label_text + "</span> " + '<input name="' + $field_name + "[" + $count_val + ']" type="text" value="" />' + '<div class="clear"></div>' + '<a class="delete_row" title="' + $delete_text + '">' + $delete_text + "</a>" + "</li>"

        return $repeat_row
      }

      $kdesk_repeat_field.find(".bwl_cmb_remove_file").on("click", function () {
        $("#" + $(this).data("parent_field")).attr("value", "")
      })

      $kdesk_repeat_field.find("#add_new_row").click(function () {
        var $bwl_cmb_repeat_field_container = $(this).prev(".bwl_cmb_repeat_field_container")

        var $count_val = $bwl_cmb_repeat_field_container.find("li").length

        //            console.log($count_val);

        if ($count_val != 0) {
          $count_val = $bwl_cmb_repeat_field_container.find("li:last-child").data("row_count") + 1
        }

        var $field_type = $(this).data("field_type")

        var $field_name = $(this).data("field_name")

        //            console.log($field_type);

        var $label_text = $(this).data("label_text")

        var $delete_text = $(this).data("delete_text")

        var $bwl_cmb_new_row_html = bwl_cmb_generate_repeat_field($field_type, $field_name, $count_val, $label_text, $delete_text)

        if ($bwl_cmb_repeat_field_container.find("li").length == 0) {
          $bwl_cmb_repeat_field_container.html($bwl_cmb_new_row_html)
        } else {
          $bwl_cmb_repeat_field_container.find("li:last-child").after($bwl_cmb_new_row_html)
        }
      })

      // Remove Rows.

      $(document).on("click", "#add_new_row>.delete_row", function () {
        $(this)
          .parent()
          .addClass("taq-removered")
          .fadeOut(function () {
            $(this).remove()
          })
      })

      // Sortable lists.

      $kdesk_repeat_field.find(".bwl_cmb_repeat_field_container").sortable({ placeholder: "petition-row-state-highlight" })
    }
  })
})(jQuery)
