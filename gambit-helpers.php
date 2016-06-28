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
