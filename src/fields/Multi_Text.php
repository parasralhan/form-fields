<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract as Abstract_Input;

class Multi_Text extends Abstract_Input {

  public function __construct( $args ) {

    parent::__construct( $args );

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

    <div class="input-wrapper multi-text-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>
      <label for="<?php echo $this->_id; ?>"><?php echo $this->_label; ?></label>
      <input type="hidden" id="<?php echo $this->_id; ?>" name="<?php echo $this->_name; ?>" class="input all-values" value="<?php echo $this->_value; ?>">
      <input type="text" class="input text" placeholder="<?php echo $this->_label; ?>" <?php echo $this->_additional_attrs; ?>>
      <button class="add button" type="button"><i class="fa fa-plus-circle"></i> Add</button>
      <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
      <ul class="values-entered">
      </ul>
      <div class="clear"></div>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;

  }

}
