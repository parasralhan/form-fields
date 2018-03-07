<?php
/**
 * @package bonzer/inputs    
 * @author  Paras Ralhan <ralhan.paras@gmail.com>
 */

namespace Bonzer\Inputs\contracts\interfaces;

interface Auth {

  /**
   * --------------------------------------------------------------------------
   * Checks whether the current user is Administrator or not flaged by Config
   * --------------------------------------------------------------------------
   * 
   * @Return bool 
   * */
  public static function is_admin();

}
