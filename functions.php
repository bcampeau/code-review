<?php
/**
 * The base customizations for this theme.
 *
 * Holds a few custom functions intended solely for the LoopConf code review demo.
 *
 * @package WordPress
 */

/**
 * Returns all posts that are not tagged with the given color.
 *
 * @param string $color The color for the query.
 * @return array
 */
function standards_example_function( $color ) {
	$cache_key = 'color-transient-' . $color;

	if ( false === ( $posts = get_transient( $cache_key ) ) ) {
		$posts = get_posts( array(
			'meta_query' => array(
				array(
					'key' => 'color',
					'value' => $color,
					'compare' => 'NOT LIKE',
				),
			),
		) );

		set_transient( $cache_key, $posts, 900 );
	}

	return $posts;
}

/**
 * Saves a meta value on post save.
 *
 * @param int $post_id The post ID.
 */
function sanitization_example_function( $post_id ) {
	$sanitized_value = sanitize_text_field( wp_unslash( $_POST['some_key'] ) );
	update_post_meta( $post_id, 'some_key', $sanitized_value );
}
add_action( 'save_post', 'validation_example_function' );

/**
 * Displays a meta value.
 *
 * @param int $post_id The post ID.
 */
function escaping_example_function( $post_id ) {
	echo esc_html( get_post_meta( $post_id, 'some_key' ) );
}

/**
 * Gets paid posts if the user has a subscription.
 *
 * @return array
 */
function optimization_example_function() {
	$paid_posts = get_posts( array(
		'post_status' => 'publish',
		'post_type' => 'paid',
	) );

	if ( current_user_can( 'read_paid_posts' ) ) {
		return $paid_posts;
	} else {
		return array();
	}
}
