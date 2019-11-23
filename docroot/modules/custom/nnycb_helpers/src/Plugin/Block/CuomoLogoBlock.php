<?php

namespace Drupal\nnycb_helpers\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'CuomoLogoBlock' block.
 *
 * @Block(
 *  id = "cuomo_logo_block",
 *  admin_label = @Translation("Cuomo Logo"),
 * )
 */
class CuomoLogoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['cuomo_logo_block']['#markup'] = '<a href="/"><img alt="Cuomo Logo" data-align="center" data-entity-type="file" src="/modules/custom/nnycb_helpers/images/cuomo-logo.svg" /></a>';

    return $build;
  }
}
