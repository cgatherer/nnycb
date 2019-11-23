<?php

namespace Drupal\nnycb_helpers\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'UniversalSearchBlock' block.
 *
 * @Block(
 *  id = "universal_search_block",
 *  admin_label = @Translation("Universal Search"),
 * )
 */
class UniversalSearchBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['universal_search_block']['#markup'] = t('<div class="nygov-universal_searcher" id="nav-meta"><form accept-charset="UTF-8" action="/search/node" class="search-form" id="search-block-form" method="get"><input aria-label="search" autocomplete="off" class="nav-link nav-link-search nygov-universal_searcher-input ui-autocomplete-input" data-type="search" id="ny-global-search" placeholder="Search" /><i class="fas fa-search"></i><button class="submit-search" type="submit">Submit</button></form></div>');

    return $build;
  }

}
