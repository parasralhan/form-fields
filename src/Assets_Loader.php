<?php

namespace Bonzer\Inputs;

/**
 * Library Assets Loader
 * 
 * 
 * @package bonzer/inputs    
 * @author  Paras Ralhan <ralhan.paras@gmail.com>
 */
use Bonzer\Inputs\config\Configurer as Inputs_Configurer,
    Bonzer\Events\Event,
    Less_Parser;
use Bonzer\Inputs\contracts\interfaces\Configurer as Configurer_Interface,
    Bonzer\Events\contracts\interfaces\Event as Event_Interface;

class Assets_Loader implements \Bonzer\Inputs\contracts\interfaces\Assets_Loader {

  /**
   * @var Assets_Loader
   */
  private static $_instance;

  /**
   * @var array
   */
  protected $_config;

  /**
   * @var Inputs_Configurer
   */
  protected $_Configurer;

  /**
   * @var string
   */
  protected $_assets_dir;

  /**
   * @var array
   */
  protected $_fragments_loaded = [
    'head' => false,
    'body' => false,
  ];

  /**
   * Event_Interface
   *
   * @var string
   */
  protected $_Event;

  /**
   * --------------------------------------------------------------------------
   * Class Constructor
   * --------------------------------------------------------------------------
   * 
   * @param Configurer_Interface $configurer
   * @param Event_Interface $event
   * 
   * @Return Assets_Loader 
   * */
  protected function __construct( Configurer_Interface $configurer = NULL, Event_Interface $event = NULL ) {
    $this->_config = require 'config.php';
    $this->_assets_dir = __DIR__ . '/assets';
    $this->_Configurer = $configurer ? : Inputs_Configurer::get_instance();
    $this->_Event = $event ? : Event::get_instance();
    if ( $this->_Configurer->get_env() == 'development' ) {
      $this->_complie_less( $this->_assets_dir . '/less/styles.less', $this->_assets_dir . '/css/styles.css' );
    }
  }

  /**
   * --------------------------------------------------------------------------
   * Class Constructor
   * --------------------------------------------------------------------------
   * 
   * @param Configurer_Interface $configurer
   * @param Event_Interface $event
   * 
   * @Return Assets_Loader 
   * */
  public static function get_instance( Configurer_Interface $configurer = NULL, Event_Interface $event = NULL ) {
    if ( static::$_instance ) {
      return static::$_instance;
    }
    return static::$_instance = new static( $configurer, $event );
  }

  /**
   * --------------------------------------------------------------------------
   * Head Code Fragment
   * --------------------------------------------------------------------------
   * 
   * @Return Assets_Loader 
   * */
  public function load_head_fragment() {
    if ( $this->_fragments_loaded[ 'head' ] ) {
      return $this;
    }
    $assets = $this->_config[ 'assets' ];
    $assets_css = $assets[ 'css' ][ 'all' ];
    foreach ( $assets_css as $key => $src ) {
      if ( in_array( $key, $this->_Configurer->get_css_excluded() ) ) {
        continue;
      }
      ?>
      <link id="<?php echo $key; ?>" rel="stylesheet" href="<?php echo $src; ?>">
      <?php
    }
    ?>
    <style type="text/css">
    <?php
    $this->_Event->fire( 'inputs_css_start' );
    echo file_get_contents( "{$this->_assets_dir}/css/styles.css" );
    $this->_Event->fire( 'inputs_css_end' );
    ?>
    </style>
    <?php
    $this->_fragments_loaded[ 'head' ] = true;
    return $this;
  }

  /**
   * --------------------------------------------------------------------------
   * Code fragment to be inserted just before the body tag closes
   * --------------------------------------------------------------------------
   * 
   * @Return Assets_Loader 
   * */
  public function load_before_body_close_fragment() {
    if ( $this->_fragments_loaded[ 'body' ] ) {
      return $this;
    }
    $assets = $this->_config[ 'assets' ];
    $assets_js = $assets[ 'js' ][ 'all' ];
    foreach ( $assets_js as $key => $src ) {
      if ( in_array( $key, $this->_Configurer->get_js_excluded() ) ) {
        continue;
      }
      ?>
      <script id="<?php echo $key; ?>" src="<?php echo $src; ?>"></script>
      <?php
    }
    ?>
    <script>
      var bonzer_inputs = {};
      bonzer_inputs.style_type = 'style-<?php echo $this->_Configurer->get_style(); ?>';
    <?php
    $this->_Event->fire( 'inputs_js_start' );
    echo file_get_contents( "{$this->_assets_dir}/js/main.js" );
    $this->_Event->fire( 'inputs_js_end' );
    ?>
    </script>
    <?php
    $this->_fragments_loaded[ 'body' ] = true;
    return $this;
  }

  /**
   * --------------------------------------------------------------------------
   * Load all Assets
   * --------------------------------------------------------------------------
   * 
   * @Return void 
   * */
  public function load_all_fragments() {
    if ( $this->_fragments_loaded[ 'head' ] && $this->_fragments_loaded[ 'body' ] ) {
      return $this;
    }
    $this->load_head_fragment();
    $this->load_before_body_close_fragment();
    $this->_fragments_loaded[ 'head' ] = true;
    $this->_fragments_loaded[ 'body' ] = true;
    return $this;
  }

  /**
   * --------------------------------------------------------------------------
   * Compile Less to Css
   * --------------------------------------------------------------------------
   * 
   * @param string $from
   * @param string $to
   * 
   * @Return void 
   * */
  protected function _complie_less( $from, $to ) {
    $parser = new Less_Parser();
    $parser->parseFile( $from );
    $css = $parser->getCss();
    file_put_contents( $to, $css );
  }

  /**
   * --------------------------------------------------------------------------
   * Assets loading status
   * --------------------------------------------------------------------------
   * 
   * @Return array 
   * */
  public function get_fragments_loading_status() {
    return $this->_fragments_loaded;
  }

}
