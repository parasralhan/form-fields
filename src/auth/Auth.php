<?php
/**
* Auth Class
*/
namespace Bonzer\Inputs\auth;

class Auth {

  public static function is_admin(){
    return !defined('BONZER_INPUTS_IS_ADMIN') ? false : BONZER_INPUTS_IS_ADMIN;
  }

}