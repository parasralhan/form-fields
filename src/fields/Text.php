<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Text extends Input_Abstract {

  public function __construct( $args) {

    parent::__construct( $args);

  }

    /**
    * --------------------------------------------------------------------------
    * Build Text input
    * --------------------------------------------------------------------------
    * 
    * @Return: html 
   * */
  protected function _build_input() {
    ob_start();
    ?>

    <div class="bonzer-inputs input-wrapper text-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>
      <label for="<?php echo $this->_id; ?>"><?php echo $this->_label; ?></label>
      <input type="text" id="<?php echo $this->_id; ?>" class="input" name="<?php echo $this->_name; ?>" value="<?php echo $this->_value; ?>" placeholder="<?php echo $this->_placeholder; ?>" <?php echo $this->_additional_attrs; ?>>
      <button class="remove button" title="Remove" type="button"><i class="fa fa-times-circle"></i> <span class="text">Remove</span></button>
    <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
    <div class="clear"></div>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;

  }

}
