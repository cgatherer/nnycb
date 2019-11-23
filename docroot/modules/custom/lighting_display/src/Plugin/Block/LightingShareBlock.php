<?php

namespace Drupal\lighting_display\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'LightingShareBlock' block.
 *
 * @Block(
 *  id = "lighting_share_block",
 *  admin_label = @Translation("Lighting share block"),
 * )
 */
class LightingShareBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'lighting_share_block';
    $markup = '<div id="lighting-simulation">
        <img class="lighting-base" src="/modules/custom/lighting_display/images/base.jpg" alt="Cuomo Bridge lit all in white. Following images overlay to add color" />
        <img class="lighting-overlay towers towers-pink" src="/modules/custom/lighting_display/images/towers-pink.png" alt="Pink tower color" />
        <img class="lighting-overlay towers towers-purple" src="/modules/custom/lighting_display/images/towers-purple.png" alt="Purple tower color" />
        <img class="lighting-overlay towers towers-blue" src="/modules/custom/lighting_display/images/towers-blue.png" alt="Blue tower color" />
        <img class="lighting-overlay towers towers-blue-green" src="/modules/custom/lighting_display/images/towers-blue-green.png" alt="Blue-Green tower color" />
        <img class="lighting-overlay towers towers-mint-green" src="/modules/custom/lighting_display/images/towers-mint-green.png" alt="Mint Green tower color" />
        <img class="lighting-overlay towers towers-dark-green" src="/modules/custom/lighting_display/images/towers-dark-green.png" alt="Dark Green tower color" />
        <img class="lighting-overlay towers towers-green" src="/modules/custom/lighting_display/images/towers-green.png" alt="Green tower color" />
        <img class="lighting-overlay towers towers-yellow" src="/modules/custom/lighting_display/images/towers-yellow.png" alt="Yellow tower color" />
        <img class="lighting-overlay towers towers-orange" src="/modules/custom/lighting_display/images/towers-orange.png" alt="Orange tower color" />
        <img class="lighting-overlay towers towers-dark-orange" src="/modules/custom/lighting_display/images/towers-dark-orange.png" alt="Dark Orange tower color" />
        <img class="lighting-overlay towers towers-red-orange" src="/modules/custom/lighting_display/images/towers-red-orange.png" alt="Red-Orange tower color" />
        <img class="lighting-overlay towers towers-red" src="/modules/custom/lighting_display/images/towers-red.png" alt="Red tower color" />
        
        <img class="lighting-overlay pier1 pier1-pink" src="/modules/custom/lighting_display/images/pier1-pink.png" alt="Pink pier1 color" />
        <img class="lighting-overlay pier1 pier1-purple" src="/modules/custom/lighting_display/images/pier1-purple.png" alt="Purple pier1 color" />
        <img class="lighting-overlay pier1 pier1-blue" src="/modules/custom/lighting_display/images/pier1-blue.png" alt="Blue tower color" />
        <img class="lighting-overlay pier1 pier1-blue-green" src="/modules/custom/lighting_display/images/pier1-blue-green.png" alt="Blue-Green pier1 color" />
        <img class="lighting-overlay pier1 pier1-mint-green" src="/modules/custom/lighting_display/images/pier1-mint-green.png" alt="Mint Green pier1 color" />
        <img class="lighting-overlay pier1 pier1-dark-green" src="/modules/custom/lighting_display/images/pier1-dark-green.png" alt="Dark Green pier1 color" />
        <img class="lighting-overlay pier1 pier1-green" src="/modules/custom/lighting_display/images/pier1-green.png" alt="Green pier1 color" />
        <img class="lighting-overlay pier1 pier1-yellow" src="/modules/custom/lighting_display/images/pier1-yellow.png" alt="Yellow pier1 color" />
        <img class="lighting-overlay pier1 pier1-orange" src="/modules/custom/lighting_display/images/pier1-orange.png" alt="Orange pier1 color" />
        <img class="lighting-overlay pier1 pier1-dark-orange" src="/modules/custom/lighting_display/images/pier1-dark-orange.png" alt="Dark Orange pier1 color" />
        <img class="lighting-overlay pier1 pier1-red-orange" src="/modules/custom/lighting_display/images/pier1-red-orange.png" alt="Red-Orange pier1 color" />
        <img class="lighting-overlay pier1 pier1-red" src="/modules/custom/lighting_display/images/pier1-red.png" alt="Red pier1 color" />
        
        <img class="lighting-overlay pier2 pier2-pink" src="/modules/custom/lighting_display/images/pier2-pink.png" alt="Pink pier2 color" />
        <img class="lighting-overlay pier2 pier2-purple" src="/modules/custom/lighting_display/images/pier2-purple.png" alt="Purple pier2 color" />
        <img class="lighting-overlay pier2 pier2-blue" src="/modules/custom/lighting_display/images/pier2-blue.png" alt="Blue tower color" />
        <img class="lighting-overlay pier2 pier2-blue-green" src="/modules/custom/lighting_display/images/pier2-blue-green.png" alt="Blue-Green pier2 color" />
        <img class="lighting-overlay pier2 pier2-mint-green" src="/modules/custom/lighting_display/images/pier2-mint-green.png" alt="Mint Green pier2 color" />
        <img class="lighting-overlay pier2 pier2-dark-green" src="/modules/custom/lighting_display/images/pier2-dark-green.png" alt="Dark Green pier2 color" />
        <img class="lighting-overlay pier2 pier2-green" src="/modules/custom/lighting_display/images/pier2-green.png" alt="Green pier2 color" />
        <img class="lighting-overlay pier2 pier2-yellow" src="/modules/custom/lighting_display/images/pier2-yellow.png" alt="Yellow pier2 color" />
        <img class="lighting-overlay pier2 pier2-orange" src="/modules/custom/lighting_display/images/pier2-orange.png" alt="Orange pier2 color" />
        <img class="lighting-overlay pier2 pier2-dark-orange" src="/modules/custom/lighting_display/images/pier2-dark-orange.png" alt="Dark Orange pier2 color" />
        <img class="lighting-overlay pier2 pier2-red-orange" src="/modules/custom/lighting_display/images/pier2-red-orange.png" alt="Red-Orange pier2 color" />
        <img class="lighting-overlay pier2 pier2-red" src="/modules/custom/lighting_display/images/pier2-red.png" alt="Red pier2 color" />
      </div>
      <div class="row">
        <div class="colors">
          <strong>Selected Colors:</strong>
          <div class="selection">
            <div class="color-label">Cables/Towers</div>
            <div class="color color-towers">
              <div class="color-value"></div>
              <div class="color-name"></div>
            </div>
          </div>
          <div class="selection">
            <div class="color-label">Pier Color 1</div>
            <div class="color color-pier1">
              <div class="color-value"></div>
              <div class="color-name"></div>
            </div>
          </div>
          <div class="selection">
            <div class="color-label">Pier Color 2</div>
            <div class="color color-pier2">
              <div class="color-value"></div>
              <div class="color-name"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="info">
          <strong>Lighting Display Info:</strong>
          <div class="info-line applicant-name">
            <div class="info-label">Submitter</div>
            <div class="info-value"></div>
          </div>
          <div class="info-line applicant-org">
            <div class="info-label">Organization</div>
            <div class="info-value"></div>
          </div>
          <div class="info-line display-name">
            <div class="info-label">Display Name</div>
            <div class="info-value"></div>
          </div>
        </div>
      </div>
      <div class="share-social">
      <strong>Share it:</strong> <a class="share-url" href="/"></a>
      <!-- AddToAny BEGIN -->
      <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
        <a class="a2a_button_facebook"></a>
        <a class="a2a_button_twitter"></a>
        <a class="a2a_button_email"></a>
      </div>
      <!-- AddToAny END -->
    </div>';

    $build['#attached']['library'][] = 'lighting_display/lighting_share';
    $build['lighting_share_block']['#markup'] = $markup;

    return $build;
  }

}
