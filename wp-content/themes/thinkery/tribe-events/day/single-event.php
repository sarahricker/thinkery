<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h3 class="tribe-events-list-event-title summary">
		<?php the_title() ?>
</h3>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<!-- Event Meta -->
<?php do_action( 'tribe_events_before_the_meta' ) ?>
<div class="tribe-events-event-meta <?php echo esc_attr( $has_venue . $has_venue_address ); ?>">

	<!-- Schedule & Recurrence Details -->
	<div class="tribe-updated published time-details">
		<?php echo tribe_events_event_schedule_details(); ?>
	</div>

</div><!-- .tribe-events-event-meta -->

<?php do_action( 'tribe_events_after_the_meta' ) ?>

<!-- Event Image -->
<?php // echo tribe_event_featured_image( null, 'medium' ); ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
	<?php echo tribe_events_get_the_excerpt(); ?>
</div><!-- .tribe-events-list-event-description -->
<?php
do_action( 'tribe_events_after_the_content' );
?>