<?php
namespace Bonzer\Inputs\factories;

use Bonzer\Exceptions\Invalid_Param_Exception;

use Bonzer\Inputs\Assets_Loader,
    Bonzer\Inputs\config\Configurer as Inputs_Configurer;

use Bonzer\Inputs\contracts\interfaces\Assets_Loader as Assets_loader_Interface,
    Bonzer\Inputs\contracts\interfaces\Configurer as Configurer_Interface;

class Input implements \Bonzer\Inputs\contracts\interfaces\Inputs_Factory {

  /**
   * @var Input
   */
  private static $_instance;

  /**
   * @var bool
   */
  protected static $_assets_loaded;

  /**
   * @var Assets_Loader
   */
  protected $_Assets_Loader;

  /**
   * @var Inputs_Configurer
   */
  protected $_Configurer;

  /**
   * @var array
   */
  protected $_valid_types = [
    'calendar',
    'checkbox',
    'color',
    'heading',
    'icon',
    'multi-select',
    'multi-text',
    'multi-text-calendar',
    'radio',
    'select',
    'text',
    'textarea',
  ];

  protected $_namespace = "\\Bonzer\\Inputs\\fields\\";

  /**
   * Input arguments
   *
   * @var array
   */
  protected $_args;

  /**
   * --------------------------------------------------------------------------
   * Class Constructor
   * --------------------------------------------------------------------------
   * 
   * @param Assets_loader_Interface $assets_loader
   * @param Configurer_Interface $configurer
   * 
   * @return Input 
   * */
  protected function __construct( Assets_loader_Interface $assets_loader = NULL, Configurer_Interface $configurer = NULL ) {

    $this->_Configurer    = $configurer ? : Inputs_Configurer::get_instance();
    $this->_Assets_Loader = $assets_loader ? : Assets_Loader::get_instance();

  }

  /**
   * --------------------------------------------------------------------------
   * Class Constructor
   * --------------------------------------------------------------------------
   * 
   * @param Assets_loader_Interface $assets_loader
   * @param Configurer_Interface $configurer
   * 
   * @return Input 
   * */
  public static function get_instance( Assets_loader_Interface $assets_loader = NULL, Configurer_Interface $configurer = NULL ) {

    if ( static::$_instance ) {
      return static::$_instance;
    }

    return static::$_instance = new static( $assets_loader, $configurer );
  }

  /**
   * --------------------------------------------------------------------------
   * Create the Input field
   * --------------------------------------------------------------------------
   * 
   * @param string $type -- Input type  'calendar', 
   *                                    'checkbox', 
   *                                    'color', 
   *                                    'heading', 
   *                                    'icon', 
   *                                    'multi-select', 
   *                                    'multi-text', 
   *                                    'multi-text-calendar', 
   *                                    'radio', 
   *                                    'select', 
   *                                    'text', 
   *                                    'textarea'
   * @param array  $args Arguments for the input field
   * 
   * @return string
   */
  public function create( $type, $args ) {

    if ( ! static::$_assets_loaded ) {

      if ( $this->_Configurer->load_assets_automatically ) {
        $this->_load_assets_automatically();
      }

    }

    if ( ! in_array( $type, $this->_valid_types ) ) {

      throw new Invalid_Param_Exception(
        "Type {$type} is invalid! Supported types are " . implode( ',', $this->_valid_types )
      );

    }

    $this->_args = $args;

    // Ensure id or name is provided
    if ( ! ( isset( $this->_args['id'] ) || isset( $this->_args['name'] ) ) ) {
      throw new Invalid_Param_Exception( "You must provide at least `id` OR `name` in `args`" );
    }

    if ( ! isset( $this->_args['id'] ) && isset( $this->_args['name'] ) ) {
      $this->_args['id'] = $this->_args['name'];
    }

    if ( isset( $this->_args['id'] ) && ! isset( $this->_args['name'] ) ) {
      $this->_args['name'] = $this->_args['id'];
    }

    if ( ! isset( $args['label'] ) ) {
      $this->_args['label'] = $this->_label( $this->_args['id'] );
    }

    $this->_args['placeholder'] = isset( $args['placeholder'] ) ? $args['placeholder'] : '';

    $input_class = $this->_classname( $type );
    $input       = new $input_class( $this->_args );

    return $input->input_field();
  }


  /**
   * --------------------------------------------------------------------------
   * Build Label from $id
   * --------------------------------------------------------------------------
   * 
   * @param string $key
   * 
   * @return string 
   * */
  protected function _label( $key ) {

    return ucwords(
      str_replace(
        ['_', '-'],
        ' ',
        $key
      )
    );

  }

  /**
   * --------------------------------------------------------------------------
   * Build Input classname
   * --------------------------------------------------------------------------
   * 
   * @param string $type
   * 
   * @return string 
   * */
  protected function _classname( $type ) {

    return $this->_get_namespace( $type ) . 
      str_replace(
        ' ',
        '_',
        ucwords(
          str_replace(
            '-',
            ' ',
            $type
          )
        )
      );
  }

  /**
   * --------------------------------------------------------------------------
   * Automatic Assets Loading
   * --------------------------------------------------------------------------
   * 
   * @param string $name
   * 
   * @return void 
   * */
  protected function _load_assets_automatically() {
    
    $fragments_loaded = $this->_Assets_Loader->get_fragments_loading_status();

    if ( !$fragments_loaded['head'] ) {
      $this->_Assets_Loader->load_head_fragment();
    }

    if ( !$fragments_loaded['body'] ) {
      $this->_Assets_Loader->load_before_body_close_fragment();
    }

    static::$_assets_loaded = true;
  }

  /**
   * --------------------------------------------------------------------------
   * Input field Namespace
   * --------------------------------------------------------------------------
   * 
   * @param string $type
   * 
   * @return string 
   * */
  protected function _get_namespace( $type = NULL ) {
    return $this->_namespace;
  }


}
