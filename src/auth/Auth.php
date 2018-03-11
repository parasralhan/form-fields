<?php
/**
 * @package bonzer/inputs    
 * @author  Paras Ralhan <ralhan.paras@gmail.com>
 */

namespace Bonzer\Inputs\auth;

use Bonzer\Inputs\config\Configurer;

class Auth implements \Bonzer\Inputs\contracts\interfaces\Auth{
  
  /**
   * --------------------------------------------------------------------------
   * Checks whether the current user is Administrator or not flaged by Config
   * --------------------------------------------------------------------------
   * 
   * @Return bool 
   * */
  public static function is_admin(){
    $is_admin = Configurer::get_instance()->get_is_admin();
    return $is_admin ?: false;
  }
}