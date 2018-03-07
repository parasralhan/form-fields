# HTML Form Fields.
A utility Library with minimal interface giving you the ability to create HTML form fields with added functionality.<br>

Form Fields included are
* text
* multi-text
* multi-text-calendar
* textarea
* select
* multi-select
* icon
* color
* calendar
* heading 
* radio
* checkbox

## Getting Started

### Prerequisites
<ul>
  <li>
    <b>PHP</b> - The only prerequisite for this library is the PHP version, minimum version required is PHP 5.4
  </li>
  <li>
    <b>Javascript</b> - the following javacsript dependencies are required for complete working of form fields
    <ul>
      <li>jquery</li>
      <li>jquery-ui <br>(Includes: draggable, core, resizable, selectable, sortable, datepicker, menu, selectmenu, button, tooltip)</li>
      <li>chosen (Multi Select)</li>
      <li>spectrum (Color Picker)</li>
    </ul>
  </li>
  <li>
    <b>CSS</b> - the following CSS dependencies are required for complete working of form fields
    <ul>
      <li>font-awesome</li>
      <li>jquery-ui</li>
      <li>jquery-ui.theme <br>(Includes: draggable, core, resizable, selectable, sortable, datepicker, menu, selectmenu, button, tooltip, theme)</li>
      <li>chosen (Multi Select)</li>
      <li>spectrum (Color Picker)</li>
    </ul>
  </li>
</ul>

### Installing 
It can be installed via composer. Run
```
composer require bonzer/inputs
```

### Configuration
```
Bonzer\Inputs\config\Configurer::get_instance([
  'load_assets_automatically' => true, // recommended option is false, I have made it true so that library does not break if you don't configure
  'css_excluded' => [ ], // keys for js files you don't want the library to load, You should be responsible for loading them for library
  'js_excluded' => [ ],  // keys for js files you don't want the library to load, You should be responsible for loading them for library
  'env' => 'production', // development | production
  'is_admin' => false // flag you can set to tell library when the fields are opened in ADMIN mode, helpful for Exception handling
]);
```
The above code must come before any code related to this Library.<br>
* Note: keys to put in <code>js_excluded</code> and <code>css_excluded</code> can be found in <code>src/config.php</code> file

The Library come bundled with required css, js and fonts. As we all know <code>css</code> must go in <code>head tag</code> and for <code>js</code>, 
recommended option is before <code>&lt;/body&gt;</code>. For this Library is offering two methods:

```
$Assets_Loader = Bonzer\Inputs\Assets_Loader::get_instance();
$Assets_Loader->load_head_fragment();
$Assets_Loader->load_before_body_close_fragment();
```
but if you intend to use both of these options yourself, turn the <code>'load_assets_automatically'</code> key in configuration to <code>FALSE</code>. i.e.
```
'load_assets_automatically' => FALSE
```
## Usage
There is a Factory class <code>Bonzer\Inputs\factories\Input</code> that has <code>create</code> method, 
The Blueprint of the Method is 
```
  /**
   * --------------------------------------------------------------------------
   * Create the Input field
   * --------------------------------------------------------------------------
   * 
   * @param string $type | input type ('calendar', 'checkbox', 'color', 'heading', 'icon', 'multi-select', 'multi-text', 'multi-text-calendar', 'radio', 'select', 'text', 'textarea',)
   * @param array $args 
   * 
   * @Return string 
   * */
   public function create( $type, $args );
```
second argument <code>$args</code> has blueprint as follows: 
```
$args = [
   'name' => $field_name,    string
   'id' => $field_id,        string
   'label' => $field_label,  string
   'placeholder' => $field_placeholder,  string
   'value' => $value,        string
   'desc' => $description,   string
   'options' => $options,    array
   'attrs' => $attrs,        array
];
```
### Examples
```
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
```

