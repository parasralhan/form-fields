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
The only prerequisite for this library is the PHP version,
minimum version required is PHP 5.4

### Installing 
It can be installed via composer. Run
```
composer require bonzer/inputs
```

### Configuration
```
Bonzer\Inputs\config\Configurer::get_instance([
  'load_assets_automatically' => true, // recommended option is false, I have made it true so that library does not break if you don't configure
  'css_excluded' => [ ], // keys for js files you don't want the library to load, You should be responsible for loading theme for library
  'js_excluded' => [ ],  // keys for js files you don't want the library to load, You should be responsible for loading theme for library
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

