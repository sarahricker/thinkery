<?php
/**
 * Day View Title Template
 * The title template for the day view of events.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/title-bar.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 * @since   4.6.19
 *
 */
?>

<div class="tribe-events-title-bar">

	<!-- Day Title -->
	<?php do_action( 'tribe_events_before_the_title' ); ?>
	<h1 class="tribe-events-page-title"><?php _e( 'Today\'s Events', 'the-events-calendar' ); ?><span class="date"><?php echo date("l, F j, Y");?></span></h1>
	<?php do_action( 'tribe_events_after_the_title' ); ?>

</div>
