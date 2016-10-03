<?php
/**
 * Returns all posts that are not tagged with the given color.
 *
 * @param string $color
 * @return array
 */
function standards_example_function( $color ) {
	return get_posts( array(
		'meta_query' => array(
			array(
				'key' => 'color',
				'value' => $color,
				'compare' => 'NOT LIKE',
			),
		),
	) );
}
