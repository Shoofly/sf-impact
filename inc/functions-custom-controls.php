<?php
if ( class_exists( 'WP_Customize_Control' ) ):
	/**
	    * Render the control's content.
	    *
	    * Allows the content to be overriden without having to rewrite the wrapper.
	    * Return Void
	    */
    if (!class_exists( 'Arbitrary_Custom_Control' ) ) :
        class Arbitrary_Custom_Control extends WP_Customize_Control {

	        // Whitelist content parameter
	        public $content = '';
            public $color = '';
            
	        public function render_content() {
                $style = "";
                if ($this->color)
                {
                    $style="style='color:$color;'";
                }
                switch ( strtolower($this->type) ) {
                    case 'line':
                        if ($style) $stlye.="margin-top:15px;"; else $style="style='margin-top:15px;";
                        echo "<hr class='customize-line' $style/>";
                        break;
                    case 'label':
                        echo "<label class='customize-label' $style>$this->label</label>";       
                    case "h1":  
                    case "h2": 
                    case "h3": 
                    case "h4": 
                    case "h5": 
                    case "h6":
                        echo "<$this->type class='customize-$this->type $style>" . esc_html( $this->label ) . "</$this->type>";
                        break;
                    case 'heading':
                        echo "<span class='customize-control-title' $style> " . esc_html( $this->label ) . '</span>';
                        break;
                    default:
                    case 'text':
                        echo '<p class="customize-description description"' . $style . '>' . $this->label . '</p>';
                        break;
                }
    
 
	        }
        }
    endif;
    /**
     * A class to render a dropdown for all categories in your wordpress site
     */
     if (! class_exists ( 'Category_Dropdown_Custom_Control' )):
     class Category_Dropdown_Custom_Control extends WP_Customize_Control
     {
        private $cats = false;

        public function __construct($manager, $id, $args = array(), $options = array())
        {
            $this->cats = get_categories($options);

            parent::__construct( $manager, $id, $args );
        }

        /**
         * Render the content of the category dropdown
         *
         * @return HTML
         */
        public function render_content()
           {
                if(!empty($this->cats))
                {
                    ?>

                        <label>
                         <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                         <span class="description customize-control-description"><?php echo $this->description?></span>

              
                          <select <?php $this->link(); ?>>

                               <?php
                                    printf('<option value="0" %s>All</option>', selected($this->value(), 0, false));
                                    foreach ( $this->cats as $cat )
                                    {
                                        printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
                                    }
                               ?>
                          </select>
                        </label>
                    <?php
                }
           }
     }
     endif;


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


    /**
     * A class to render a dropdown for all categories in your wordpress site 
     * Returns Html
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
    /*
    * A class to create number & range controls
    * Returns Html
    */
    if (!class_exists('Number_Custom_Control')):
    class Number_Custom_Control extends WP_Customize_Control 
    {

	    public $type = 'number';
	    public $max;
        public $min;
        public $id="";
	    public function render_content() 
        {
         $max = (isset($this->max)) ? 'max="' . strval($this->max).'"'  : '';
         $min = (isset($this->min)) ? 'min="' . strval($this->min).'"'  : '';
         $idx = (isset($this->id)) ? 'id="' . $this->id . '"' : '';
         $namex = (isset($this->id)) ? 'name="' . $this->id . '"' : '';
         if (isset($this->id) && $this->type == 'range')
         {
             $xid = $this->id;
             $js = "oninput='$xid" ."_o.value=$xid " .".value'";
         }
         else
            $js = '';
	    ?>
		    <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo $this->description?></span>
			    <input <?php echo $namex?> <?php echo $idx?>" type="<?php echo $this->type ?>" <?php echo $this->link(); ?> <?php echo $min ?> <?php echo $max ?> value="<?php echo intval( $this->value() ); ?>" <?php  echo $js  ?> />
                <?php if ($this->type == 'range' && isset($this->id))
                {?>  
                    <output name="amount" id="<?php echo $this->id ?>_o"><?php echo intval( $this->value() ); ?></output>
                <?php
                }
                ?>
		    </label>
	    <?php
        }
    }
    endif;

    /*
     * A class to rencer a dropdown for all categories in your wordpress site
     *  @return HTML
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
endif;
?>

