<?php
if ( ! function_exists( 'truncate_post' ) ) {

	function truncate_post( $amount, $echo = true, $post = '', $strip_shortcodes = false ) {
		global $shortname;

		if ( '' == $post ) global $post;

		$post_excerpt = '';
		$post_excerpt = apply_filters( 'the_excerpt', $post->post_excerpt );

		if ( 'on' == et_get_option( $shortname . '_use_excerpt' ) && '' != $post_excerpt ) {
			if ( $echo ) echo $post_excerpt;
			else return $post_excerpt;
		} else {
			// get the post content
			$truncate = $post->post_content;

			// remove caption shortcode from the post content
			$truncate = preg_replace( '@\[caption[^\]]*?\].*?\[\/caption]@si', '', $truncate );

			// remove post nav shortcode from the post content
			$truncate = preg_replace( '@\[et_pb_post_nav[^\]]*?\].*?\[\/et_pb_post_nav]@si', '', $truncate );

			// Remove audio shortcode from post content to prevent unwanted audio file on the excerpt
			// due to unparsed audio shortcode
			$truncate = preg_replace( '@\[audio[^\]]*?\].*?\[\/audio]@si', '', $truncate );

			// Remove embed shortcode from post content
			$truncate = preg_replace( '@\[embed[^\]]*?\].*?\[\/embed]@si', '', $truncate );

			if ( $strip_shortcodes ) {
				$truncate = et_strip_shortcodes( $truncate );
			} else {
				// apply content filters
				$truncate = apply_filters( 'the_content', $truncate );
			}

			// decide if we need to append dots at the end of the string
			// if ( strlen( $truncate ) <= $amount ) {
			// 	$echo_out = '';
			// } else {
			// 	$echo_out = '...';
			// 	// $amount = $amount - 3;
			// }

			// trim text to a certain number of characters, also remove spaces from the end of a string ( space counts as a character )
			$truncate = rtrim( et_wp_trim_words( $truncate, $amount, '' ) );

			// remove the last word to make sure we display all words correctly
			if ( '' != $echo_out ) {
				$new_words_array = (array) explode( ' ', $truncate );
				array_pop( $new_words_array );

				$truncate = implode( ' ', $new_words_array );

				// append dots to the end of the string
				$truncate .= $echo_out;
			}

			if ( $echo ) echo $truncate;
			else return $truncate;
		};
	}

}
?>
