(function( $ ) {
	'use strict';

	$(window).load(function() {
		$(".wp-block-image-before-after-block").each( function() {
			var slider = $( this );
			slider.twentytwenty( {
				default_offset_pct: ( slider.data( "offset" ) / 100 ),
			    orientation: slider.data( "orientation" ),
			    before_label: slider.data( "before" ),
			    after_label: slider.data( "after" ),
			    no_overlay: slider.data( "overlay" ),
			    move_slider_on_hover: slider.data( "hover" ),
			    move_with_handle_only: slider.data( "handle" ),
			    click_to_move: slider.data( "click" )
			} );
		} );	
	});

})( jQuery );
