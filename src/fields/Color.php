<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Color extends Input_Abstract {

  public function __construct( $args ) {

    parent::__construct( $args );

  }

  /**
    * --------------------------------------------------------------------------
    * Build Color input
    * --------------------------------------------------------------------------
    *
    * @Return: html
   * */
  protected function _build_input() {
    ob_start();
    ?>

    <div class="bonzer-inputs input-wrapper color-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>
      
      <label for="<?php echo $this->_id; ?>">
        <?php echo $this->_label; ?>
        <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
      </label> 

      <div>
        <input type="text" id="<?php echo $this->_id; ?>" name="<?php echo $this->_name; ?>" class="color-picker input" value="<?php echo $this->_value; ?>" placeholder="<?php echo $this->_placeholder; ?>" <?php echo $this->_additional_attrs; ?>>
        <button class="remove button" title="Remove" type="button"><i class="fa fa-times-circle"></i> <span class="text">Remove</span></button>
      </div>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;

  }

}
