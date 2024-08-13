<?php
/**
 * @package bonzer/inputs    
 * @author  Paras Ralhan <ralhan.paras@gmail.com>
 */

namespace Bonzer\Inputs\contracts\interfaces;

interface Icons {

  /**
   * --------------------------------------------------------------------------
   * All Icons
   * --------------------------------------------------------------------------
   * 
   * @param string $name
   * 
   * @return void 
   * */
  public function html();

  /**
   * --------------------------------------------------------------------------
   * Font Awesome Icons
   * --------------------------------------------------------------------------
   * 
   * @return array 
   * */
  public function fa_icons();

  /**
   * --------------------------------------------------------------------------
   * Vector Icons
   * --------------------------------------------------------------------------
   * 
   * @return array 
   * */
  public function vector_icons();

  /**
   * --------------------------------------------------------------------------
   * Sprite Mappings
   * --------------------------------------------------------------------------
   * 
   * @return array 
   * */
  public function get_mappings();

  /**
   * --------------------------------------------------------------------------
   * Fontello Icons
   * --------------------------------------------------------------------------
   * 
   * @return array 
   * */
  public function fontello_icons();

}
