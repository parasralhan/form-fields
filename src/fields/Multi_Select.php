<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Multi_Select extends Input_Abstract {

  public function __construct( $args ) {

    parent::__construct( $args );
  }

  protected function _build_input() {
    ob_start();
    ?>

    <div 
      class="bonzer-inputs input-wrapper multi-select-input-wapper" 
      data-showif='<?php echo $this->_conditional_data(); ?>'
    >

      <?php $this->_label(); ?>

      <div>
        <select 
          name="<?php echo $this->_name; ?>" 
          id="<?php echo $this->_id; ?>" 
          class="multiselect" 
          data-select="multiple" multiple 
          data-placeholder="Choose..." 
          <?php echo $this->_additional_attrs; ?> 
          data-inputtype="select"
        >
          <?php

          $all_values = $this->_value ? explode( ',', $this->_value ): [];    

          foreach ( $this->_options as $option_Key => $option_val ) {   

            $selected[ $option_Key ] = '';

            if ( is_array( $all_values ) ) {

              foreach ( $all_values as $value ) {
                $selected[ $value ] = ( $value == $option_Key ) ? 'selected="selected"' : '';
              }

            }

            $selected_value = isset( $selected[ $option_Key ] ) && !empty( $selected[ $option_Key ] ) ? $selected[ $option_Key ] : '';

            echo "<option value='{$option_Key}' {$selected_value}>{$option_val}</option>";
          }

          ?>
        </select>

        <input 
          type="hidden" 
          name="<?php echo $this->_name; ?>" 
          id="<?php echo $this->_id; ?>" 
          class="input" 
          value="<?php echo $this->_value; ?>" 
          data-inputtype="select"
        />

        <?php $this->_remove_btn(); ?>
        
      </div>
    </div>

    <?php
    return ob_get_clean();
  }

}
