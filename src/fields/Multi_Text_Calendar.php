<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Multi_Text_Calendar extends Input_Abstract {

  public function __construct($args ) {

    parent::__construct( $args );

  }

  /**
    * --------------------------------------------------------------------------
    * Build Multi Text Calendar input
    * --------------------------------------------------------------------------
    *
    * @return: html
   * */
  protected function _build_input() {
    ob_start();
    ?>
    <div 
      class="bonzer-inputs input-wrapper multi-text-input-wapper multi-text-calendar-input-wapper" 
      data-showif='<?php echo $this->_conditional_data(); ?>'>
      
      <?php $this->_label(); ?>

      <div>
        <input 
          type="hidden" 
          id="<?php echo $this->_id; ?>_hidden" 
          name="<?php echo $this->_name; ?>" 
          class="input all-values" 
          value="<?php echo $this->_value; ?>"
        />

        <input 
          type="text" 
          id="<?php echo $this->_id; ?>" 
          class="input text calendar-input" 
          placeholder="<?php echo $this->_placeholder; ?>" 
          <?php echo $this->_additional_attrs; ?> 
        />

        <button 
          class="add button" 
          title="Add" 
          type="button"
        >
          <i class="fa fa-plus-circle"></i>&nbsp;
          <span class="text">Add</span>
        </button>
        
        <ul class="values-entered">
          <?php
          if ( ! empty( $this->_value ) ) {

            $values = explode( '|', $this->_value );

            array_walk( $values, function( $value ) {
              ?>
                <li class="inline" data-value="<?php echo $value; ?>">

                  <p class="value">
                    <i class="fa fa-times-circle"></i>&nbsp;
                    <?php echo $value; ?>
                  </p>

                </li>
              <?php
            } );
          }
          ?>
        </ul>
      </div>

    </div>

    <?php
    return ob_get_clean();

  }

}
