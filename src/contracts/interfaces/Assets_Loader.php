<?php
namespace Bonzer\Inputs\contracts\interfaces;
/**
 * @package bonzer/inputs    
 * @author  Paras Ralhan <ralhan.paras@gmail.com>
 */

interface Assets_Loader {
  
  /**
   * --------------------------------------------------------------------------
   * Head Code Fragment
   * --------------------------------------------------------------------------
   * 
   * @Return void 
   * */
  public function load_head_fragment();
  
    /**
   * --------------------------------------------------------------------------
   * Code fragment to be inserted just before the body tag closes
   * --------------------------------------------------------------------------
   * 
   * @Return Assets_Loader 
   * */
  public function load_before_body_close_fragment();
  
    /**
   * --------------------------------------------------------------------------
   * Load all Assets
   * --------------------------------------------------------------------------
   * 
   * @Return void 
   * */
  public function load_all_fragments();
  
    /**
   * --------------------------------------------------------------------------
   * Assets loading status
   * --------------------------------------------------------------------------
   * 
   * @Return array 
   * */
  public function get_fragments_loading_status();

}
