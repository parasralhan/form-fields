<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract as Abstract_Input;

class Heading extends Input_Abstract {

  public function __construct( $args) {

    parent::__construct( $args );

  }

    /**
    * --------------------------------------------------------------------------
    * Build Heading input
    * --------------------------------------------------------------------------
    * 
    * @Return: html 
   * */
  protected function _build_input() {
    ob_start();
    ?>

    <div class="input-wrapper heading-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>
      <h3 class="section-heading" id="<?php echo $this->_id; ?>" <?php echo $this->_additional_attrs; ?>><?php echo $this->_value; ?></h3>
    <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;

  }

}
