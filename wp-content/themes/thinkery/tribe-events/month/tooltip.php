<?php
/**
 * Please see single-event.php in this directory for detailed instructions
 * on how to use and modify these templates.
 *
 * Overrides the core Tooltip template from the-events-calendar
 *
 * @version 4.6.21
 * @package thinkery
 */

?>

<script type="text/html" id="tribe_tmpl_tooltip">
	<div id="tribe-events-tooltip-[[=eventId]]" class="tribe-events-tooltip">
		<h3 class="entry-title summary"><a href="[[=permalink]]">[[=raw title]]<\/a><\/h3>

		<div class="tribe-events-event-body">
			<div class="tribe-event-duration">
				<abbr class="tribe-events-abbr tribe-event-date-start">[[=dateDisplay]] <\/abbr>
			<\/div>
			[[ if(imageTooltipSrc.length) { ]]
				<div class="tribe-events-event-thumb">
					<img src="[[=imageTooltipSrc]]" alt="[[=title]]" \/>
				<\/div>
			[[ } ]]
			[[ if(excerpt.length) { ]]
				<div class="tribe-event-description">
					[[=raw excerpt]]

				<\/div>
			[[ } ]]
			<div class="tribe-event-link">
				<p><a href="[[=permalink]]">Learn More<\/a><\/p>
			<\/div>
			<span class="tribe-events-arrow"><\/span>
		<\/div>
	<\/div>
</script>

<script type="text/html" id="tribe_tmpl_tooltip_featured">
	<div id="tribe-events-tooltip-[[=eventId]]" class="tribe-events-tooltip tribe-event-featured">
		[[ if(imageTooltipSrc.length) { ]]
			<div class="tribe-events-event-thumb">
				<img src="[[=imageTooltipSrc]]" alt="[[=title]]" \/>
			<\/div>
		[[ } ]]

		<h3 class="entry-title summary"><a href="[[=permalink]]">[[=raw title]]<\/a><\/h3>

		<div class="tribe-events-event-body">
			<div class="tribe-event-duration">
				<abbr class="tribe-events-abbr tribe-event-date-start">[[=dateDisplay]] <\/abbr>
			<\/div>

			[[ if(excerpt.length) { ]]
			<div class="tribe-event-description">[[=raw excerpt]]<\/div>
			[[ } ]]
			<div class="tribe-event-link">
				<p><a href="[[=permalink]]">Learn More<\/a><\/p>
			<\/div>
			<span class="tribe-events-arrow"><\/span>
		<\/div>
	<\/div>
</script>
