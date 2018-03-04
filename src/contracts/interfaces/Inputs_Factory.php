<?php
namespace Bonzer\Inputs\contracts\interfaces;

interface Inputs_Factory {

  /**
   * --------------------------------------------------------------------------
   * Create the Input field
   * --------------------------------------------------------------------------
   * 
   * @param string $type
   * @param array $args
   * 
   * @Return string 
   * */
  public function create( $type, $args );

}
