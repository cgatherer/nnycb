<?php

namespace Drupal\lighting_display;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Lighting display entity.
 *
 * @see \Drupal\lighting_display\Entity\LightingDisplay.
 */
class LightingDisplayAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lighting_display\Entity\LightingDisplayInterface $entity */

    switch ($operation) {

      case 'view':

        return AccessResult::allowedIfHasPermission($account, 'view lighting display entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit lighting display entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete lighting display entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add lighting display entities');
  }
}