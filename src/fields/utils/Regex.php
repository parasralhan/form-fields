<?php

namespace Bonzer\Inputs\fields\utils;

use Bonzer\Exceptions\Method_Call_Sequence_Exception;
use Bonzer\Exceptions\Invalid_Param_Exception;

class Regex implements \Bonzer\Inputs\contracts\interfaces\Regex {

  /**
   * Filepath
   *
   * @var string
   */
  protected $_filepath;

  /**
   * Regex Matches
   *
   * @var array
   */
  protected $_matches;

  /**
   * --------------------------------------------------------------------------
   * Set the file to be read
   * --------------------------------------------------------------------------
   * 
   * @param string $filepath
   * 
   * @return Regex 
   */
  public function set_filepath( $filepath ) {

    if ( !file_exists( $filepath ) ) {
      throw new Invalid_Param_Exception( "file {$filepath} does not exist!" );
    }

    $this->_filepath = $filepath;

    return $this;
  }

  /**
   * --------------------------------------------------------------------------
   * Reads file by regex
   * --------------------------------------------------------------------------
   * 
   * @param string $regex
   * 
   * @return void 
   */
  public function read( $regex ) {

    // Unset previous matches that were built by previous call to this method
    unset( $this->_matches );

    if ( !$this->_filepath ) {
      throw new Method_Call_Sequence_Exception( 'File is not set. Set it first before calling this method!' );
    }

    $file_content = file_get_contents( $this->_filepath );

    // Generate numeric indexed array
    preg_match_all( $regex, $file_content, $matches );

    $this->_matches = $matches;

    return $this;
  }

  /**
   * --------------------------------------------------------------------------
   * All Matches
   * --------------------------------------------------------------------------
   * 
   * @param int $index
   * 
   * @return array 
   */
  public function get( $index = NULL ) {

    if ( is_null( $index ) ) {
      return $this->_matches;
    }

    if ( isset( $this->_matches[ $index ] ) ) {
      return $this->_matches[ $index ];
    }

    return NULL;
  }

  /**
   * --------------------------------------------------------------------------
   * Builds Associative Array of matches
   * --------------------------------------------------------------------------
   * 
   * @return Regex 
   */
  public function associate() {

    $numeric_matches = $this->_matches;

    unset( $this->_matches );

    for ( $i = 0; $i < count( $numeric_matches ) - 1; $i++ ) {
      $index = 0;

      array_walk( $numeric_matches[ $i ], function( $match ) use ( $numeric_matches, &$index, $i ) {
        
        $this->_matches[ $i ][ $match ] = $numeric_matches[ $i + 1 ][ $index ];
        $index++;
      } );
    }

    return $this;
  }

}
