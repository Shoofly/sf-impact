/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
 
( function( api ) {
	// Site title and description.
    api.controlConstructor.select = api.Control.extend( {
        ready: function() {
            this.setting.bind( 'change', function( value ) {
                
            } );
        }
    } );

    jQuery( function( $ ) {
        var demo_data_change = 0;
        var changed_elements = {};

        $('#customize-control-sf_impact_demo_data input').click(function() {
             
            demo_data_change = 1;
        });

        $('input[type=checkbox]').change(function() {
            val = $(this).attr('checked') == "checked"?1:0;
            console.log($(this).data('customize-setting-link'), 'changed', val);
            console.log(api());           
            changed_elements[$(this).data('customize-setting-link')] = val;
        });
        i=0;
        $('#save').click(function() {
            if (demo_data_change == 1) {
                var timer = window.setInterval(function() {
                    console.log( $('#save').html() );
                    i += 100;
                    if ( i > 1000 || $('#save').attr('disabled') ) {
                        window.clearInterval(timer);
                        location.reload();
                    }
                }, 100);
            }              
        });

    } );
} )( wp.customize );
