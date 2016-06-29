<?php
/**
 * A list of various helper functions for WordPress.
 */

if ( ! function_exists( 'gambit_is_doing_excerpt' ) ) {

	/**
	 * Use this to check whether we are currently generating an excerpt
	 * in the WP lifecycle.
	 *
	 * @return bool True if we are currently generating an excerpt, false otherwise.
	 */
	function gambit_is_doing_excerpt() {
		return isset( $GLOBALS['_gambit_is_doing_excerpt'] );
	}
}

if ( ! function_exists( 'gambit_set_is_excerpt' ) ) {
	add_filter( 'get_the_excerpt', 'gambit_set_is_excerpt', 0 );
	add_filter( 'the_excerpt', 'gambit_set_is_excerpt', 0 );

	/**
	 * Does nothing but set a global variable to true, meaning we are
	 * currently generating an excerpt.
	 *
	 * @param string $text The excerpt.
	 *
	 * @return string The excerpt
	 */
	function gambit_set_is_excerpt( $text ) {
		$GLOBALS['_gambit_is_doing_excerpt'] = true;
		return $text;
	}
}

if ( ! function_exists( 'gambit_unset_is_excerpt' ) ) {
	add_filter( 'get_the_excerpt', 'gambit_unset_is_excerpt', 99999 );
	add_filter( 'the_excerpt', 'gambit_unset_is_excerpt', 99999 );

	/**
	 * Does nothing but unset a global variable, meaning we are
	 * gone generating an excerpt.
	 *
	 * @param string $text The excerpt.
	 *
	 * @return string The excerpt
	 */
	function gambit_unset_is_excerpt( $text ) {
		unset( $GLOBALS['_gambit_is_doing_excerpt'] );
		return $text;
	}
}


if ( ! function_exists( 'gambit_get_all_post_types' ) ) {
	/**
	 * Gets all post type slugs and their display names.
	 *
	 * @return array An associative array of all post type slugs and post type names.
	 */
	function gambit_get_all_post_types() {
		$args = array(
		   'public' => true,
		   '_builtin' => true,
		);
		$post_types = get_post_types( $args, 'objects' );

		$args = array(
		   'public' => true,
		   '_builtin' => false,
		);
		$post_types2 = get_post_types( $args, 'objects' );

		$post_types = array_merge( $post_types, $post_types2 );

		$ret = array();
		foreach ( $post_types as $post_type ) {

			$slugname = $post_type->name;

			$name = $post_type->name;
			if ( ! empty( $post_type->labels->singular_name ) ) {
				$name = $post_type->labels->singular_name . ' (' . $slugname . ')';
			}

			$ret[ $slugname ] = $name;
		}

		return $ret;
	}
}


if ( ! function_exists( 'gambit_get_current_url' ) ) {

	/**
	 * Gets the current URL.
	 *
	 * @return string The current URL.
	 */
	function gambit_get_current_url() {
		if ( ! is_main_query() && ! is_singular() ) {
			return trailingslashit( home_url( add_query_arg( null, null ) ) );
		}
		return trailingslashit( get_permalink( get_the_ID() ) );
	}
}


if ( ! function_exists( 'gambit_abbreviate_number' ) ) {

	/**
	 * Abbreviates a number with a unit. E.g. Converts 1100 to 1.1K
	 *
	 * @see http://stackoverflow.com/questions/13049851/php-number-abbreviator
	 *
	 * @param int $value The number to abbreviate.
	 *
	 * @return string The abbreviated number.
	 */
	function gambit_abbreviate_number( $value ) {

		$abbreviations = array(
			12 => 'T',
			9 => 'B',
			6 => 'M',
			3 => 'K',
			0 => '',
		);

		foreach ( $abbreviations as $exponent => $abbreviation ) {
			if ( $value >= pow( 10, $exponent ) ) {
				return round( floatval( $value / pow( 10, $exponent ) ), 1 ).$abbreviation;
			}
		}

		return $value;
	}
}


if ( ! function_exists( 'gambit_hex_to_rgb' ) ) {

	/**
	 * Converts a hex color to rgb values.
	 *
	 * @param string $hex The hexadecimal color valuess.
	 *
	 * @return array The individual r, g, b colors
	 */
	function gambit_hex_to_rgb( $hex ) {
		$hex = str_replace( '#', '', $hex );

		if ( 3 !== strlen( $hex ) ) {
			$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}

		return array( $r, $g, $b );
	}
}
