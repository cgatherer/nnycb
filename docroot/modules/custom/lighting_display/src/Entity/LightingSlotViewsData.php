<?php

namespace Drupal\lighting_display\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lighting slot entities.
 */
class LightingSlotViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
