<?php

namespace Bonzer\Inputs\fields;

use Bonzer\Inputs\contracts\Input_Abstract,
    Bonzer\IOC_Container\facades\Container as IOC_Container;

class Icon extends Input_Abstract {

  protected static $_icons_loaded = false;

  public function __construct( $args ) {
    parent::__construct( $args );
  }

  /**
   * --------------------------------------------------------------------------
   * Build Icon input
   * --------------------------------------------------------------------------
   *
   * @Return: html
   * */
  protected function _build_input() {

    ob_start();
    ?>
    <div class="bonzer-inputs input-wrapper icon-input-wapper" data-showif='<?php echo $this->_conditional_data(); ?>'>

      <label for="<?php echo $this->_id; ?>">
        <?php echo $this->_label; ?>
        <?php echo (isset_not_empty( $this->_desc )) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
      </label> 
      
      <div>
        <input type="text" id="<?php echo $this->_id; ?>" name="<?php echo $this->_name; ?>" class="icon-picker input" value="<?php echo $this->_value; ?>" placeholder="<?php echo $this->_placeholder; ?>" <?php echo $this->_additional_attrs; ?>>
        <span class="icon-holder">
          <i class="fa"></i>
        </span>

        <button class="remove button" title="Remove">
          <i class="fa fa-times-circle"></i> <span class="text">Remove</span>
        </button>

        <a class="close-popup" style="position:absolute;top:6px;right:6px;cursor:pointer;"><i class="fa fa-times"></i></a>
      </div>

    </div>

    <?php
    if ( !static::$_icons_loaded ) {
      $this->_build_icons_html();
      static::$_icons_loaded = true;
    }

    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }

  /**
   * --------------------------------------------------------------------------
   * Icons for Icon Input field
   * --------------------------------------------------------------------------
   * 
   * @Return void 
   * */
  protected function _build_icons_html() {
    $Icons = IOC_Container::make('Bonzer\Inputs\contracts\interfaces\Icons');
    $Icons->html();
  }

}
