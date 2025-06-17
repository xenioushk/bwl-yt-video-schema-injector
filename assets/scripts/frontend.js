/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/modules/logo.js":
/*!*****************************!*\
  !*** ./src/modules/logo.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Logo)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _rtl__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./rtl */ "./src/modules/rtl.js");


/**
 * Class Logo
 */
class Logo {
  /**
   * Run when the document is ready.
   *
   * @return {void}
   */
  docReady() {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()(".logo-items").length) {
      var $logo_items = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".logo-items");
      $logo_items.each(function () {
        var $this = jquery__WEBPACK_IMPORTED_MODULE_0___default()(this);
        // alert(rtl_status)
        // Status.
        if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
          $this.removeClass("owl-carousel");
          return "";
        }
        var items_val = $this.attr("data-items") && !isNaN($this.data("items")) ? $this.data("items") : 6,
          nav_val = $this.attr("data-nav") && !isNaN($this.data("nav")) ? $this.data("nav") : false,
          dots_val = $this.attr("data-dots") && !isNaN($this.data("dots")) ? $this.data("dots") : true,
          autoplay_val = $this.attr("data-autoplay") && !isNaN($this.data("autoplay")) ? $this.data("autoplay") : true,
          autoplaytimeout_val = $this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout")) ? $this.data("autoplaytimeout") : 5000;
        $this.owlCarousel({
          rtl: _rtl__WEBPACK_IMPORTED_MODULE_1__.RTL,
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
              dots: false
            },
            600: {
              items: 3,
              nav: false
            },
            1000: {
              items: items_val
            }
          }
        });
      });
    }
  }
}

/***/ }),

/***/ "./src/modules/public.js":
/*!*******************************!*\
  !*** ./src/modules/public.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _rtl__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./rtl */ "./src/modules/rtl.js");
/* harmony import */ var _logo__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./logo */ "./src/modules/logo.js");
/* harmony import */ var _testimonial__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./testimonial */ "./src/modules/testimonial.js");
/*-------------------------------------------------------------------*/
/* Project: Knowledgedesk - Fully Functional Knowledge Base WordPress Theme */
/* Author: xenioushk*/
/*-------------------------------------------------------------------*/

/*========================================================================*/
/*   TABLE OF CONTENT
 /*========================================================================*/
/*
 /*  00. RTL STATUS CHECK.
 /*  01. HELPER FUNCTIONS.
 /*  02. HOME SLIDER
 /*  03. FITERABLE PORTFOLIO.
 /*  04. IMAGE GALLERY
 /*  05. JUMBOTORON BANNER BOX
 /*  06. BREADCRUMB
 /*  07. HIGHLIGHTS BLOCK
 /*  08. COUNTER BLOCK
 /*  09. TEAMS BLOCK
 /*  10. LOGOS BLOCK
 /*  11. TESTIMONIAL BLOCK
 /*  12. CTA BLOCK
 /*  13. BACK TO TOP BUTTON.
 /*  14. PRELOADER
 /*
 /*========================================================================*/




