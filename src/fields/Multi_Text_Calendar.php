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
    * @Return: html
   * */
  protected function _build_input() {
    ob_start();
    ?>
    <div class="input-wrapper multi-text-input-wapper multi-text-calendar-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>
      <label for="<?php echo $this->_id; ?>"><?php echo $this->_label; ?></label>
      <input type="hidden" id="<?php echo $this->_id; ?>" name="<?php echo $this->_name; ?>" class="input all-values" value="<?php echo $this->_value; ?>">
      <input type="text" id="<?php echo $this->_id; ?>_text" class="input text calendar-input" placeholder="<?php echo $this->_placeholder; ?>" <?php echo $this->_additional_attrs; ?>>
      <button class="add button" type="button"><i class="fa fa-plus-circle"></i> Add</button>
      <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
      <ul class="values-entered">
        <?php
        if ( isset_not_empty( $this->_value ) ) {
          $values = explode( '|', $this->_value );
          array_walk( $values, function($value) {
            ?>
            <li class="inline" data-value="<?php echo $value; ?>">
              <p class="value"><?php fa_icon( 'times-circle' ); ?><?php echo $value; ?></p>
            </li>
            <?php
          } );
        }
        ?>
      </ul>
      <div class="clearfix"></div>
    </div>

    <?php
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;

  }

}
