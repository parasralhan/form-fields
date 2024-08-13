<?php

use Bonzer\IOC_Container\facades\Container as IOC_Container;

if ( ! function_exists( '__' ) ) {

  function __( $content, $textdomain ) {
    return $content;
  }

}

if ( ! function_exists( 'load_bonzer_inputs_container_bindings' ) ) {

  /**
   * --------------------------------------------------------------------------
   * Init Container Bindings
   * --------------------------------------------------------------------------
   * 
   * @return bool 
   * */
  function load_bonzer_inputs_container_bindings() {

    $bindings = require 'container-bindings.php';

    foreach ( $bindings as $key => $value ) {
      IOC_Container::bind( $key, $value );
    }
  }

}