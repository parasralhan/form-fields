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
    * @return: html 
   * */
  protected function _build_input() {
    ob_start();
    ?>

    <div 
      class="bonzer-inputs input-wrapper text-input-wapper" 
      data-showif='<?php echo $this->_conditional_data(); ?>'
    >
      
      <?php $this->_label(); ?>
      
      <div>
        <input type="text" 
               id="<?php echo $this->_id; ?>" 
               class="input" 
               name="<?php echo $this->_name; ?>" 
               value="<?php echo $this->_value; ?>" 
               placeholder="<?php echo $this->_placeholder; ?>" 
               <?php echo $this->_additional_attrs; ?> />
               
        <?php $this->_remove_btn(); ?>
      </div>

    </div>

    <?php
    return ob_get_clean();

  }

}
