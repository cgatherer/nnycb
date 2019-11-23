<?php

namespace Drupal\lighting_display;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lighting slot entities.
 *
 * @ingroup lighting_display
 */
class LightingSlotListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Lighting slot ID');
    $header['date'] = $this->t('Date');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\lighting_display\Entity\LightingSlot $entity */
    $row['id'] = $entity->id();
    $row['date'] = Link::createFromRoute(
      $entity->label(),
      'entity.lighting_slot.edit_form',
      ['lighting_slot' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
