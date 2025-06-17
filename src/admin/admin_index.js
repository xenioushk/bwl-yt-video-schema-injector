// Load Stylesheets.
import "./styles/admin.scss"

// Load JavaScripts
import "./modules/wp_bakery_license"
import "./modules/wp_bakery_suggestions"
import "./modules/admin_notice"
import "./modules/theme_purchase_verify"

import AdminNotice from "./modules/admin_notice"
new AdminNotice().docReady()
