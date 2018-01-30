<?php
/**
 * Media Image Size Custom Control
 *
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

?>
<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 if (!class_exists('ImageSize_Dropdown_Custom_Control')):
 class ImageSize_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $sizes = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->sizes =  get_intermediate_image_sizes();
        
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->sizes))
            {
                ?>
                    <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                     <span class="description customize-control-description"><?php echo $this->description?></span>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->sizes as $size )
                                {
                                  
                                    printf('<option value="%s" %s>%s</option>', $size, selected($this->value(), $size, false), $size);
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
 }
 endif;
?>