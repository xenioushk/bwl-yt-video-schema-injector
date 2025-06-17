<div class="baf-analytics-list__card baf-analytics-list__chartbox">
    <?php

    use BwlFaqManager\Controllers\Analytics\BafAnalyticsLikesCount;
    use BwlFaqManager\Helpers\FaqHelper;

    $bafAnalyticsLikesCountData = new BafAnalyticsLikesCount();
    $allFaqs                    = FaqHelper::get_all_published_faqs( [ 'orderby' => 'title', 'order' => 'ASC' ] );

    $chartData['products'] = [];
    $chartData['itemId']   = 1;

    // Filter Options.

    $selectedFilterType = $_GET['filter_type'] ?? 'views';
    $filterTypeOptions  = [ 'views', 'likes' ];

    $selectedRange     = $_GET['date_range'] ?? 7;
    $filterDateOptions = [
		[
			'text'  => '1 day',
			'value' => 1,
		],
		[
			'text'  => '7 days',
			'value' => 7,
		],
		[
			'text'  => '15 days',
			'value' => 15,
		],
		[
			'text'  => '30 days',
			'value' => 30,
		],
		[
			'text'  => '60 days',
			'value' => 60,
		],
		[
			'text'  => '90 days',
			'value' => 90,
		],
		[
			'text'  => '180 days',
			'value' => 180,
		],
		[
			'text'  => 'Lifetime',
			'value' => 9500,
		],
    ];

    $selectedFaqId = $_GET['faq_id'] ?? 'all';

    $chartDateGroup       = [];
    $chartTotalCountsData = [];

    $analyticsReportData = $bafAnalyticsLikesCountData->getAnalyticsReportData( $selectedFilterType );

    if ( sizeof( $analyticsReportData ) > 0 ) {
		foreach ( $analyticsReportData as $data ) {

			if ( ! empty( $data['date_group'] ) ) {
				$date             = new DateTime( $data['date_group'] );
				$chartDateGroup[] = $date->format( 'd-m-Y' );
			}


			$chartTotalCountsData[] = $data['total_counts'];
		}
    }

	?>

    <form method="GET" action="<?php echo admin_url( 'edit.php' ); ?>" class="analytics-product-form">
    <input type="hidden" name="page" value="bwl-advanced-faq-analytics">
    <input type="hidden" name="post_type" value="<?php echo BAF_POST_TYPE; ?>">

    <select name="filter_type" id="filter_type">
        <!-- <option value=""><?php esc_html_e( 'Filter Type', 'bwl-adv-faq' ); ?></option> -->
        <?php if ( sizeof( $filterTypeOptions ) > 0 ) : foreach ( $filterTypeOptions as $option ) : ?>
        <option value="<?php echo $option; ?>" <?php echo ( $selectedFilterType == $option ) ? 'selected' : ''; ?>>
				<?php echo ucfirst( $option ); ?>
        </option>
				<?php
        endforeach;
        endif;
		?>
    </select>

    <select name="date_range" id="date_range">
        <!-- <option value=""><?php esc_html_e( 'Date Range Filter', 'bwl-adv-faq' ); ?></option> -->
        <?php if ( sizeof( $filterDateOptions ) > 0 ) : foreach ( $filterDateOptions as $option ) : ?>
        <option value="<?php echo $option['value']; ?>"
				<?php echo ( $selectedRange == $option['value'] ) ? 'selected' : ''; ?>>
				<?php echo $option['text']; ?>
        </option>
				<?php
        endforeach;
        endif;
		?>
    </select>


    <!-- <label for="faq_id">Select FAQ:</label> -->
    <select name="faq_id" id="faq_id">
        <option value="all"><?php esc_html_e( 'Select FAQ', 'bwl-adv-faq' ); ?></option>

        <?php if ( sizeof( $allFaqs ) > 0 ) : foreach ( $allFaqs as $faq ) : ?>
        <option value="<?php echo $faq->ID; ?>" <?php echo ( $selectedFaqId == $faq->ID ) ? 'selected' : ''; ?>>
				<?php echo $faq->post_title; ?>
        </option>
				<?php
        endforeach;
        endif;
		?>

    </select>
    <input type="submit" class="button button-primary button-large"
        value="<?php esc_html_e( 'Generate', 'bwl-adv-faq' ); ?>">
    </form>
    <?php if ( $chartData['itemId'] != 0 ) : ?>
    <!-- // stop work -->
    <div id="analyticsData" data-dategroup="<?php echo implode( ',', $chartDateGroup ); ?>"
    data-totalcounts="<?php echo implode( ',', $chartTotalCountsData ); ?>"
    data-filtertype="<?php echo $selectedFilterType; ?>" class="analytics-canvas-container">
    <canvas id="analyticsChart"></canvas>
    </div>
    <?php else : ?>
    <div>Select A FAQ</div>
    <?php endif; ?>

</div>
