<?php

namespace Drupal\a11yformsfix\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use \Drupal\Core\Render\Element\Checkboxes as CoreCheckboxes;

class Checkboxes extends CoreCheckboxes
{
    /**
     * Processes a checkboxes form element.
     */
    public static function processCheckboxes(&$element, FormStateInterface $form_state, &$complete_form) {
        //Let core do its thing
        CoreCheckboxes::processCheckboxes($element, $form_state, $complete_form);

        if ($element['#required']) {
            $children = Element::children($element);

            foreach ($children as $child_key) {
                if ($element[$child_key]['#type'] == 'checkbox') {
                    $element[$child_key]['#required'] = true;
                }
            }
        }
        
        return $element;
    }
}