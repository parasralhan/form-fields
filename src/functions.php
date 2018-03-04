<?php
if (!function_exists('__')) {
  function __($content, $textdomain){
    return $content;
  }
}
if ( !function_exists( 'isset_not_empty' ) ) {
  /**
   * --------------------------------------------------------------------------
   * variable is set and is not empty
   * --------------------------------------------------------------------------
   * 
   * @Return bool 
   * */
  function isset_not_empty( $content ) {
    if ( !isset( $content ) ) {
      return FALSE;
    }
    return (!empty( $content )) ? TRUE : FALSE;
  }

}