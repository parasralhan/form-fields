<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Checkbox extends Input_Abstract {

  public function __construct( $args ) {

    parent::__construct( $args );
  }

  /**
    * --------------------------------------------------------------------------
    * Build Checkbox input
    * --------------------------------------------------------------------------
    *
    * @Return: html
   * */
  protected function _build_input() {
    ob_start();
    ?>

    <div class="input-wrapper checkbox-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>
      <?php
      $checked = ($this->_value == 'yes') ? 'checked="checked"' : '';
      $value = ($this->_value == 'yes') ? 'yes' : 'no';
      ?>
      <input type="checkbox" id="<?php echo $this->_id; ?>" class="input checkbox-input" name="<?php echo $this->_name; ?>" value="<?php echo $value; ?>" <?php echo $checked ?> data-inputtype="checkbox" <?php echo $this->_additional_attrs; ?>>
      <label for="<?php echo $this->_id; ?>"><?php echo $this->_label; ?></label>
      <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }

}
