<?php
/**
 * Configures the Exceptions Library
 */

namespace Bonzer\Inputs\config;

use Bonzer\Exceptions\config\Configurer as Exceptions_Configurer;

class Configurer {

  /**
   * @var Configurer
   */
  private static $_instance;

  /**
   * @var array
   */
  protected static $_config;

  /**
   * @var array
   */
  protected $_get_mappings = [
    'should_jquery_loaded' => 'load_jquery',
  ];

  /**
   * --------------------------------------------------------------------------
   * Constructor
   * --------------------------------------------------------------------------
   * 
   * @param array $config
   * 
   * @Return void 
   * */
  private function __construct( array $config = [ ] ) {
    $defaults = [
      'load_assets_automatically' => true,
      'css_excluded' => [ ],
      'js_excluded' => [ ],
      'env' => 'production', // development | production
      'is_admin' => false,
      'style' => '1' // 1|2|3
    ];
    $this->_config = array_merge( $defaults, $config );
    Exceptions_Configurer::get_instance( [
      'env' => $this->_config['env'],
      'is_admin' => $this->_config['is_admin']
    ] );
  }

  /**
   * --------------------------------------------------------------------------
   * Magic __get
   * --------------------------------------------------------------------------
   * 
   * @param string $key
   * 
   * @Return string|bool 
   * */
  public function __get( $key ) {
    if ( array_key_exists( $key, $this->_get_mappings ) ) {
      return $this->_config[ $this->_get_mappings[ $key ] ];
    } elseif ( array_key_exists( $key, $this->_config ) ) {
      return $this->_config[ $key ];
    }
    return false;
  }

  /**
   * --------------------------------------------------------------------------
   * Create Instance
   * --------------------------------------------------------------------------
   * 
   * @param array $config
   * 
   * @Return Configurer 
   * */
  public static function get_instance( array $config = [ ] ) {
    if ( static::$_instance ) {
      return static::$_instance;
    }
    return static::$_instance = new static( $config );
  }

  /**
   * --------------------------------------------------------------------------
   * Library Config
   * --------------------------------------------------------------------------
   * 
   * @Return array 
   * */
  public function get_config() {
    return $this->_config;
  }

}
