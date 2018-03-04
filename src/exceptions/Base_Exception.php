<?php

namespace Bonzer\Inputs\exceptions;

use Exception;
use Bonzer\Inputs\auth\Auth;
use Bonzer\Inputs\Bonzer_Inputs;
require_once dirname(__DIR__) . '/bootstrap.php';

class Base_Exception extends Exception {

  protected $_message_to_unauthorized_user;

  public function __construct( $message ) {

    parent::__construct( $message );

    $this->_message_to_unauthorized_user = __( 'Exception Occured, You must be logged in as ADMIN to View the detail', 'bonzer_inputs' );
  }

  public function get_Message() {

    $out = '';

    $trace = $this->_backtrace();

    $class = 'error';
    $out .= "<div class=\"{$class}\"> <p>Error: <br>Line &raquo; {$this->getLine()}<br> File &raquo; " . basename( $this->getFile() ) . "</p> <p> Message &raquo; {$this->message}</p>";
    $out .= "<hr>";
    $out .= "<p> Triggered in: <br>File &raquo; {$trace[ 'error_file' ]} <br>";
    $out .= "Line &raquo; {$trace[ 'error_line' ]} <br>";
    $out .= "Method &raquo; {$trace[ 'error_method' ]}</div>";

    return static::_is_authorized() ? $out : $this->_message_to_unauthorized_user;
  }

  protected function _backtrace() {

    $trace_array = $this->getTrace();

    $backtrace[ 'error_file' ] = basename( $trace_array [ 0 ] [ 'file' ] );
    $backtrace[ 'error_line' ] = $trace_array [ 0 ] [ 'line' ];
    $backtrace[ 'error_method' ] = $trace_array [ 0 ] [ 'function' ];

    return $backtrace;
  }

  public function get_message_if_cought_within_same_class() {

    $trace_array = $this->getTrace();

    $class = 'error';
    $out .= "<div class=\"{$class}\"> <p>Error: <br>Line &raquo; {$trace_array[ 1 ][ 'line' ]}<br> File &raquo; {$trace_array[ 1 ][ 'file' ]}</p> <p> Function &raquo; {$trace_array[ 1 ][ 'function' ]}</p>";
    $out .= "<hr>";
    $out .= "<p> Triggered in: <br>File &raquo; {$trace_array[ 0 ][ 'file' ]} <br>";
    $out .= "Line &raquo; {$trace_array[ 0 ][ 'line' ]} <br>";
    $out .= "Method &raquo; {$trace_array[ 0 ][ 'function' ]}</div>";
    $out .= "<hr>";
    $out .= "<p> Cought in: <br>File &raquo; {$this->getFile()} <br>";
    $out .= "Line &raquo; {$this->getLine()} <br>";
    $out .= "Message &raquo; {$this->message}</div>";

    return static::_is_authorized() ? $out : $this->_message_to_unauthorized_user;
  }

  public function get_message_if_cought_in_trier_class() {

    $trace_array = $this->getTrace();

    $class = 'error';
    $out .= "<div class=\"{$class}\"> <p>Error: <br>Line &raquo; {$trace_array[ 1 ][ 'line' ]}<br> File &raquo; {$trace_array[ 1 ][ 'file' ]}</p> <p> Method &raquo; {$trace_array[ 1 ][ 'function' ]}</p>";
    $out .= "<hr>";
    $out .= "<p> Triggered in: <br>File &raquo; {$this->getFile()} <br>";
    $out .= "Line &raquo; {$this->getLine()} <br>";
    $out .= "Message &raquo; {$this->message}</div>";
    $out .= "<hr>";
    $out .= "<p> Cought in: <br>File &raquo; {$trace_array[ 0 ][ 'file' ]} <br>";
    $out .= "Line &raquo; {$trace_array[ 0 ][ 'line' ]} <br>";
    $out .= "Method &raquo; {$trace_array[ 0 ][ 'function' ]}<br>";
    $out .= "Class &raquo; {$trace_array[ 0 ][ 'class' ]}</div>";

    return static::_is_authorized() ? $out : $this->_message_to_unauthorized_user;
  }

  protected function _title() {
    return str_replace( ['_',
      __NAMESPACE__,
      '\\' ], ' ', sprintf( __( '%s', 'bonzer_inputs' ), get_called_class() ) );
  }

  protected static function _is_authorized(){
    return Auth::is_admin() || Bonzer_Inputs::is_dev();
  }

}
