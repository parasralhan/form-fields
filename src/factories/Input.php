<?php

namespace Bonzer\Inputs\factories;

use Bonzer\Inputs\exceptions\Invalid_Param_Exception;
use Bonzer\Inputs\Bonzer_Inputs,
    Bonzer\Inputs\fields\utils\Icons,
    Bonzer\Inputs\fields\utils\Regex as Regex_Reader;
require_once dirname(__DIR__) . '/bootstrap.php';

class Input implements \Bonzer\Inputs\contracts\interfaces\Inputs_Factory {

  protected static $_assets_loaded;

  protected $_Bonzer_Inputs;

  protected $_assets_dir;

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
   * Create the Input field
   * --------------------------------------------------------------------------
   * 
   * @param string $type
   * @param array $args
   * 
   * @Return string 
   * */
  public function create( $type, $args ) {

    if (!static::$_assets_loaded) {
      $this->_assets_dir = dirname(__DIR__).'/assets';
      $this->_build_icons_html();
      $this->_complie_less();
      $this->_load_assets();
    }

    if ( !in_array( $type, $this->_valid_types ) ) {
      throw new Invalid_Param_Exception( "type {$type} is invalid!, supported types are " . implode( ',', $this->_valid_types ) );
    }

    $this->_args = $args;

    // if id OR name 
    if ( !(isset( $this->_args[ 'id' ] ) || isset( $this->_args[ 'name' ] )) ) {
      throw new Invalid_Param_Exception( "You must provide at least `id` OR `name` in `args`" );
    }

    if ( !isset( $this->_args[ 'id' ] ) && isset( $this->_args[ 'name' ] ) ) {
      $this->_args[ 'id' ] = $this->_args[ 'name' ];
    }

    if ( isset( $this->_args[ 'id' ] ) && !isset( $this->_args[ 'name' ] ) ) {
      $this->_args[ 'name' ] = $this->_args[ 'id' ];
    }

    if ( !isset( $args[ 'label' ] ) ) {
      $this->_args[ 'label' ] = $this->_label( $this->_args[ 'id' ] );
    }

    $this->_args[ 'placeholder' ] = isset( $args[ 'placeholder' ] ) ? $args[ 'placeholder' ]: '';

    $input_class = $this->_classname( $type );
    $input = new $input_class( $this->_args );
    return $input->input_field();
  }

  /**
   * --------------------------------------------------------------------------
   * Build Label from $id
   * --------------------------------------------------------------------------
   * 
   * @param string $key
   * 
   * @Return string 
   * */
  protected function _label( $key ) {
    return ucwords( str_replace( ['_',
      '-' ], ' ', $key ) );
  }

  /**
   * --------------------------------------------------------------------------
   * Build Input classname
   * --------------------------------------------------------------------------
   * 
   * @param string $type
   * 
   * @Return string 
   * */
  protected function _classname( $type ) {
    return $this->_namespace . str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $type ) ) );
  }

  /**
   * --------------------------------------------------------------------------
   * Load Assets
   * --------------------------------------------------------------------------
   * 
   * @Return void 
   * */
  protected function _load_assets() {    
    $this->_Bonzer_Inputs = Bonzer_Inputs::get_instance();
    $env = $this->_Bonzer_Inputs->env;
    $should_jquery_loaded = $this->_Bonzer_Inputs->should_jquery_loaded;
    $config = require dirname(__DIR__).'/config.php';
    $assets = $config['assets'];
    $assets_js = $assets['js']['all'];
    $assets_css = $assets['css']['all'];
    if (!$should_jquery_loaded) {
      unset($assets_js['jquery']);
    }
    foreach ($assets_js as $key => $src) {
      ?>
        <script id="<?php echo $key; ?>" src="<?php echo $src; ?>"></script>
      <?php
    }    
    foreach ($assets_css as $key => $src) {
      ?>
      <link id="<?php echo $key; ?>" rel="stylesheet" href="<?php echo $src; ?>">
      <?php
    } 
    ?>
      <script>
        <?php echo file_get_contents("{$this->_assets_dir}/js/main.js"); ?>
      </script>
      <style type="text/css">
        <?php echo file_get_contents("{$this->_assets_dir}/css/styles.css"); ?>
      </style>
    <?php
    static::$_assets_loaded = true;
  }

  protected function _complie_less(){
    $parser = new \Less_Parser();
    $parser->parseFile( $this->_assets_dir.'/less/styles.less' );
    $css = $parser->getCss();
    file_put_contents($this->_assets_dir.'/css/styles.css', $css);
  }

  protected function _build_icons_html(){
    $Icons = Icons::get_instance(new Regex_Reader());
    $Icons->html();
  }

}
