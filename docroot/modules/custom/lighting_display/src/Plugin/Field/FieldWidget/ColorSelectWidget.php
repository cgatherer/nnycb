<?php

namespace Drupal\lighting_display\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\WidgetInterface;


/**
 * Plugin implementation of the 'lighting_colorselect' widget.
 *
 * @FieldWidget(
 *   id = "lighting_colorselect",
 *   module = "lighting_display",
 *   label = @Translation("Color Select"),
 *   field_types = {
 *      "list_string",
 *      "string"
 *   }
 * )
 */
class ColorSelectWidget extends WidgetBase implements WidgetInterface {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    // find the selected palette from the slot?

    $selected_palette = 'standard';

    $config = \Drupal::config('lighting_display.color_palettes');
    $palettes = $config->get('palettes');
    $palette = $palettes[$selected_palette];

    $options = [];
    foreach ($palette as $color) {
      $options[$color['name']  . '|' . $color['hex']] =  $color['name'];
    }

    // get any existing value
    $value = isset($items[$delta]->value) ? $items[$delta]->value : NULL;

    // Build the element render array.
    $element += array(
      '#type' => 'select',
      '#default_value' => $value,
      '#options' => $options,
    );

    return array('value' => $element);
  }

}
