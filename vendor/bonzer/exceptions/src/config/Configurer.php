<?php
/**
* Configures the Exceptions Library
*/
namespace Bonzer\Exceptions\config;

class Configurer{

  private static $_instance;

  protected static $_config;
  
  private function __construct(array $config = []){

    $defaults = [
      'env' => 'production', // development | production
      'is_admin' => false
    ];

    $this->_config = array_merge($defaults, $config);
  }

  public static function get_instance(array $config = []){
    if (static::$_instance) {
      return static::$_instance;
    }
    return static::$_instance = new static($config);
  }

  public function get_config(){
    return $this->_config;
  }

}