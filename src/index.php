<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Bonzer\IOC_Container\facades\Container;
use Bonzer\Events\Event;

$Event = Event::get_instance();
$Event->listen('inputs_css_end', function(){
  ?>
  body{
    background: #fff;
  }
<?php
});

$inputs = [
  'text' => [
    'id' => 'text',
    'placeholder' => 'Hello',
   'desc' => 'Description Here'
  ],
  'textarea' => [
    'id' => 'textarea',
    'placeholder' => 'Write Something',
    'desc' => 'Description Here'
  ],
  'multi-text' => [
    'id' => 'multi-text-input',
    'placeholder' => 'Write something & hit enter',
    'desc' => 'Description Here'
  ],
  'select' => [
    'id' => 'select-input',
    'placeholder' => 'Select Options',
    'options' => [
      'hello' => 'Hello',
      'world' => 'World',
    ],
    'desc' => 'Description Here'
  ],
  'multi-select' => [
    'id' => 'multi-select-input',
    'placeholder' => 'Select Options',
    'options' => [
      'hello' => 'Hello',
      'world' => 'World',
    ],
    'desc' => 'Description Here'
  ],
  'radio' => [
    'id' => 'radio-input',
    'value' => 'hello',
    'options' => [
      'hello' => 'Hello',
      'world' => 'World',
    ],
    'desc' => 'Description Here'
  ],
  'checkbox' => [
    'id' => 'checkbox-input',
    'desc' => 'Description Here'
  ],
  'calendar' => [
    'id' => 'calendar',
    'placeholder' => '23-Mar-2018',
    // 'desc' => 'Description Here'
  ],
  'multi-text-calendar' => [
    'id' => 'multiple-dates',
    'placeholder' => 'Select Date',
    'desc' => 'Description Here'
  ],
  'color' => [
    'id' => 'color-input',
    'placeholder' => '#dddddd',
    'desc' => 'Description Here'
  ],
  'icon' => [
    'id' => 'icon-input',
    'placeholder' => 'Select icon',
    'desc' => 'Description Here'
  ],
  'heading' => [
    'id' => 'heading-input',
    'value' => 'Section Heading',
    'desc' => 'Description Here'
  ],
];


\Bonzer\Inputs\config\Configurer::get_instance([
  'load_assets_automatically' => true,
  'css_excluded' => [ ],
  'js_excluded' => [ ],
  'env' => 'development', // development | production
  'is_admin' => false,
  'style' => '3'
]);

$input = Container::make('Bonzer\Inputs\factories\Input');

foreach ($inputs as $key => $args){
  echo $input->create( $key, $args );
}
