<?php

/**
 * @file
 * Contains lighting_slot.page.inc.
 *
 * Page callback for Lighting slot entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Lighting slot templates.
 *
 * Default template: lighting_slot.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_lighting_slot(array &$variables) {
  // Fetch LightingSlot Entity Object.
  $lighting_slot = $variables['elements']['#lighting_slot'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
