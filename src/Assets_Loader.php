<?php
/**
 * Library Assets Loader
 * 
 * 
 * @package bonzer/inputs    
 * @author  Paras Ralhan <ralhan.paras@gmail.com>
 */

namespace Bonzer\Inputs;

use Bonzer\Inputs\config\Configurer as Inputs_Configurer,
    Less_Parser;

class Assets_Loader implements \Bonzer\Inputs\contracts\interfaces\Assets_loader {

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
   * --------------------------------------------------------------------------
   * Class Constructor
   * --------------------------------------------------------------------------
   * 
   * 
   * @Return Assets_Loader 
   * */
  private function __construct() {
    $this->_config = require 'config.php';
    $this->_assets_dir = __DIR__ . '/assets';
    $this->_Configurer = Inputs_Configurer::get_instance();
    if ( $this->_Configurer->env == 'development' ) {
      $this->_complie_less();
    }
  }

  /**
   * 
   * @Return Assets_Loader 
   * */
  public static function get_instance() {
    if ( static::$_instance ) {
      return static::$_instance;
    }
    return static::$_instance = new static();
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
      if ( in_array( $key, $this->_Configurer->css_excluded ) ) {
        continue;
      }
      ?>
      <link id="<?php echo $key; ?>" rel="stylesheet" href="<?php echo $src; ?>">
      <?php
    }
    ?>
    <style type="text/css">
    <?php echo file_get_contents( "{$this->_assets_dir}/css/styles.css" ); ?>
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
      if ( in_array( $key, $this->_Configurer->js_excluded ) ) {
        continue;
      }
      ?>
      <script id="<?php echo $key; ?>" src="<?php echo $src; ?>"></script>
      <?php
    }
    ?>
    <script>
      var bonzer_inputs = {};
      bonzer_inputs.style_type = 'style-<?php echo $this->_Configurer->style;?>';
    <?php     
    echo file_get_contents( "{$this->_assets_dir}/js/main.js" ); ?>
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
   * @Return void 
   * */
  protected function _complie_less() {
    $parser = new Less_Parser();
    $parser->parseFile( $this->_assets_dir . '/less/styles.less' );
    $css = $parser->getCss();
    file_put_contents( $this->_assets_dir . '/css/styles.css', $css );
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
