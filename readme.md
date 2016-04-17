## Gravity Helper

GravityHelper is a simple library that provides an easy way to do common tasks related to [Gravity Forms](http://www.gravityforms.com/).

##### Installation

1. Clone the repo or download as a zip
2. Include `gravityhelper.php` in your theme or plugin

##### Basic Usage

```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper();
```

This will initialize the object for all the forms (globally). If you need to target a specific form, provide its ID in the parenthesis.

##### Available Methods

`ajax_spinner()` - changes the image of the spinner when used for an AJAX form.

```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper();
$GravityHelper->ajax_spinner( get_bloginfo( 'stylesheet_directory' ) . '/images/ajax-loader.gif' );
```

---

`button_submit()` - turns the submit button to a `<button>` instead of an `<input type="submit">`

```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper();
$GravityHelper->button_submit();
```

---

`button_atts()` - specifies the attributes of the button when used with the above method.

```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper();
$GravityHelper->button_submit()->button_atts( 'class' => 'btn btn-primary' );
```

---

`button_content()` - specifies the button content.


```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper();
$GravityHelper->button_submit()->button_content( '<span>{content}</span>' );
```

**NB:** You can use `{content}` as a placeholder for the current content of the button.

---

`get_entries()` - gets the form entries. Equal to `GFFormsModel::get_leads()`, requires form ID.

```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper( 1 );
$form_entries  = $GravityHelper->get_entries();
```

---

`get_fields()` - gets the form fields. Equal to `GFFormsModel::get_form_meta()`, requires form ID.

```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper( 1 );
$form_fields   = $GravityHelper->get_fields();
```

---

`get_entries_data()` - gets an associative array with the fields as keys and entries as value.

```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper( 1 );
$entries_data  = $GravityHelper->get_entries_data();
```

---

`switch_to_form()` and `reset_form()` - switches or resets the current form to global. Useful for chaining.

```
use GravityHelper\GravityHelper;

$GravityHelper = new GravityHelper();
$GravityHelper
->ajax_spinner( get_bloginfo( 'stylesheet_directory' ) . '/images/ajax-loader.gif' )
->button_submit()
->switch_to_form( 1 )
->button_atts( array( 'class' => 'btn btn-primary' ) )
->reset_form()
->button_content( '<span>{content}</span>' );
```