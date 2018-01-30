<?php
/**
 * Arbitrarcy Custom Controls
 *
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */
 ?>
<?php
    defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Arbitrary_Custom_Control' ) ) :
class Arbitrary_Custom_Control extends WP_Customize_Control {

	// Whitelist content parameter
	public $content = '';
    public $class = '';
    public $style= '';
	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	public function render_content() {
        if ($this->style != '')
            $style = "style='$this->style'";
        else
            $style = "";
        switch ( $this->type ) {
             default:
            case 'text' :
                echo "<p class='customize-control-text description' $style>$this->label</p>";
                break;
    
            case "h1":
            case "h2": 
            case "h3":
            case "h4":
            case "h5":
            case "h6":
                echo "<$this->type class=customize-control-$this->type $style>" . esc_html( $this->label ) . "</$this->type>";
                break;
            case 'heading':
                echo "<span class='customize-control-title' $style>" . esc_html( $this->label ) . '</span>';
                break;
            case "line":
            if ($style = '') $style="style='margin-top:15px;'";
                
             echo "<hr  $style />";
        
        }
    
 
	}
}
endif;
?>