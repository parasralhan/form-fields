<?php
/**
* Bonzer Inputs
*/
namespace Bonzer\Inputs;

class Bonzer_Inputs{

  private static $_instance;

  protected $_config;

  protected $_get_mappings = [
    'should_jquery_loaded' => 'load_jquery',
    'env' => 'env',
  ];

  private function __construct(array $config = []){
    $defaults = [
      'load_jquery' => true,
      'env' => 'production',
    ];
    $this->_config = array_merge($defaults, $config);
  }

  public static function get_instance(array $config = []){
    if (static::$_instance) {
      return static::$_instance;
    }
    return static::$_instance = new static($config);
  }

  public function __get($key){
    if (array_key_exists($key, $this->_get_mappings)) {
      return $this->_config[$this->_get_mappings[$key]];
    }
    return false;
  }
  
  public static function is_dev(){
    return $this->_config['env'];
  }
}