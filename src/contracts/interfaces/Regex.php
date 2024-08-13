<?php
/**
 * @package bonzer/inputs    
 * @author  Paras Ralhan <ralhan.paras@gmail.com>
 */
namespace Bonzer\Inputs\contracts\interfaces;

interface Regex {

  /**
   * --------------------------------------------------------------------------
   * Set the file to be read
   * --------------------------------------------------------------------------
   * 
   * @param string $filepath
   * 
   * @return Regex 
   * */
  public function set_filepath( $filepath );

  /**
   * --------------------------------------------------------------------------
   * Reads file by regex
   * --------------------------------------------------------------------------
   * 
   * @param string $regex
   * 
   * @return void 
   * */
  public function read( $regex );

  /**
   * --------------------------------------------------------------------------
   * All Matches
   * --------------------------------------------------------------------------
   * 
   * @param int $index
   * 
   * @return array 
   * */
  public function get( $index = NULL );

  /**
   * --------------------------------------------------------------------------
   * Builds Associative Array of matches
   * --------------------------------------------------------------------------
   * 
   * @return Regex 
   * */
  public function associate();

}
