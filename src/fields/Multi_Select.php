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

    <div class="bonzer-inputs input-wrapper multi-select-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>

      <label for="<?php echo $this->_id; ?>">
        <?php echo $this->_label; ?>
        <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
      </label> 

      <div>
        <select name="<?php echo $this->_name; ?>" id="<?php echo $this->_id; ?>" class="multiselect" data-select="multiple" multiple data-placeholder="Choose..." <?php echo $this->_additional_attrs; ?> data-inputtype="select">
          <?php
          $all_values = $this->_value ? explode( ',', $this->_value ): [];
          
          foreach ( $this->_options as $option_Key => $option_val ) {        
            $selected[ $option_Key ] = '';
            if ( is_array( $all_values ) ) {
              foreach ( $all_values as $value ) {
                $selected[ $value ] = ($value == $option_Key) ? 'selected="selected"' : '';
              }
            }
            $selected_value = (isset_not_empty( $selected[ $option_Key ] )) ? $selected[ $option_Key ] : '';
            echo "<option value='{$option_Key}' {$selected_value}>{$option_val}</option>";
          }
          ?>
        </select>
        <input type="hidden" name="<?php echo $this->_name; ?>" id="<?php echo $this->_id; ?>" class="input" value="<?php echo $this->_value; ?>" data-inputtype="select">
        <button class="remove button"><i class="fa fa-times-circle"></i> Remove</button>
      </div>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }

}
