<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Radio extends Input_Abstract {

  public function __construct( $args ) {

    parent::__construct( $args);

  }

  /**
    * --------------------------------------------------------------------------
    * Build Radio input
    * --------------------------------------------------------------------------
    *
    * @return: html
   * */
  protected function _build_input() {
    
    ob_start();
    ?>

    <div 
      class="bonzer-inputs input-wrapper radio-input-wapper" 
      data-showif='<?php echo $this->_conditional_data(); ?>'
    >

      <?php $this->_label(); ?>
      
      <div>        
        <input 
          type="hidden" 
          id="<?php echo $this->_id; ?>" 
          name="<?php echo $this->_name; ?>" 
          class="input" 
          value="<?php echo $this->_value; ?>" 
          data-inputtype="radio"
        />     

        <div class="options">

          <?php
          foreach ( $this->_options as $option_Key => $option_val ) {

            $checked = ( $this->_value == $option_Key ) ? 'checked="checked"' : '';
            ?>
              <input 
                type="radio" 
                id="<?php echo $option_Key; ?>" 
                name="<?php echo $this->_name; ?>" 
                <?php echo $checked; ?> 
                class="radio-input" 
                value="<?php echo $option_Key; ?>" 
                <?php echo $this->_additional_attrs; ?> 
              />

              <label for="<?php echo $option_Key?>">
                <?php echo $option_val; ?>
              </label>

            <?php
          }
          ?>
          
        </div>
      </div>
      
    </div>

    <?php
    return ob_get_clean();

  }

}
