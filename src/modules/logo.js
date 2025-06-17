import $ from "jquery"
import { RTL as rtl_status } from "./rtl"
/**
 * Class Logo
 */
export default class Logo {
  /**
   * Run when the document is ready.
   *
   * @return {void}
   */
  docReady() {
    if ($(".logo-items").length) {
      var $logo_items = $(".logo-items")
      $logo_items.each(function () {
        var $this = $(this)
        // alert(rtl_status)
        // Status.
        if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
          $this.removeClass("owl-carousel")
          return ""
        }

        var items_val = $this.attr("data-items") && !isNaN($this.data("items")) ? $this.data("items") : 6,
          nav_val = $this.attr("data-nav") && !isNaN($this.data("nav")) ? $this.data("nav") : false,
          dots_val = $this.attr("data-dots") && !isNaN($this.data("dots")) ? $this.data("dots") : true,
          autoplay_val = $this.attr("data-autoplay") && !isNaN($this.data("autoplay")) ? $this.data("autoplay") : true,
          autoplaytimeout_val = $this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout")) ? $this.data("autoplaytimeout") : 5000

        $this.owlCarousel({
          rtl: rtl_status,
          items: items_val,
          loop: true,
          autoplay: autoplay_val,
          autoplayTimeout: autoplaytimeout_val,
          autoplayHoverPause: true,
          dots: dots_val,
          nav: nav_val,
          navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
          responsive: {
            0: {
              items: 2,
              nav: false,
              dots: false,
            },
            600: {
              items: 3,
              nav: false,
            },
            1000: {
              items: items_val,
            },
          },
        })
      })
    }
  }
}
