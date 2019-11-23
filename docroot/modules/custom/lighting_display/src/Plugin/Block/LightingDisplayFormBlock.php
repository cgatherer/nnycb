<?php

namespace Drupal\lighting_display\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'LightingDisplayFormBlock' block.
 *
 * @Block(
 *  id = "lighting_display_form_block",
 *  admin_label = @Translation("Lighting display form block"),
 * )
 */
class LightingDisplayFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $build = [
      '#cache' => [
        'max-age' => 0,
      ],
    ];

    $build['form'] = \Drupal::formBuilder()->getForm('Drupal\lighting_display\Form\LightingDisplayRequestForm');

    return $build;
  }

}
