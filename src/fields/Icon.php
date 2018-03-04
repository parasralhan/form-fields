<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract as Abstract_Input;

class Icon extends Abstract_Input {

  public function __construct( $args ) {
    parent::__construct( $args );
  }

  /**
    * --------------------------------------------------------------------------
    * Build Icon input
    * --------------------------------------------------------------------------
    *
    * @Return: html
   * */
  protected function _build_input() {

    ob_start();
    ?>
    <div class="input-wrapper icon-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>
      <label for="<?php echo $this->_id; ?>"><?php echo $this->_label; ?></label>
      <input type="text" id="<?php echo $this->_id; ?>" name="<?php echo $this->_name; ?>" class="icon-picker input" value="<?php echo $this->_value; ?>" placeholder="<?php echo $this->_placeholder; ?>" <?php echo $this->_additional_attrs; ?>>
      <span class="icon-holder">
        <i class="fa"></i>
      </span>
      <button class="remove button">
        <i class="fa fa-times-circle"></i> Remove
      </button>
      <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
      <a class="close-popup" style="position:absolute;top:6px;right:6px;cursor:pointer;"><i class="fa fa-times"></i></a>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }

}
