<?php
namespace Bonzer\Inputs\contracts\interfaces;

interface Inputs_Factory {

  /**
   * --------------------------------------------------------------------------
   * Create the Input field
   * --------------------------------------------------------------------------
   * 
   * @param string $type | input type ('calendar', 'checkbox', 'color', 'heading', 'icon', 'multi-select', 'multi-text', 'multi-text-calendar', 'radio', 'select', 'text', 'textarea')
   * @param array $args
   * 
   * @return string
   * */
  public function create( $type, $args );

}