(function ($) {
  "use strict";

  // alert(rtl_status)
  $(function () {
    // Adjust slider content according to screen size.
    function slider_resize() {
      if ($(window).width() > 991 && $(".header-style1").length > 0) {
        setTimeout(function () {
          var header_style_outer_height = $(".header-style1").outerHeight();
          $(".slider-content").attr("style", "margin-top: " + parseInt((header_style_outer_height - 24) / 2, 10) + "px;");
          $(".owl-nav div").attr("style", "margin-top: " + parseInt((header_style_outer_height - 24) / 2, 10) + "px;");
        }, 500);
      } else {
        $(".slider-content").first().attr("style", "margin-top: 0px;");
      }
    }

    // Convert hex value to RGBA.
    function hexToRgbA(hex, opacity) {
      var c;
      if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
        c = hex.substring(1).split("");
        if (c.length == 3) {
          c = [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c = "0x" + c.join("");
        return "rgba(" + [c >> 16 & 255, c >> 8 & 255, c & 255].join(",") + "," + opacity + ")";
      } else {
        return 'rgba("0,0,0,' + opacity + '")';
      }
    }

    // Custom scripts to generate dynamic css.
    function kdesk_custom_style() {
      if ($(".kdesk_custom").length > 0) {
        var kdesk_css_string = "";
        $(".kdesk_custom").each(function () {
          if ($(this).data("custom_style") != "") {
            kdesk_css_string += $(this).data("custom_style");
          }
        });
        $("<style data-type='kdesk-custom-css' id='kdesk-custom-css'>" + kdesk_css_string + "</style>").appendTo("head");
      }
    }

    // add animate.css class(es) to the elements to be animated
    function setAnimation(_elem, _InOut) {
      // Store all animationend event name in a string.
      // cf animate.css documentation
      var animationEndEvent = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
      _elem.each(function () {
        var $elem = $(this);
        var $animationType = "animated " + $elem.data("animation-" + _InOut);
        $elem.addClass($animationType).one(animationEndEvent, function () {
          $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
        });
      });
    }

    var current_screen_size;
    current_screen_size = $(window).width();
    $(window).resize(function () {
      current_screen_size = $(window).width();
    });

    // nav menu smooth scroll
    function smooth_scrolling() {
      $(".nav_menu").on("click", function () {
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
          var offset = $(".header-style1").outerHeight();
          if ($(".header-style1").length === 1) {
            offset = $(".header-style1").outerHeight();
          } else {
            offset = parseInt(offset, 0);
          }
          if (target.length) {
            var scrollTopValue;

            //                        if (current_screen_size < 752) {
            scrollTopValue = target.offset().top;
            //                        } else {
            //                            scrollTopValue = target.offset().top - parseInt(offset, 0);
            //                        }

            $("html,body").animate({
              scrollTop: scrollTopValue - parseInt(100)
            }, 1300);
            return false;
          }
        }
      });

      // Landing Page Menu.

      $(".landing_menu").find("a").on("click", function () {
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
          var offset = $(".header-sticky").outerHeight();
          var $wpadminbar_height = 0;
          if ($("#wpadminbar").length > 0) {
            $wpadminbar_height = $("#wpadminbar").outerHeight() - 5;
          }
          if ($(".header-static").length === 1) {
            offset = $(".header-static").outerHeight();
          } else if ($(".sticky-header").length === 1) {
            offset = $(".sticky-header").outerHeight();
          } else {
            offset = parseInt(offset, 0) * 2;
          }
          if (target.length) {
            var scrollTopValue;
            if (current_screen_size < 752) {
              scrollTopValue = target.offset().top;
            } else {
              scrollTopValue = target.offset().top - parseInt(offset, 0) - parseInt($wpadminbar_height, 0);
            }
            $("html,body").animate({
              scrollTop: scrollTopValue
            }, 1300);
            return false;
          }
        }
      });
    }

    // adjust jumbotron content according to screen size
    function jumbotron_resize() {
      if ($(window).width() > 991) {
        const header_style_outer_height = $(".header-style1").outerHeight();
        const margin_top = parseInt(header_style_outer_height / 2, 10);
        $(".jumbotron-content").first().attr("style", `margin-top: ${margin_top}px;`);
      } else {
        $(".jumbotron-top").first().attr("style", "margin-top: 0px;");
      }
    }

    // 02. Home Slider
    function kdesk_slider() {
      if ($("#slider_1").length) {
        var $slider_1 = $("#slider_1");

        // BG & Color Settings.;

        var loop_status = true,
          nav_status = $slider_1.data("nav"),
          nav_icon_left = $slider_1.data("nav_icon_left"),
          nav_icon_right = $slider_1.data("nav_icon_right"),
          nav_icons = ["<i class='fa " + nav_icon_left + "'></i>", "<i class='fa " + nav_icon_right + "'></i>"],
          autoplay_val = true,
          autoplaytimeout_val = 5000;
        $slider_1.find(".slider_item_container").each(function () {
          var $this = $(this);
          var bg_type = "image",
            bg_img = "",
            solid_bg = "#000000",
            bg_color = "#000000",
            bg_opacity = "0.1";

          // Image background with overlay color.

          if ($this.is("[data-bg_type]")) {
            bg_type = $this.data("bg_type");
          }
          if ($this.is("[data-bg_img]")) {
            bg_img = ', url("' + $this.data("bg_img") + '")';
          }
          if ($this.is("[data-bg_color]")) {
            bg_color = $this.data("bg_color");
          }
          if ($this.is("[data-bg_opacity]")) {
            bg_opacity = $this.data("bg_opacity");
          }

          // Solid background color.

          if ($this.is("[data-solid_bg]")) {
            solid_bg = $this.data("solid_bg");
          }
          var $color_overlay = hexToRgbA(bg_color, bg_opacity);
          if (bg_type == "solid") {
            $this.attr("style", "background:" + solid_bg + ";");
          } else {
            $this.attr("style", "background:linear-gradient( " + $color_overlay + ",  " + $color_overlay + " )" + bg_img + "; background-position: center center; background-repeat: no-repeat; background-attachment: inherit; background-size: cover; overflow:hidden;");
          }
        });
        slider_resize();
        $(window).resize(function () {
          if ($(window).width() > 767) {
            slider_resize();
          } else {
            $(".slider-content").removeAttr("style");
          }
        });

        // Carousel.

        if ($slider_1.find(".slider_item_container").length <= 1) {
          loop_status = false;
          nav_status = false;
        }

        // Remove Nav Icon if nav status is false.

        if (nav_status == false) {
          nav_icons = [];
        }

        // Automatic Play

        if ($slider_1.attr("data-autoplay") && !isNaN($slider_1.data("autoplay"))) {
          autoplay_val = $slider_1.data("autoplay");
        }

        // Autoplay status.

        if ($slider_1.attr("data-autoplaytimeout") && !isNaN($slider_1.data("autoplaytimeout"))) {
          autoplaytimeout_val = $slider_1.data("autoplaytimeout");
        }
        $slider_1.owlCarousel({
          rtl: _rtl__WEBPACK_IMPORTED_MODULE_0__.RTL,
          items: 1,
          loop: loop_status,
          nav: nav_status,
          navText: nav_icons,
          autoplayHoverPause: true,
          autoplay: autoplay_val,
          autoplayTimeout: autoplaytimeout_val,
          responsive: {
            0: {
              items: 1,
              nav: false,
              navText: []
            },
            600: {
              items: 1,
              nav: false,
              navText: []
            },
            1000: {
              items: 1
            }
          }
        });
        var $slider_animation = $slider_1;

        // Fired before current slide change
        $slider_animation.on("change.owl.carousel", function (event) {
          var $currentItem = $(".owl-item", $slider_animation).eq(event.item.index);
          var $elemsToanim = $currentItem.find("[data-animation-out]");
          setAnimation($elemsToanim, "out");
        });

        // Fired after current slide has been changed
        $slider_animation.on("changed.owl.carousel", function (event) {
          var $currentItem = $(".owl-item", $slider_animation).eq(event.item.index);
          var $elemsToanim = $currentItem.find("[data-animation-in]");
          setAnimation($elemsToanim, "in");
        });
      }
    }

    // 02.1. STATIC BANNER.

    function kdesk_banner() {
      if ($(".static-banner").length) {
        $(".static-banner").each(function () {
          var $this = $(this);
          var bg_img = "images/home_1_slider_1.jpg",
            bg_color = "#000000",
            bg_opacity = "0.5",
            bg_color_2 = "#000000",
            bg_opacity_2 = "0.8";
          if ($this.is("[data-bg_img]")) {
            bg_img = ', url("' + $this.data("bg_img") + '")';
          } else {
            bg_img = ', url("' + bg_img + '")';
          }
          if ($this.is("[data-bg_color]")) {
            bg_color = $this.data("bg_color");
          }
          if ($this.is("[data-bg_opacity]")) {
            bg_opacity = $this.data("bg_opacity");
          }
          var $color_overlay = hexToRgbA(bg_color, bg_opacity);
          $color_overlay_2 = $color_overlay;
          if ($this.is("[data-gardient]") && $this.data("gardient") == true) {
            if ($this.is("[data-bg_color_2]")) {
              bg_color_2 = $this.data("bg_color_2");
            }
            if ($this.is("[data-bg_opacity_2]")) {
              bg_opacity_2 = $this.data("bg_opacity_2");
            }
            var $color_overlay_2 = hexToRgbA(bg_color_2, bg_opacity_2);
          }
          $this.closest(".vc_row-fluid").addClass("section-banner").attr("style", "background:linear-gradient( " + $color_overlay + ",  " + $color_overlay_2 + " )" + bg_img + "; background-position: center center; background-repeat: repeat; background-attachment: inherit; background-size: cover; overflow:hidden;");
        });
      }
    }

    // 03. Fiterable Portfolio

    function kdesk_portfolio() {
      if ($(".filter-items").length > 0) {
        $(".filter-button").on("click", function () {
          var value = $(this).attr("data-filter");
          if (value == "all") {
            $(".filter").show("1000");
          } else {
            $(".filter").not("." + value).hide("3000");
            $(".filter").filter("." + value).show("3000");
          }
        });
      }

      // 03.1 Portfolio Carousel.

      if ($(".kdesk-portfolio-container").length > 0) {
        var $parent_kdesk_portfolio_container = $(".kdesk-portfolio-container");
        $parent_kdesk_portfolio_container.each(function () {
          var $this = $(this); // Each Carousel.

          var items_val = 1,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000;

          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            return "";
          }

          // no of items

          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items");
          }

          // navigation status.

          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav");
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots");
          }

          // Autoplay status.

          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay");
          }

          // Autoplay status.

          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout");
          }
          $this.owlCarousel({
            rtl: _rtl__WEBPACK_IMPORTED_MODULE_0__.RTL,
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
                items: 1,
                nav: false
              },
              600: {
                items: 1,
                nav: false
              },
              1000: {
                items: items_val
              }
            }
          });
        });
      }
    }

    // 04. Image Gallery

    function kdesk_gallery() {
      if ($(".gallery-light-box").length) {
        $(document).ready(function () {
          $(".gallery-light-box").venobox();
        });
      }

      // 04.1 Gallery Carousel

      if ($(".gallery-carousel").length) {
        var $gallery_carousel = $(".gallery-carousel");
        $gallery_carousel.each(function () {
          var $this = $(this);
          var items_val = 3,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000;
          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel");
            return "";
          }
          // no of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items");
          }
          // navigation status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav");
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots");
          }
          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay");
          }
          // Autoplay status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout");
          }
          $this.owlCarousel({
            rtl: _rtl__WEBPACK_IMPORTED_MODULE_0__.RTL,
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
                items: 1,
                nav: false,
                dots: false
              },
              600: {
                items: 2,
                nav: false
              },
              1000: {
                items: items_val
              }
            }
          });
        });
      }
    }

    // 05. JUMBOTORON BANNER BOX

    if ($(".header-style1").length) {
      jumbotron_resize();
      $(window).on("resize", function () {
        if ($(window).width() > 767) {
          jumbotron_resize();
        } else {
          $(".jumbotron-content").removeAttr("style");
        }
      });
    }

    // 07. Highlights Block

    function kdesk_highlight() {
      if ($(".highlight-carousel").length) {
        var $highlight_carousel = $(".highlight-carousel");
        $highlight_carousel.each(function () {
          var $this = $(this);
          var items_val = 3,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000;
          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel");
            return "";
          }
          // no of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items");
          }
          // navigation status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav");
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots");
          }
          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay");
          }
          // Autoplay status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout");
          }
          $this.owlCarousel({
            rtl: _rtl__WEBPACK_IMPORTED_MODULE_0__.RTL,
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
                items: 1,
                nav: false,
                dots: false
              },
              600: {
                items: 1,
                nav: false
              },
              1000: {
                items: items_val
              }
            }
          });
        });
      }
    }

    // 08. Counter Block

    function kdesk_counter() {
      if ($(".kdesk_counter_num").length > 0) {
        $(".kdesk_counter_num").each(function () {
          var $this = $(this),
            $time = $this.data("time"),
            $delay = $this.data("delay");
          $this.counterUp({
            time: $time,
            delay: $delay
          });
        });
      }
    }

    // 09. Teams Block

    function kdesk_team() {
      if ($(".team-container").length) {
        var $team_container = $(".team-container");
        $team_container.each(function () {
          var $this = $(this);
          var items_val = 3,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000;
          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel");
            return "";
          }
          // no of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items");
          }
          // navigation status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav");
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots");
          }
          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay");
          }
          // Autoplay status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout");
          }
          $this.owlCarousel({
            rtl: _rtl__WEBPACK_IMPORTED_MODULE_0__.RTL,
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
                items: 1,
                nav: false,
                dots: false
              },
              600: {
                items: 1,
                nav: false
              },
              1000: {
                items: items_val
              }
            }
          });
        });
      }
    }

    // 12. CTA Block

    if ($(".venobox").length) {
      $(".venobox").venobox();
    }

    // 12.1. VIDEO BOX

    if ($(".video-box").length) {
      $(document).ready(function () {
        $(".video-box").venobox();
      });
    }

    // 13. Latest News Block

    function kdesk_news() {
      if ($(".latest-news-carousel").length) {
        var $latest_news_carousel = $(".latest-news-carousel");
        $latest_news_carousel.each(function () {
          var $this = $(this);
          var items_val = 3,
            nav_val = false,
            dots_val = true,
            autoplay_val = true,
            autoplaytimeout_val = 5000;
          // Status.
          if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
            $this.removeClass("owl-carousel");
            return "";
          }
          // no of items
          if ($this.attr("data-items") && !isNaN($this.data("items"))) {
            items_val = $this.data("items");
          }
          // navigation status.
          if ($this.attr("data-nav") && !isNaN($this.data("nav"))) {
            nav_val = $this.data("nav");
          }

          // navigation status.
          if ($this.attr("data-dots") && !isNaN($this.data("dots"))) {
            dots_val = $this.data("dots");
          }
          // Autoplay status.
          if ($this.attr("data-autoplay") && !isNaN($this.data("autoplay"))) {
            autoplay_val = $this.data("autoplay");
          }
          // Autoplay status.
          if ($this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout"))) {
            autoplaytimeout_val = $this.data("autoplaytimeout");
          }
          $this.owlCarousel({
            rtl: _rtl__WEBPACK_IMPORTED_MODULE_0__.RTL,
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
                items: 1,
                nav: false,
                dots: false
              },
              600: {
                items: 1,
                nav: false
              },
              1000: {
                items: items_val
              }
            }
          });
        });
      }
    }
    //Calling Smooth Scroll Function.

    smooth_scrolling();

    // 13. Back to Top Button.

    if ($("#backTop").length === 1) {
      $("#backTop").backTop({
        rtl: _rtl__WEBPACK_IMPORTED_MODULE_0__.RTL,
        theme: "custom"
      });
    }

    // Check If VC in front end mode.

    function kdesk_getUrlParam(name) {
      var results = new RegExp("[\\?&]" + name + "=([^&#]*)").exec(window.location.href);
      return results && results[1] || undefined;
    }
    var kdesk_vc_editable_status = kdesk_getUrlParam("vc_editable");
    if (kdesk_vc_editable_status === "true") {
      setTimeout(function () {
        kdesk_slider();
        kdesk_banner();
        kdesk_portfolio();
        kdesk_gallery();
        kdesk_highlight();
        kdesk_counter();
        kdesk_team();
        new _logo__WEBPACK_IMPORTED_MODULE_1__["default"]().docReady();
        new _testimonial__WEBPACK_IMPORTED_MODULE_2__["default"]().docReady();
        kdesk_news();
        kdesk_custom_style();
      }, 1000);
    } else {
      kdesk_slider();
      kdesk_banner();
      kdesk_portfolio();
      kdesk_gallery();
      kdesk_highlight();
      kdesk_counter();
      kdesk_team();
      new _logo__WEBPACK_IMPORTED_MODULE_1__["default"]().docReady();
      new _testimonial__WEBPACK_IMPORTED_MODULE_2__["default"]().docReady();
      kdesk_news();
      kdesk_custom_style();
    }
  });

  // 14. Preloader Button

  $(window).on("load", function () {
    $("#preloader").remove();
  });
})(jQuery);

