<?php
/**
* Auth Class
*/
namespace Bonzer\Inputs\auth;

use Bonzer\Inputs\Bonzer_Inputs;

class Auth {
  public static function is_admin(){
    $is_admin = Bonzer_Inputs::get_instance()->is_admin;
    return $is_admin ?: false;
  }
}