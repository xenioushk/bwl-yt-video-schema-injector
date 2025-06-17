<?php

use BwlFaqManager\Controllers\Analytics\BafAnalyticsSummary;

?>
<!-- FAQs Summary -->

<div class="baf-analytics-list__card">

    <?php

	$bafAnalyticsSummaryData = new BafAnalyticsSummary();

	// Get All The FAQ Summary Data. (Total FAQs, Total Categories and Topics)
	$bafSummaryData = $bafAnalyticsSummaryData->register();

	$totalFaqs          = $bafSummaryData['totalFaqs']['published'] + $bafSummaryData['totalFaqs']['pending'];
	$totalFaqsPublished = $bafSummaryData['totalFaqs']['published'];
	$totalFaqsPending   = $bafSummaryData['totalFaqs']['pending'];
	$totalFaqsDraft     = $bafSummaryData['totalFaqs']['draft'];

	?>

    <h3>
    <span class="dashicons dashicons-analytics"></span><?php esc_html_e( 'FAQs Summary', 'bwl-adv-faq' ); ?>
    </h3>
    <ul class="with-count">
    <li>Total FAQs: <span class="count"><?php echo $totalFaqs; ?></span>
    </li>
    <li>Published: <span class="count"><a
            href="<?php echo admin_url(); ?>edit.php?post_status=publish&post_type=bwl_advanced_faq"><?php echo $totalFaqsPublished; ?></a></span>
    </li>
    <li>Pending: <span class="count"><a
            href="<?php echo admin_url(); ?>edit.php?post_status=pending&post_type=bwl_advanced_faq"><?php echo $totalFaqsPending; ?></a></span>
    <li>Darft: <span class="count"><a
            href="<?php echo admin_url(); ?>edit.php?post_status=draft&post_type=bwl_advanced_faq"><?php echo $totalFaqsDraft; ?></a></span>
    </li>
    <li>Categories: <span class="count"><?php echo $bafSummaryData['totalCategories']; ?></span></li>
    <li>Topics: <span class="count"><?php echo $bafSummaryData['totalTopics']; ?></span></li>
    <li>Total Likes: <span class="count"><?php echo $faqLikesCount['totalLikes']; ?></span></li>
    <li>Total Views: <span class="count"><?php echo $faqViewsCount['totalViews']; ?></span></li>
    </ul>


</div>