/***/ }),

/***/ "./src/modules/rtl.js":
/*!****************************!*\
  !*** ./src/modules/rtl.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   RTL: () => (/* binding */ RTL)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

const RTL = jquery__WEBPACK_IMPORTED_MODULE_0___default()("html").is("[dir]") ? true : false;


/***/ }),

/***/ "./src/modules/testimonial.js":
/*!************************************!*\
  !*** ./src/modules/testimonial.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Testimonial)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _rtl__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./rtl */ "./src/modules/rtl.js");


/**
 * Class Testimonial
 */
class Testimonial {
  /**
   * Run when the document is ready.
   *
   * @return {void}
   */
  docReady() {
    if (jquery__WEBPACK_IMPORTED_MODULE_0___default()(".testimonial-container").length) {
      var $testimonial_items = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".testimonial-container");
      $testimonial_items.each(function () {
        var $this = jquery__WEBPACK_IMPORTED_MODULE_0___default()(this);
        if ($this.attr("data-carousel") && $this.data("carousel") !== 1) {
          $this.removeClass("owl-carousel");
          return "";
        }
        var items_val = $this.attr("data-items") && !isNaN($this.data("items")) ? $this.data("items") : 6,
          nav_val = $this.attr("data-nav") && !isNaN($this.data("nav")) ? $this.data("nav") : false,
          dots_val = $this.attr("data-dots") && !isNaN($this.data("dots")) ? $this.data("dots") : true,
          autoplay_val = $this.attr("data-autoplay") && !isNaN($this.data("autoplay")) ? $this.data("autoplay") : true,
          autoplaytimeout_val = $this.attr("data-autoplaytimeout") && !isNaN($this.data("autoplaytimeout")) ? $this.data("autoplaytimeout") : 5000;
        $this.owlCarousel({
          rtl: _rtl__WEBPACK_IMPORTED_MODULE_1__.RTL,
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
              dots: false
            },
            600: {
              items: 3,
              nav: false
            },
            1000: {
              items: items_val
            }
          }
        });
      });
    }
  }
}

