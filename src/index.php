<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Bonzer\Inputs\factories\Input;
Bonzer\Inputs\Bonzer_Inputs::get_instance([
  'env' => 'development'
]);

$input = new Input();
echo $input->create('icon', [
  'id' => 'my_input',
  'value' => '',
  'show_if' => [
    [
      'id' => 'dep',
      'value' => 'paras'
    ]
  ]
]);
echo $input->create('text', [
  'id' => 'my_input_hello',
  'placeholder' => 'My Hello',
  'value' => '',
  'show_if' => [
    [
      'id' => 'dep',
      'value' => 'paras'
    ]
  ]
]);