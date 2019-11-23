<?php

/**
 * @file
 * Contains lighting_display.page.inc.
 *
 * Page callback for Lighting display entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Url;

/**
 * Prepares variables for Lighting display templates.
 *
 * Default template: lighting_display.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_lighting_display(array &$variables) {
  // Fetch LightingDisplay Entity Object.
  /** @var \Drupal\lighting_display\Entity\LightingDisplay $lighting_display */
  $lighting_display = $variables['elements']['#lighting_display'];
  $variables['lighting_display'] = $lighting_display;
  $slot = $lighting_display->getSlot();
  $variables['display_slot'] = $slot;
  $date = $slot->getSlotDate();
  $variables['slot_date'] = $date;
  $variables['approved'] = $lighting_display->getApproved();

  $tower = $lighting_display->getTowerColor();
  $parts = explode('|', $tower);
  $tower_color_name = $parts[0];
  $variables['tower_color_name'] = $tower_color_name;
  $tower_hex = $parts[1];
  $variables['tower_hex'] = $tower_hex;

  $pier1 = $lighting_display->getPierColor1();
  $parts = explode('|', $pier1);
  $pier1_color_name = $parts[0];
  $variables['pier1_color_name'] = $pier1_color_name;
  $pier1_hex = $parts[1];
  $variables['pier1_hex'] = $pier1_hex;

  $pier2 = $lighting_display->getPierColor2();
  $parts = explode('|', $pier2);
  $pier2_color_name = $parts[0];
  $variables['pier2_color_name'] = $pier2_color_name;
  $pier2_hex = $parts[1];
  $variables['pier2_hex'] = $pier2_hex;

  $variables['url'] = Url::fromRoute('entity.lighting_display.canonical', ['lighting_display' => $lighting_display->id()], ['absolute' => true]);

}
