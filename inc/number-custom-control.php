<?php
    /**
 * Number & Range custom control
 * @package shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */
 
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
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
?>
