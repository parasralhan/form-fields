<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract;

class Select extends Input_Abstract {

  public function __construct( $args ) {

    parent::__construct( $args );

  }

    /**
    * --------------------------------------------------------------------------
    * Build Select input
    * --------------------------------------------------------------------------
    * 
    * @return: html 
   * */
  protected function _build_input() {
    ob_start();
    ?>

    <div 
      class="bonzer-inputs input-wrapper select-input-wapper" 
      data-inbuilt-options="<?php echo count( $this->_options ); ?>" 
      data-showif='<?php echo $this->_conditional_data(); ?>'
    >

      <?php $this->_label(); ?>

      <div>
        <select 
          id="<?php echo $this->_id; ?>" 
          name="<?php echo $this->_name; ?>" 
          class="input" 
          data-inputtype="select" 
          <?php echo $this->_additional_attrs; ?> 
        >

          <?php   

          if ( !empty( array_keys( $this->_options )[ 0 ] ) ) {
            echo '<option value="">Select…</option>';
          }   

          foreach ( $this->_options as $option_Key => $option_val ) {

            $selected = ( $this->_value == $option_Key ) ? 'selected="selected"' : '';

            echo "<option value='{$option_Key}' {$selected}>{$option_val}</option>";
          }

          ?>

        </select> 
      </div>
      
    </div>

    <?php    
    return ob_get_clean();

  }

}
