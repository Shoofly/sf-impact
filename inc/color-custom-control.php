<?php
/**
 * Dropdown Category Custom Control
 *
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */
?>
<?php
    if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

// See full blog post here
// http://pluto.kiwi.nz/2014/07/how-to-add-a-color-control-with-alphaopacity-to-the-wordpress-theme-customizer/
if (! class_exists ( 'pluto_add_customizer_custom_controls' )):
function pluto_add_customizer_custom_controls( $wp_customize ) {
    class Pluto_Customize_Alpha_Color_Control extends WP_Customize_Control {
    
        public $type = 'alphacolor';
        //public $palette = '#3FADD7,#555555,#666666, #F5f5f5,#333333,#404040,#2B4267';
        public $palette = true;
        public $default = '#3FADD7';
    
        protected function render() {
            $id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
            $class = 'customize-control customize-control-' . $this->type; ?>
            <li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
                <?php $this->render_content(); ?>
            </li>
        <?php }
    
        public function render_content() { ?>

         
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo $this->description?></span>
                <input type="text" data-palette="<?php echo $this->palette; ?>" data-default-color="<?php echo $this->default; ?>" value="<?php echo intval( $this->value() ); ?>" class="pluto-color-control" <?php $this->link(); ?>  />
            </label>
        <?php }
    }
}
endif;
add_action( 'customize_register', 'pluto_add_customizer_custom_controls' );
?>