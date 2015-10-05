<?php
/**
 * Page dropdown list Custom Control
 *
 *
 * @package shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */

?>
<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a dropdown for all categories in your wordpress site
 */
 if (!class_exists('Page_Dropdown_Custom_Control')):
 class Page_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $pages = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->pages = get_pages($options);

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the Page dropdown
     *
     * @return HTML
     */
    public function render_content()
       {
            if(!empty($this->pages))
            {
                ?>
                    <label>
                     <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                     <span class="description customize-control-description"><?php echo $this->description?></span>
             
                      <select <?php $this->link(); ?>>
                         
                           <?php
                               
                                foreach ( $this->pages as $page )
                                {
                                   
                                    printf('<option value="%s" %s>%s</option>', $page->ID, selected($this->value(), $page->post_id, false), $page->post_title);
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