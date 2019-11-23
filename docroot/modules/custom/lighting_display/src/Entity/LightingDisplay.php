<?php

namespace Drupal\lighting_display\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Lighting display entity.
 *
 * @ingroup lighting_display
 *
 * @ContentEntityType(
 *   id = "lighting_display",
 *   label = @Translation("Lighting display"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lighting_display\LightingDisplayListBuilder",
 *     "views_data" = "Drupal\lighting_display\Entity\LightingDisplayViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\lighting_display\Form\LightingDisplayForm",
 *       "add" = "Drupal\lighting_display\Form\LightingDisplayForm",
 *       "edit" = "Drupal\lighting_display\Form\LightingDisplayForm",
 *       "delete" = "Drupal\lighting_display\Form\LightingDisplayDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\lighting_display\LightingDisplayHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\lighting_display\LightingDisplayAccessControlHandler",
 *   },
 *   base_table = "lighting_display",
 *   translatable = FALSE,
 *   permission_granularity = "bundle",
 *   admin_permission = "administer lighting display entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/lighting_display/{lighting_display}",
 *     "add-form" = "/admin/structure/lighting_display/add",
 *     "edit-form" = "/admin/structure/lighting_display/{lighting_display}/edit",
 *     "delete-form" = "/admin/structure/lighting_display/{lighting_display}/delete",
 *     "collection" = "/admin/structure/lighting_display",
 *   },
 *   field_ui_base_route = "lighting_display.settings"
 * )
 */
class LightingDisplay extends ContentEntityBase implements LightingDisplayInterface {

  use EntityChangedTrait;


  /**
   * {@inheritdoc}
   */
  public function getTowerColor() {
    return $this->get('tower_color')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTowerColor($color) {
    $this->set('tower_color', $color);
  }

  /**
   * {@inheritdoc}
   */
  public function getPierColor1() {
    return $this->get('pier_color_1')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPierColor1($color) {
    $this->set('pier_color_1', $color);
  }

  /**
   * {@inheritdoc}
   */
  public function getPierColor2() {
    return $this->get('pier_color_2')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPierColor2($color) {
    $this->set('pier_color_2', $color);
  }

  /**
   * {@inheritdoc}
   */
  public function getApplicantName() {
    return $this->get('applicant_name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setApplicantName($name) {
    $this->set('applicant_name', $name);
  }

  /**
   * {@inheritdoc}
   */
  public function getApplicantOrg() {
    return $this->get('applicant_org')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setApplicantOrg($org) {
    $this->set('applicant_org', $org);
  }

  /**
   * {@inheritdoc}
   */
  public function getApplicantZip() {
    return $this->get('applicant_zip')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setApplicantZip($zip) {
    $this->set('applicant_zip', $zip);
  }

  /**
   * {@inheritdoc}
   */
  public function getSlot() {
    return $this->get('display_slot_backref')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getSlotId() {
    return $this->get('display_slot_backref')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setSlotId($slot_id) {
    $this->set('display_slot_backref', $slot_id);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setSlot(LightingSlotInterface $slot) {
    $this->display_slot_backref = $slot;
  }

  /**
   * {@inheritdoc}
   */
  public function getApproved() {
    return (bool) $this->get('approved')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setApproved($boolean) {
    $this->set('approved', $boolean);
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->get('description')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($desc) {
    $this->set('description', $desc);
  }

  /**
   * {@inheritdoc}
   */
  public function getPermission() {
    return (bool) $this->get('permission')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setPermission($boolean) {
    $this->set('permission', $boolean);
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

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Lighting display.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -14,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -14,
      ])
      ->setRequired(TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'default',
        'weight' => -10,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'text_textfield',
        'weight' => -10,
      ));

    $fields['tower_color'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Tower color'))
      ->setDescription(t('Color name and Hex color, pipe delimited.'))
      ->setSetting('display_description', TRUE)
      ->setSetting('allowed_values_function', ['\Drupal\lighting_display\Entity\LightingDisplay', 'getAvailableColors'])
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -8,
      ])
      ->setDisplayOptions('form', [
        'type' => 'lighting_colorselect',
        'weight' => -8,
      ])
      ->setRequired(TRUE);

    $fields['pier_color_1'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Pier color 1'))
      ->setDescription(t('Color name and Hex color, pipe delimited.'))
      ->setSetting('display_description', TRUE)
      ->setSetting('allowed_values_function', ['\Drupal\lighting_display\Entity\LightingDisplay', 'getAvailableColors'])
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -7,
      ])
      ->setDisplayOptions('form', [
        'type' => 'lighting_colorselect',
        'weight' => -7,
      ])
      ->setRequired(TRUE);

    $fields['pier_color_2'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Pier color 2'))
      ->setDescription(t('Color name and Hex color, pipe delimited.'))
      ->setSetting('display_description', TRUE)
      ->setSetting('allowed_values_function', ['\Drupal\lighting_display\Entity\LightingDisplay', 'getAvailableColors'])
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'lighting_colorselect',
        'weight' => -6,
      ])
      ->setRequired(TRUE);

    $fields['applicant_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Applicant Name'))
      ->setSettings([
        'max_length' => 120,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ]);

    $fields['applicant_org'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Applicant Organization'))
      ->setSettings([
        'max_length' => 220,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ]);

    $fields['applicant_zip'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Applicant ZIP'))
      ->setSettings([
        'max_length' => 10,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -3,
      ]);

    $fields['display_slot_backref'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Display slot backreference'))
      ->setSetting('target_type', 'lighting_slot')
      ->setSetting('handler', 'default')
      ->setCardinality(1);

    $fields['approved'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Approved'))
      ->setDescription(t('A boolean indicating whether the Lighting display is admin-approved for its slot.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 0,
      ]);

    $fields['permission'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Permission Granted'))
      ->setDescription(t('A boolean indicating whether the submitter has granted permission for NYThruway to share this display.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 0,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  public static function getAvailableColors() {

    $selected_palette = 'standard';

    $config = \Drupal::config('lighting_display.color_palettes');
    $palettes = $config->get('palettes');
    $palette = $palettes[$selected_palette];

    $options = [];
    foreach ($palette as $color) {
      $options[$color['name']  . '|' . $color['hex']] =  $color['name'];
    }

    return $options;
  }
}
