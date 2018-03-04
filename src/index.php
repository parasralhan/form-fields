<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Bonzer\Inputs\factories\Input;
Bonzer\Inputs\Bonzer_Inputs::get_instance([
  'env' => 'development'
]);

$input = new Input();
echo $input->create('text', [
  'id' => 'my_input',
  'value' => ''
]);