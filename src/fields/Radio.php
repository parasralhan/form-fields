<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract as Abstract_Input;

class Radio extends Abstract_Input {

  public function __construct( $args ) {

    parent::__construct( $args);

  }

  /**
    * --------------------------------------------------------------------------
    * Build Radio input
    * --------------------------------------------------------------------------
    *
    * @Return: html
   * */
  protected function _build_input() {
    ob_start();
    ?>

    <div class="input-wrapper radio-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>
      <label for="<?php echo $this->_id; ?>"><?php echo $this->_label; ?></label> 
      <input type="hidden" id="<?php echo $this->_id; ?>" name="<?php echo $this->_name; ?>" class="input" value="<?php echo $this->_value; ?>" data-inputtype="radio">       
      <div class="options">
        <?php
        foreach ( $this->_options as $option_Key => $option_val ) {
          $checked = ($this->_value == $option_Key) ? 'checked="checked"' : '';
          ?>
          <input type="radio" id="<?php echo $option_Key; ?>" name="<?php echo $this->_name; ?>" <?php echo $checked; ?> class="radio-input" value="<?php echo $option_Key; ?>" <?php echo $this->_additional_attrs; ?>>
          <label for="<?php echo $option_Key?>"><?php echo $option_val; ?></label>
          <?php
        }
        ?>

      </div>
      <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;

  }

}
