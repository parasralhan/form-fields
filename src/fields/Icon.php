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
   * @return: html
   * */
  protected function _build_input() {

    ob_start();
    ?>
    <div 
      class="bonzer-inputs input-wrapper icon-input-wapper" 
      data-showif='<?php echo $this->_conditional_data(); ?>'
    >

      <?php $this->_label(); ?>
      
      <div>

        <input 
          type="text" 
          id="<?php echo $this->_id; ?>" 
          name="<?php echo $this->_name; ?>" 
          class="icon-picker input" 
          value="<?php echo $this->_value; ?>" 
          placeholder="<?php echo $this->_placeholder; ?>" 
          <?php echo $this->_additional_attrs; ?> 
        />

        <span class="icon-holder">
          <i class="fa"></i>
        </span>

        <?php $this->_remove_btn(); ?>

        <a class="close-popup" style="position:absolute;top:6px;right:6px;cursor:pointer;"><i class="fa fa-times"></i></a>

      </div>

    </div>

    <?php
    if ( ! static::$_icons_loaded ) {

      $this->_build_icons_html();
      static::$_icons_loaded = true;
      
    }

    return ob_get_clean();
  }

  /**
   * --------------------------------------------------------------------------
   * Icons for Icon Input field
   * --------------------------------------------------------------------------
   * 
   * @return void 
   * */
  protected function _build_icons_html() {

    $Icons = IOC_Container::make('Bonzer\Inputs\contracts\interfaces\Icons');

    $Icons->html();
  }

}
