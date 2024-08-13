<?php

namespace Bonzer\Inputs\contracts;

use Bonzer\Exceptions\Invalid_Param_Exception;

abstract class Input_Abstract {

  use \Bonzer\Inputs\traits\Attr;

  /**
   * Input field name attribute
   *
   * @var string
   */
  protected $_name;

  /**
   * Input field id attribute
   *
   * @var int
   */
  protected $_id;

  /**
   * Input field Label
   *
   * @var string
   */
  protected $_label;  

  /**
   * Input field placeholder
   *
   * @var string
   */
  protected $_placeholder;

  /**
   * Input field value
   *
   * @var string
   */
  protected $_value;

  /**
   * options for select | multi-select fields
   *
   * @var array
   */
  protected $_options;

  /**
   * Description of input field
   *
   * @var string
   */
  protected $_desc;

  /**
   * Input field build
   *
   * @var string
   */
  protected $_output;

  /**
   * Regex
   *
   * @var string
   */
  protected $_valid_regex = '/^[-.a-zA-Z0-9_|()%,"\[\]\s]+$/';

  /**
   * Conditional
   *
   * @var array
   */
  protected $_show_if = [];

  /**
   * Conditional
   *
   * @var array
   */
  protected $_additional_attrs = null;

  /**
   * --------------------------------------------------------------------------
   * Input Constructor
   * --------------------------------------------------------------------------
   * 
   * @param array $args
   * 
   * Format is 
   * 
   * $args = [
   *   'name'        => $field_name,        string
   *   'id'          => $field_id,          string
   *   'label'       => $field_label,       string
   *   'placeholder' => $field_placeholder, string
   *   'value'       => $value,             string
   *   'desc'        => $description,       string
   *   'options'     => $options,           array
   *   'attrs'       => $attrs,             array
   * ];
   * 
   * @return object | Input Constructor
   */
  public function __construct( $args ) {

    $this->_name        = $this->_set_attr( $args['name'] );
    $this->_id          = $this->_set_attr( $args['id'] );
    $this->_label       = $args['label'];
    $this->_desc        = isset( $args['desc'] ) ? $args['desc'] : '';
    $this->_value       = isset( $args['value'] ) ? $args['value'] : '';
    $this->_placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';

    if ( isset( $args['options'] ) && is_array( $args['options'] ) ) {
      $this->_options = $args['options'];
    }

    if ( isset( $args['show_if'] ) && is_array( $args['show_if'] ) ) {
      $this->_show_if = $args['show_if'];
    }

    if ( isset( $args['attrs'] ) && is_array( $args['attrs'] ) ) {
      $this->_additional_attrs = static::attr_builder( $args['attrs'] );
    }
  }

  /**
   * --------------------------------------------------------------------------
   * Returns the input field build based on supplied attributes in
   * constructor
   * --------------------------------------------------------------------------
   * 
   * @return html 
   * */
  public function input_field() {

    $this->_output = $this->_build_input();

    return $this->_output;
  }

  /**
   * --------------------------------------------------------------------------
   * set input field attr conforming to mentioned REGEX
   * --------------------------------------------------------------------------
   * 
   * @param string $param
   * 
   * @return string OR throws an Exception if invalid @param supplied 
   * */
  protected function _set_attr( $param ) {

    if ( preg_match( $this->_valid_regex, $param ) ) {

      return $param;

    } else {

      throw new Invalid_Param_Exception( "Invalid parameter '{$param}' Supplied" );

    }

  }

  /**
   * --------------------------------------------------------------------------
   * Makes the Input Conditional
   * --------------------------------------------------------------------------
   * 
   * @param string $id
   * @param string $value
   * 
   * 
   * @return Input_Abstract 
   * */
  public function show_if( $id, $value ) {

    $this->_show_if[] = [
      'id' => $id,
      'value' => $value
    ];

    return $this;
  }

  /**
   * --------------------------------------------------------------------------
   * Builds conditional data
   * --------------------------------------------------------------------------
   * 
   * 
   * @return string 
   * */
  protected function _conditional_data() {

    if ( !$this->_show_if ) {
      return FALSE;
    }

    return json_encode( $this->_show_if );
  }

  /**
   * --------------------------------------------------------------------------
   * Builds label
   * --------------------------------------------------------------------------
   * 
   * @return void 
   * */
  protected function _label() {

    ?>
      <label for="<?php echo $this->_id; ?>">

        <span class="label-text">
          <?php echo $this->_label; ?>
        </span>

        <?php echo !empty( $this->_desc ) ? "<p class='desc'>{$this->_desc}</p>" : ''; ?>
      </label> 
    <?php
  }

  /**
   * --------------------------------------------------------------------------
   * Builds Remove Button
   * --------------------------------------------------------------------------
   * 
   * @return void 
   * */
  protected function _remove_btn() {

    ?>
      <button 
        class="remove button" 
        title="Remove" type="button"
      >
        <i class="fa fa-times-circle"></i>&nbsp;
        <span class="text">Remove</span>
      </button>
    <?php
  }

  /**
   * --------------------------------------------------------------------------
   * Builds input field of specific type
   * --------------------------------------------------------------------------
   * 
   * @return string 
   * */
  abstract protected function _build_input();

}
