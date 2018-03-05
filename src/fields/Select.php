<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Select extends Input_Abstract {

  public function __construct( $args ) {

    parent::__construct( $args );

  }

    /**
    * --------------------------------------------------------------------------
    * Build Select input
    * --------------------------------------------------------------------------
    * 
    * @Return: html 
   * */
  protected function _build_input() {
    ob_start();
    $class = $this->_additional_options_permitted ? 'additional-options' : '';
    ?>

    <div class="input-wrapper select-input-wapper <?php echo $class; ?>" data-inbuilt-options="<?php echo count($this->_options); ?>" data-showif='<?php echo $this->_conditional_data(); ?>'>

      <label for="<?php echo $this->_id; ?>"><?php echo $this->_label; ?></label>
      <select id="<?php echo $this->_id; ?>" name="<?php echo $this->_name; ?>" class="input" data-inputtype="select" <?php echo $this->_additional_attrs; ?>>
        <?php        
        if ( !empty( array_keys( $this->_options )[ 0 ] ) ) {
          echo '<option value="">'.__('Select...', 'charm').'</option>';
        }     
        foreach ( $this->_options as $option_Key => $option_val ) {
          $selected = ($this->_value == $option_Key) ? 'selected="selected"' : '';
          echo "<option value='{$option_Key}' {$selected}>{$option_val}</option>";
        }
        ?>
      </select> 
      <div class="clear"></div>
    <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
    </div>

    <?php    
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;

  }

}
