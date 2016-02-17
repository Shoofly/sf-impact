/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
 
( function( $ ) {
	// Site title and description.
        
    $('head').append('<style style="text/css" id="colorThemeStyle"> </style>');
    $('body').prepend('<style style="text/css" id="footerStyle"> </style>');
    $('body').append('<style style="text/css" id="headerStyle"> </style>');
    
    var colorThemeStyle = document.getElementById('colorThemeStyle'),
        footerStyle = document.getElementById('footerStyle'),
        headerStyle = document.getElementById('headerStyle');
    
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );
	
	//Custom CSS Header
	wp.customize( 'sf_impact_custom_head_css', function ( value ) {
    	value.bind( function( to ) {
            $(headerStyle).text( to );
    	} );
	} );
	
	//Custom CSS Footer
	wp.customize( 'sf_impact_custom_footer_css', function ( value ) {
    	value.bind( function( to ) {
        	$(footerStyle).text( to );
    	} );
	} );
		
	//Background Color
	wp.customize( 'sf_impact_color_scheme', function ( value ) {
    	value.bind( function( to ) {
        	var data = {action: 'customizer', sf_impact_color_scheme: to};
        	$.ajax({
            	type: "GET",
            	url: ajax_object.ajax_url, 
            	data: data,
            	success: function(response) {
            	    var msga = eval('(' + response + ')'),
            	        newPicker;
                    $(colorThemeStyle).text( msga.css + ' body { background-color: ' + msga.background_color + '; }' );
                },
                error: function(response) {
                    console.log("error: " + response);
                }
            });	
    	});
	});	

} )( jQuery );
