<?php

namespace Drupal\nnycb_helpers\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'NYFooterLogoBlock' block.
 *
 * @Block(
 *  id = "ny_footer_logo_block",
 *  admin_label = @Translation("NY Footer Logo"),
 * )
 */
class NYFooterLogoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['ny_footer_logo_block']['#markup'] = '<a href="/"><img alt="New York Logo" data-align="center" data-entity-type="file" src="/modules/custom/nnycb_helpers/images/logo_footer.png" /></a>';

    return $build;
  }

}
