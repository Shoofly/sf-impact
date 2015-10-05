<?php
/**
 * Arbitrarcy Custom Controls
 *
 *
 * @package shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */
 ?>
<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Arbitrary_Custom_Control' ) ) :
class Arbitrary_Custom_Control extends WP_Customize_Control {

	// Whitelist content parameter
	public $content = '';

	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	public function render_content() {

        switch ( $this->type ) {
            default:
            case 'text' :
                echo '<p class="description">' . $this->label . '</p>';
                break;
            case "h1"  || "h2" || "h3" || "h4" || "h5" || "h6":
                echo "<$this->type>" . esc_html( $this->label ) . "</$this->type>";
                break;
            case 'heading':
                echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
                break;
 
        
        }
    
 
	}
}
endif;


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Arbitrary_Custom_Line' ) ) :
class Arbitrary_Custom_Line extends WP_Customize_Control {

	// Whitelist content parameter
	public $content = '';


	public function render_content() {
 
                echo '<hr style="margin-top:15px;" />';
             
        
	}
}
endif;
?>