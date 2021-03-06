<?php
/**
 * Example file for WP_Yes Class.
 *
 * @link       https://github.com/sofyansitorus/WordPress-Yet-Easy-Settings
 * @since      1.0.0
 * @package    WP_Yes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! function_exists( 'wp_yes_custom_page_content_canvas' ) ) {
	/**
	 * Enqueue dependencies js scripts for chartjs.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function wp_yes_custom_page_content_canvas() {
		?>
		<div><canvas id="myChart" width="400" height="200"></canvas></div>
		<?php
	}
}


if ( ! function_exists( 'wp_yes_custom_page_content' ) ) {
	/**
	 * Example for custom admin page content
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function wp_yes_custom_page_content() {
		$settings = new WP_Yes(
			'wp_yes_custom_page_content',
			array(
				'callback' => 'wp_yes_custom_page_content_canvas',
			)
		); // Initialize the WP_Yes class.
		
		$settings->enqueue_script( 'chartjs', '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js', false, '2.7.1', true );

		$settings->init(); // Run the WP_Yes class.
	}
}
add_action( 'init', 'wp_yes_custom_page_content' );


if ( ! function_exists( 'wp_yes_custom_page_content_print_footer_js' ) ) {
	/**
	 * Enqueue dependencies js scripts for chartjs.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function wp_yes_custom_page_content_print_footer_js() {
		?>
		<script>
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
			// The type of chart we want to create
			type: 'line', // also try bar or other graph types

			// The data for our dataset
			data: {
				labels: ["Jun 2016", "Jul 2016", "Aug 2016", "Sep 2016", "Oct 2016", "Nov 2016", "Dec 2016", "Jan 2017", "Feb 2017", "Mar 2017", "Apr 2017", "May 2017"],
				// Information about the dataset
			datasets: [{
					label: "Rainfall",
					backgroundColor: 'lightblue',
					borderColor: 'royalblue',
					data: [26.4, 39.8, 66.8, 66.4, 40.6, 55.2, 77.4, 69.8, 57.8, 76, 110.8, 142.6],
				}]
			},

			// Configuration options
			options: {
			layout: {
			padding: 10,
			},
				legend: {
					position: 'bottom',
				},
				title: {
					display: true,
					text: 'Precipitation in Toronto'
				},
				scales: {
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Precipitation in mm'
						}
					}],
					xAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Month of the Year'
						}
					}]
				}
			}
		});
	</script>
		<?php
	}
}
add_action( 'wp_yes_wp_yes_custom_page_content_admin_footer_js', 'wp_yes_custom_page_content_print_footer_js' );
