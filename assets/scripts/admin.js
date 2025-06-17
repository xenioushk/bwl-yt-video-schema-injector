/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/admin/modules/admin_notice.js":
/*!*******************************************!*\
  !*** ./src/admin/modules/admin_notice.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ AdminNotice)
/* harmony export */ });
class AdminNotice {
  /**
   * Run when the document is ready.
   *
   * @return {void}
   */

  constructor() {
    // Use the globally loaded jQuery instance
    this.$ = window.jQuery;
    this.cache();
  }
  cache() {
    this.removeNoticeBtn = this.$(document).find(".bwl_remove_notice");
  }
  setNoticeStatus(key, nonce) {
    return this.$.ajax({
      type: "POST",
      url: KdeskAddonAdminData.ajaxurl,
      data: {
        action: "bwl_set_notice_status",
        noticeKey: key,
        nonce: nonce
      },
      dataType: "JSON"
    });
  }
  removeNotice() {
    if (this.removeNoticeBtn.length) {
      this.removeNoticeBtn.on("click", e => {
        e.preventDefault();
        const key = this.$(e.currentTarget).data("key");
        const nonce = this.$(e.currentTarget).data("nonce");
        this.$(e.currentTarget).closest(".notice").slideUp("slow", () => {
          // call the ajax request here to store the setting to DB.
          this.$.when(this.setNoticeStatus(key, nonce)).done(response_data => {
            // console.log(response_data)
          });
        });
      });
    }
  }

  // Run the functions.

  docReady() {
    this.removeNotice();
  }
}

/***/ }),

/***/ "./src/admin/modules/theme_purchase_verify.js":
/*!****************************************************!*\
  !*** ./src/admin/modules/theme_purchase_verify.js ***!
  \****************************************************/
/***/ (() => {

;
(function ($) {
  "use strict";

  $(function () {
    if ($("#bwl-theme-product-license").length) {
      let $licenseContainer = $("#bwl-theme-product-license");
      let $loader = $licenseContainer.find("#loader");
      function verifyMsg(msg, status) {
        let status_class = typeof status !== undefined && status == 0 ? "verify_error" : "verify_success";
        return "<p class='" + status_class + "'>" + msg + "</p>";
      }
      $loader.html("");
      if ($licenseContainer.find("#verify_purchase").length) {
        let $verifyPurchaseForm = $licenseContainer.find("#verify_purchase"),
          $purchase_code = $verifyPurchaseForm.find("#purchase_code"),
          $btn_verify = $verifyPurchaseForm.find("#verify"),
          $baf_form_group = $([]).add($purchase_code).add($btn_verify);

        // Initialize.
        $purchase_code.val("");
        function kdesk_verify_purchase_data() {
          return $.ajax({
            type: "POST",
            url: KdeskAddonAdminData.ajaxurl,
            data: {
              action: "BwlThemeVerifyPurchaseData",
              // this is the name of our WP AJAX function that we'll set up next
              purchase_code: $purchase_code.val()
            },
            dataType: "JSON"
          });
        }
        $verifyPurchaseForm.on("submit", function (e) {
          e.preventDefault();
          if ($purchase_code.val().trim() == "") {
            alert(KdeskAddonAdminData.pvc_required_msg);
            $purchase_code.val("");
            return false;
          }
          $baf_form_group.attr("disabled", "disabled");
          $loader.html("").html(KdeskAddonAdminData.text_loading);
          $.when(kdesk_verify_purchase_data()).done(function (response_data) {
            // console.log(response_data)
            if (response_data.status == 1) {
              // console.log(response_data)
              // $purchase_code.remove()
              $loader.html(verifyMsg(KdeskAddonAdminData.pvc_success_msg, response_data.status));
              setTimeout(() => {
                location.reload();
              }, 3000);
            } else {
              $loader.html(verifyMsg(KdeskAddonAdminData.pvc_failed_msg, 0));
              $purchase_code.val("");
              $baf_form_group.removeAttr("disabled");
            }
          });
        });
      }

      // Delete License.

      function baf_remove_license_data(verify_hash) {
        return $.ajax({
          type: "POST",
          url: KdeskAddonAdminData.ajaxurl,
          data: {
            action: "BwlThemeRemoveLicenseData",
            verify_hash: verify_hash
          },
          dataType: "JSON"
        });
      }
      $licenseContainer.find("#remove_license").on("click", function () {
        let $this = $(this);
        let remove_license = confirm(KdeskAddonAdminData.pvc_remove_msg);
        if (remove_license == true) {
          $loader.html(KdeskAddonAdminData.baf_text_loading);
          $this.attr("disabled", "disabled");
          $.when(baf_remove_license_data($this.data("verify_hash"))).done(response_data => {
            // console.log(response_data.status)
            if (response_data.status == 1) {
              $loader.html(verifyMsg(KdeskAddonAdminData.pvc_removed_msg, response_data.status));
              setTimeout(() => {
                location.reload();
              }, 3000);
            } else {
              $this.removeAttr("disabled");
            }
          });
        }
      });
    }
  });
})(jQuery);

/***/ }),

