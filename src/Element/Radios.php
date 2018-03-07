<?php

namespace Drupal\a11yformsfix\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\Core\Render\Element\Radios as CoreRadios;

class Radios extends CoreRadios
{
    public static function processRadios(&$element, FormStateInterface $form_state, &$complete_form) {
        //Let core do its thing
        CoreRadios::processRadios($element, $form_state, $complete_form);

        if ($element['#required']) {
            $children = Element::children($element);

            foreach ($children as $child_key) {
                if ($element[$child_key]['#type'] == 'radio') {
                    $element[$child_key]['#required'] = true;
                }
            }
        }

        return $element;
    }
}