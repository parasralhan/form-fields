<?php
require dirname(__DIR__) . '/vendor/autoload.php';

\Bonzer\Inputs\config\Configurer::get_instance([
  'load_assets_automatically' => true,
  'css_excluded' => [ ],
  'js_excluded' => [ ],
  'env' => 'development', // development | production
  'is_admin' => false,
  'style' => '3'
]);

$input = Bonzer\Inputs\factories\Input::get_instance();
echo $input->create('text', [
  'id' => 'text',
  'placeholder' => 'Hello',
  'value' => '',
]);
echo $input->create('icon', [
  'id' => 'icon',
  'placeholder' => 'select icon',
  'value' => '',
]);
echo $input->create('multi-text', [
  'id' => 'multi-text',
  'placeholder' => 'Hello',
  'value' => '',
]);
echo $input->create('calendar', [
  'id' => 'calendar',
  'placeholder' => 'Calendar',
  'value' => '',
]);
echo $input->create('multi-text-calendar', [
  'id' => 'multi-text-calendar',
  'placeholder' => 'Multi Text Calendar',
  'value' => '',
]);
echo $input->create('textarea', [
  'id' => 'textarea',
  'placeholder' => 'Textarea',
  'value' => '',
]);
echo $input->create('select', [
  'id' => 'select',
  'options' => [
    'hello' => 'Hello',
    'world' => 'World',
  ],
]);
echo $input->create('multi-select', [
  'id' => 'multi-select',
  'options' => [
    'hello' => 'Hello',
    'world' => 'World',
  ],
]);
echo $input->create('color', [
  'id' => 'color',
  'placeholder' => 'Hello',
  'value' => '',
]);
echo $input->create('checkbox', [
  'id' => 'checkbox-input',
  'value' => '',
]);
echo $input->create('radio', [
  'id' => 'radio-input',
  'options' => [
    'hello' => 'Hello',
    'world' => 'World',
  ],
]);