/***/ "./src/admin/modules/wp_bakery_license.js":
/*!************************************************!*\
  !*** ./src/admin/modules/wp_bakery_license.js ***!
  \************************************************/
/***/ (() => {

(function ($) {
  "use strict";

  $(function () {
    // Place your administration-specific JavaScript here

    if ($("#vc_license-activation-notice").length > 0) {
      $("#vc_license-activation-notice").remove();
    }
  });
})(jQuery);

/***/ }),

/***/ "./src/admin/modules/wp_bakery_suggestions.js":
/*!****************************************************!*\
  !*** ./src/admin/modules/wp_bakery_suggestions.js ***!
  \****************************************************/
/***/ (() => {

(function ($) {
  "use strict";

  $(function () {
    function bwl_split(val) {
      return val.trim().split(/\s+/);
    }
    function extractLast(term) {
      return bwl_split(term).pop();
    }
    var bwl_available_tags = ["section-content-block-minimal", "section-pure-white-bg", "section-secondary-bg", "section-black-overlay", "section-black-30-overlay", "section-black-50-overlay", "no-gutter", "horizontal-newsletter", "horizontal-newsletter-alt", "horizontal-newsletter-square-layout", "horizontal-newsletter-square-layout-alt", "horizontal-newsletter-semi-square-layout", "horizontal-newsletter-semi-square-layout-alt", "text-light-color", "text-dark-color", "theme-custom-text-shadow", "theme-border-size-1", "theme-semi-rounded-box", "text-capitalize", "theme-custom-box-shadow", "theme-custom-box-animation", "block-white-bg", "block-white-30-bg", "block-white-50-bg", "block-white-80-bg", "block-black-bg", "block-black-30-bg", "block-black-50-bg", "block-black-80-bg", "box-rounded-layout", "box-semi-rounded-layout", "sk-about-details", "price-stripped-item", "vbox_icon_square", "vbox-no-border", "vbox_bottom_left", "vbox_bottom_right", "btn-theme", "btn-theme-invert", "btn-theme-small", "btn-square", "btn-capitalize", "no-padding", "no-bottom-padding", "padding-left-0", "padding-right-0", "padding-all-4", "no-margin", "margin-top-rev-24", "margin-top-5", "margin-top-12", "margin-top-16", "margin-top-24", "margin-top-32", "margin-top-36", "margin-top-42", "margin-top-48", "margin-bottom-5", "margin-bottom-12", "margin-bottom-24", "margin-bottom-32", "margin-bottom-48", "margin-bottom-80"];
    $(".bwl_cont_ext")
    // don't navigate away from the field on tab when selecting an item
    .on("keydown", function (event) {
      if (event.keyCode === $.ui.keyCode.TAB && $(this).autocomplete("instance").menu.active) {
        event.preventDefault();
      }
    }).autocomplete({
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
      }
    });
  });
})(jQuery);

/***/ }),

/***/ "./src/admin/styles/admin.scss":
/*!*************************************!*\
  !*** ./src/admin/styles/admin.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


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
/*!**********************************!*\
  !*** ./src/admin/admin_index.js ***!
  \**********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_admin_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/admin.scss */ "./src/admin/styles/admin.scss");
/* harmony import */ var _modules_wp_bakery_license__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/wp_bakery_license */ "./src/admin/modules/wp_bakery_license.js");
/* harmony import */ var _modules_wp_bakery_license__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_modules_wp_bakery_license__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _modules_wp_bakery_suggestions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/wp_bakery_suggestions */ "./src/admin/modules/wp_bakery_suggestions.js");
/* harmony import */ var _modules_wp_bakery_suggestions__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_modules_wp_bakery_suggestions__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _modules_admin_notice__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/admin_notice */ "./src/admin/modules/admin_notice.js");
/* harmony import */ var _modules_theme_purchase_verify__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/theme_purchase_verify */ "./src/admin/modules/theme_purchase_verify.js");
/* harmony import */ var _modules_theme_purchase_verify__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_modules_theme_purchase_verify__WEBPACK_IMPORTED_MODULE_4__);
// Load Stylesheets.


// Load JavaScripts





new _modules_admin_notice__WEBPACK_IMPORTED_MODULE_3__["default"]().docReady();
})();

/******/ })()
;
//# sourceMappingURL=admin.js.map