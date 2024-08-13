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
   * @return array 
   * */
  public function get_config();

  /**
   * @return bool 
   * */
  public function get_load_assets_automatically();

  /**
   * @return array 
   * */
  public function get_css_excluded();

  /**
   * @return array 
   * */
  public function get_js_excluded();

  /**
   * @return string 
   * */
  public function get_env();

  /**
   * @return string 
   * */
  public function get_style();

  /**
   * @return bool 
   * */
  public function get_is_admin();

}
