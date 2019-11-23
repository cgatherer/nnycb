<?php

namespace Drupal\lighting_display\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityStorageInterface;

/**
 * Defines the Lighting slot entity.
 *
 * @ingroup lighting_display
 *
 * @ContentEntityType(
 *   id = "lighting_slot",
 *   label = @Translation("Lighting slot"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lighting_display\LightingSlotListBuilder",
 *     "views_data" = "Drupal\lighting_display\Entity\LightingSlotViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\lighting_display\Form\LightingSlotForm",
 *       "add" = "Drupal\lighting_display\Form\LightingSlotForm",
 *       "edit" = "Drupal\lighting_display\Form\LightingSlotForm",
 *       "delete" = "Drupal\lighting_display\Form\LightingSlotDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\lighting_display\LightingSlotHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\lighting_display\LightingSlotAccessControlHandler",
 *   },
 *   base_table = "lighting_slot",
 *   translatable = FALSE,
 *   permission_granularity = "bundle",
 *   admin_permission = "administer lighting slot entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "field_slot_date",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/lighting_slot/{lighting_slot}",
 *     "add-form" = "/admin/structure/lighting_slot/add",
 *     "edit-form" = "/admin/structure/lighting_slot/{lighting_slot}/edit",
 *     "delete-form" = "/admin/structure/lighting_slot/{lighting_slot}/delete",
 *     "collection" = "/admin/structure/lighting_slot",
 *   },
 *   field_ui_base_route = "lighting_slot.settings"
 * )
 */
class LightingSlot extends ContentEntityBase implements LightingSlotInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getReserved() {
    return (bool) $this->get('reserved')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setReserved($boolean) {
    $this->set('reserved', $boolean);
  }

  /**
   * {@inheritdoc}
   * TODO: what is the actual gotten type of the datetime field?
   * TODO: do I need to convert it from a DB primitive to a DrupalDateTime object?
   */
  public function getSlotDate() {
    return  $this->get('field_slot_date')->value;
  }

  /**
   * {@inheritdoc}
   * TODO: what should the type be when setting?
   */
  public function setSlotDate($datetime) {
    $this->set('field_slot_date', $datetime);
  }

  /**
   * {@inheritdoc}
   */
  public function getApprovedDisplay() {
    return $this->get('approved_display')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function setApprovedDisplay(LightingDisplayInterface $lighting_display) {
    $this->approved_display = $lighting_display;
  }

  /**
   * {@inheritdoc}
   */
  public function getDisplayRequests() {
    return $this->get('display_requests')->referencedEntities();
  }

  /**
   * {@inheritdoc}
   */
  public function addDisplayRequest(LightingDisplayInterface $lighting_display) {
    if (!$this->hasDisplayRequest($lighting_display)) {
      $this->get('display_requests')->appendItem($lighting_display);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function removeFromRequests(LightingDisplayInterface $lighting_display) {
    $index = $this->getDisplayIndex($lighting_display);
    if ($index !== FALSE) {
      $this->get('display_requests')->offsetUnset($index);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function hasDisplayRequest(LightingDisplayInterface $lighting_display) {
    return $this->getDisplayIndex($lighting_display) !== FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getDisplayIndex(LightingDisplayInterface $lighting_display) {
    $values = $this->get('display_requests')->getValue();
    $display_ids = array_map(function($value) {
      return $value['target_id'];
    }, $values);

    return array_search($lighting_display->id(), $display_ids);
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['color_palette'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Color Palette'))
      ->setDescription(t('Choice of color palette depending on bird migration restriction.'))
      ->setSetting('display_description', TRUE)
      ->setSettings([
        'allowed_values' => [
          'standard' => 'Standard',
          'migration' => 'Bird Migration Season',
        ],
      ])
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('standard')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => -4,
      ])
      ->setRequired(TRUE);

    $fields['reserved'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Reserved'))
      ->setDescription(t('A boolean indicating whether the Lighting slot is reserved from use by the public.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['display_requests'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Display requests'))
      ->setDescription(t('Outside submissions for display in this slot.'))
      ->setSetting('display_description', TRUE)
      ->setSetting('target_type', 'lighting_display')
      ->setSetting('handler', 'default')
      ->setCardinality(BaseFieldDefinition::CARDINALITY_UNLIMITED)
      ->setDisplayOptions('form', array(
        'type' => 'inline_entity_form_complex',
        'weight' => -10,
      ));

    $fields['approved_display'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('The approved display'))
      ->setDescription(t('Display approved or created by admin.'))
      ->setSetting('display_description', TRUE)
      ->setSetting('target_type', 'lighting_display')
      ->setSetting('handler', 'default')
      ->setCardinality(1)
      ->setDisplayOptions('form', array(
        'type' => 'inline_entity_form_complex',
        'weight' => -8,
      ));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    // iterate the display requests and find the approved one
    // move it to the approved field
    foreach ($this->display_requests as $item) {
      /** @var \Drupal\lighting_display\Entity\LightingDisplayInterface $lighting_display */
      $lighting_display = $item->entity;
      if ($lighting_display && $lighting_display->getApproved() === true) {
        $this->removeFromRequests($lighting_display);
        $old_approved = $this->getApprovedDisplay();
        $this->setApprovedDisplay($lighting_display);
        if($old_approved) $old_approved->delete();
      }
    }
    // make sure the approved has checkbox approved
    $approved = $this->getApprovedDisplay();
    if ($approved && $approved->getApproved() !== true) {
      $approved->setApproved(true);
      $approved->save();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);

    // Ensure there's a back-reference on each display request.
    foreach ($this->display_requests as $item) {
      /** @var \Drupal\lighting_display\Entity\LightingDisplayInterface $lighting_display */
      $lighting_display = $item->entity;
      if (!$lighting_display->getSlotId()) {
        $lighting_display->display_slot_backref = $this->id();
        $lighting_display->save();
      }
    }

    // make sure the approved has checkbox approved
    $approved = $this->getApprovedDisplay();
    if ($approved && !$approved->getSlotId()) {
      $approved->display_slot_backref = $this->id();
      $approved->save();
    }
  }

}
