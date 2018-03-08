# a11yformsfix

This is a drupal 8.5 (and maybe newer) module to fix form accessibility. It currently does the following:

## Problem
When using the 'Radios' and 'Checkboxes' form elements, the `required` property was not being correctly surfaced to assistive technology. This is an issue with drupal core. Related drupal core issue: https://www.drupal.org/project/drupal/issues/2950999

### Solution

This module moves the `required` attributes from the `radios` container element (fieldset) to the child radio elements. This correctly surfaces the required property to assistive technology. HTML5 does not support the `required` attribute on a group of checkboxes, so a JS fix will be required for that (I don't have this implemented).

Before these were being rendered as something like:

```
<fieldset required>
  <legend>label</legend>
  <input type="radio" /> <label for="">option label</label>
</fieldset>
```

After:

```
<fieldset>
  <legend>label</legend>
  <input type="radio" required /> <label for="">option label</label>
</fieldset>
```

## Problem
"checkboxes_other" and "radios_other" are not labeled correctly. Instead of being wrapped in a fieldset with a legend, they are wrapped by a div with a label. This prevents assistive technology from reading the legend for the group. This is an issue with the webform module.

### Solution

Add Drupal core's `preRenderCompositeFormElement()` function to the processing list for these elements, and remove the label.
