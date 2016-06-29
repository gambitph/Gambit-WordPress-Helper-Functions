# Gambit's WordPress Helper Functions
A collection of helper functions which we use in our various WordPress plugins and themes. Feel free to use them in your own.

# Usage
Require it in your WordPress project:

    require_once( 'gambit-helpers.php' );

Use it:

	add_filter( 'the_content', 'do_something_only_in_the_content_not_in_excerpts' );

	function do_something_only_in_the_content_not_in_excerpts( $content ) {
		if ( ! gambit_is_doing_excerpt() ) {
			$content .= 'I should only show up in post content and not excerpts.';
		}
		return $content;
	}

# Helper functions

| Helper Function | Returns | Description |
| --- | :---: | --- |
| `gambit_is_doing_excerpt()` | `boolean` | Returns `true` if currently creating an excerpt. |
| `gambit_get_all_post_types()` | `array` | Gets all the post types currently registered. Returns an associative array of all post type slugs and post type names. |
| `gambit_get_current_url()` | `string` | Gets the current URL. |
| `gambit_abbreviate_number($value)` | `string` | Abbreviates a number with a unit. E.g. Converts 1100 to 1.1K |
| `gambit_hex_to_rgb($hex)` | `array` | Converts a hex color `#ffffff` or `#fff` to rgb `array( 255, 255, 255 )` |
