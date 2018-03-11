<?php
/**
 * Inputs Configurer
 * 
 * @package     
 * @author  Paras Ralhan <ralhan.paras@gmail.com>
 */

namespace Bonzer\Inputs\contracts\interfaces;

interface Configurer {

  /**
   * --------------------------------------------------------------------------
   * Library Config
   * --------------------------------------------------------------------------
   * 
   * @Return array 
   * */
  public function get_config();

  /**
   * @Return bool 
   * */
  public function get_load_assets_automatically();

  /**
   * @Return array 
   * */
  public function get_css_excluded();

  /**
   * @Return array 
   * */
  public function get_js_excluded();

  /**
   * @Return string 
   * */
  public function get_env();

  /**
   * @Return string 
   * */
  public function get_style();

  /**
   * @Return bool 
   * */
  public function get_is_admin();

}
