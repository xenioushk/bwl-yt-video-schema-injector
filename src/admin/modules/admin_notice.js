export default class AdminNotice {
  /**
   * Run when the document is ready.
   *
   * @return {void}
   */

  constructor() {
    // Use the globally loaded jQuery instance
    this.$ = window.jQuery
    this.cache()
  }

  cache() {
    this.removeNoticeBtn = this.$(document).find(".bwl_remove_notice")
  }

  setNoticeStatus(key, nonce) {
    return this.$.ajax({
      type: "POST",
      url: KdeskAddonAdminData.ajaxurl,
      data: {
        action: "bwl_set_notice_status",
        noticeKey: key,
        nonce: nonce,
      },
      dataType: "JSON",
    })
  }

  removeNotice() {
    if (this.removeNoticeBtn.length) {
      this.removeNoticeBtn.on("click", (e) => {
        e.preventDefault()
        const key = this.$(e.currentTarget).data("key")
        const nonce = this.$(e.currentTarget).data("nonce")

        this.$(e.currentTarget)
          .closest(".notice")
          .slideUp("slow", () => {
            // call the ajax request here to store the setting to DB.
            this.$.when(this.setNoticeStatus(key, nonce)).done((response_data) => {
              // console.log(response_data)
            })
          })
      })
    }
  }

  // Run the functions.

  docReady() {
    this.removeNotice()
  }
}
