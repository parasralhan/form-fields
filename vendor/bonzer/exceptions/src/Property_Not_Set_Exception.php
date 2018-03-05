<?php
namespace Bonzer\Exceptions;

class Property_Not_Set_Exception extends Base_Exception {

    public function __construct ( $message ) {

        parent::__construct($message);
    
    }
    
    public function get_Message(){
        
        $message = '';
        $message .= '<div class="error">';
        $message .= '<h3>'.$this->_title().'</h3>';
        $message .= parent::get_Message();
        $message .= '</div>';
        
        return static::_is_authorized() ? $message : $this->_message_to_unauthorized_user;
        
    }

}