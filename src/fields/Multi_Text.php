<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Multi_Text extends Input_Abstract {

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

    <div class="bonzer-inputs input-wrapper multi-text-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>

      <label for="<?php echo $this->_id; ?>">
        <?php echo $this->_label; ?>
        <?php echo !empty( $this->_desc ) ? "<p class='desc'>{ $this->_desc }</p>" : ''; ?>
      </label> 

      <div>
        <input type="hidden" 
               id="<?php echo $this->_id; ?>_hidden" 
               name="<?php echo $this->_name; ?>" 
               class="input all-values" 
               value="<?php echo $this->_value; ?>">

        <input type="text" 
               id="<?php echo $this->_id; ?>" 
               class="input text" 
               placeholder="<?php echo $this->_placeholder; ?>" 
               <?php echo $this->_additional_attrs; ?> />

        <button class="add button" 
                title="Add" type="button">
                  <i class="fa fa-plus-circle"></i> <span class="text">Add</span>
        </button>

        <ul class="values-entered"></ul>

      </div>
    </div>

    <?php
    return ob_get_clean();

  }

}
