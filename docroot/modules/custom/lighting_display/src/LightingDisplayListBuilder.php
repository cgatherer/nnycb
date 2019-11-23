<?php

namespace Drupal\lighting_display;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lighting display entities.
 *
 * @ingroup lighting_display
 */
class LightingDisplayListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Lighting display ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\lighting_display\Entity\LightingDisplay $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lighting_display.edit_form',
      ['lighting_display' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
