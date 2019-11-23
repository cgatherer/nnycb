<?php

namespace Drupal\nnycb_helpers\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'NYLogoBlock' block.
 *
 * @Block(
 *  id = "ny_logo_block",
 *  admin_label = @Translation("NY Logo"),
 * )
 */
class NYLogoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['ny_logo_block']['#markup'] = '<a href="/"><img alt="New York Logo" data-align="center" data-entity-type="file" src="/modules/custom/nnycb_helpers/images/nygov-logo.png" /></a>';

    return $build;
  }

}
