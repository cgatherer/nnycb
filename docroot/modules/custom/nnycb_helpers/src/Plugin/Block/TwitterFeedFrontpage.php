<?php

namespace Drupal\nnycb_helpers\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'TwitterFeedFrontpage' block.
 *
 * @Block(
 *  id = "twitter_feed_frontpage_block",
 *  admin_label = @Translation("Twitter Feed Frontpage"),
 * )
 */
class TwitterFeedFrontpage extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['twitter_feed_frontpage_block']['#markup'] = '<a class="twitter-timeline" data-lang="en" data-width="400" data-height="385" data-chrome="nofooter noborders" data-theme="light" href="https://twitter.com/NewNYBridge?ref_src=twsrc%5Etfw">Tweets by NewNYBridge</a><div class="twitter-button"><a href="https://twitter.com/NewNYBridge" target="_blank">Follow Us @NewNYBridge <i class="button-arrow-news-events" aria-hidden="true"></i></a></div>';

    return $build;
  }

}
