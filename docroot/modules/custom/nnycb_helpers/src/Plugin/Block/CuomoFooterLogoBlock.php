<?php

namespace Drupal\nnycb_helpers\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'CuomoFooterLogoBlock' block.
 *
 * @Block(
 *  id = "cuomo_footer_logo_block",
 *  admin_label = @Translation("Cuomo Footer Logo"),
 * )
 */
class CuomoFooterLogoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['cuomo_footer_logo_block']['#markup'] = '<a href="/"><img alt="Cuomo footer Logo" data-align="center" data-entity-type="file" src="/modules/custom/nnycb_helpers/images/cuomo-footer-logo.png" /></a>';

    return $build;
  }

}