<div class="wrap baf-about-wrap">

    <h2><?php echo $page_title; ?></h2>

    <div class="baf-about-container">
    <h2 class="nav-tab-wrapper">
        <a href="#baf-getting-started" class="nav-tab nav-tab-active">Getting Started</a>
        <a href="#baf-documentation" class="nav-tab">Documentation</a>
        <a href="#baf-support" class="nav-tab">Support</a>
    </h2>
    <div id="baf-getting-started" class="tab-content">
        <h2>Getting Started</h2>
        <ul class="tab-content__steps">

        <?php
        foreach ( $steps as $key => $step ) {
			?>

        <li>
            <p><span class="step_tag">Step <?php echo ++$key; ?>:</span> <?php echo $step['title']; ?></p>
            <img src="<?php echo BAF_LIBS_DIR . 'plugin-info/getting-started/' . $step['img']; ?>"
            alt="<?php echo $step['title']; ?>">
        </li>

			<?php

        }
        ?>

        </ul>
        <a href="<?php echo admin_url( 'post-new.php?post_type=bwl_advanced_faq' ); ?>"
        class="button button-primary">Create
        your first FAQ
        post</a>
    </div>
    <div id="baf-documentation" class="tab-content" style="display:none;">
        <h2>Documentation</h2>
        <p>You can check the plugin full documentation from <a
            href="https://xenioushk.github.io/docs-wp-plugins/baf/index.html" target="_blank">here</a>.</p>
    </div>
    <div id="baf-support" class="tab-content" style="display:none;">
        <h2>Support</h2>
        <p>
        Advanced FAQ Manager WordPress Plugin offers Six (06) months of premium support directly from the developer. We
        are committed to assisting our buyers, and most of the time, it takes less than 24 hours to reply to the support
        message. If you face any particular FAQ plugin issue, the developer will assist you in fixing the problem.
        Please send your support message via
        <a href="https://codecanyon.net/item/bwl-advanced-faq-manager/5007135/support/contact" target="_blank">support
            form</a>.
        </p>
    </div>
    </div>


</div>