/***/ }),

/***/ "./src/modules/vc_front_end_scripts.js":
/*!*********************************************!*\
  !*** ./src/modules/vc_front_end_scripts.js ***!
  \*********************************************/
/***/ (() => {

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

;
(function ($) {
  "use strict";

  // MutationSelectorObserver represents a selector and it's associated initialization callback.
  var MutationSelectorObserver = function (selector, callback) {
    this.selector = selector;
    this.callback = callback;
  };

  // List of MutationSelectorObservers.
  var msobservers = [];
  msobservers.initialize = function (selector, callback) {
    // Wrap the callback so that we can ensure that it is only
    // called once per element.
    var seen = [];
    var callbackOnce = function () {
      if (seen.indexOf(this) == -1) {
        seen.push(this);
        $(this).each(callback);
      }
    };

    // See if the selector matches any elements already on the page.
    $(selector).each(callbackOnce);

    // Then, add it to the list of selector observers.
    this.push(new MutationSelectorObserver(selector, callbackOnce));
  };

  // The MutationObserver watches for when new elements are added to the DOM.
  var observer = new MutationObserver(function (mutations) {
    // For each MutationSelectorObserver currently registered.
    for (var j = 0; j < msobservers.length; j++) {
      $(msobservers[j].selector).each(msobservers[j].callback);
    }
  });

  // Observe the entire document.
  observer.observe(document.documentElement, {
    childList: true,
    subtree: true,
    attributes: true
  });

  // Deprecated API (does not work with jQuery >= 3.1.1):
  $.fn.initialize = function (callback) {
    msobservers.initialize(this.selector, callback);
  };
  $.initialize = function (selector, callback) {
    msobservers.initialize(selector, callback);
  };
})(jQuery);
jQuery(document).ready(function ($) {
  /*--  Generate Custom CSS In Front End --*/

  $(".kdesk_custom").initialize(function () {
    var kdesk_css_string = "";
    $(".kdesk_custom").each(function () {
      if ($(this).data('custom_style') != "") {
        kdesk_css_string += $(this).data('custom_style');
      }
    });
    if ($('#kdesk-custom-css').length) {
      $('#kdesk-custom-css').remove();
    }
    $("<style data-type='kdesk-custom-css' id='kdesk-custom-css'>" + kdesk_css_string + "</style>").appendTo('head');
  });
});

/***/ }),

/***/ "./src/styles/frontend.scss":
/*!**********************************!*\
  !*** ./src/styles/frontend.scss ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ ((module) => {

"use strict";
module.exports = jQuery;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_frontend_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/frontend.scss */ "./src/styles/frontend.scss");
/* harmony import */ var _modules_public__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/public */ "./src/modules/public.js");
/* harmony import */ var _modules_vc_front_end_scripts__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/vc_front_end_scripts */ "./src/modules/vc_front_end_scripts.js");
/* harmony import */ var _modules_vc_front_end_scripts__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_modules_vc_front_end_scripts__WEBPACK_IMPORTED_MODULE_2__);
// Stylesheets


// Javascripts


})();

/******/ })()
;
//# sourceMappingURL=frontend.js.map