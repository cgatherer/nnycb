<?php

namespace Drupal\lighting_display\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Lighting slot entities.
 *
 * @ingroup lighting_display
 */
interface LightingSlotInterface extends ContentEntityInterface, EntityChangedInterface {

  /**
   * Gets is the slot reserved for admin use
   *
   * @return bool
   */
  public function getReserved();

  /**
   * Sets is slot reserved for admin use
   *
   * @param $boolean value to set
   */
  public function setReserved($boolean);

  /**
   * Get the Slot date
   *
   * @return \Drupal\Core\Datetime\DrupalDateTime
   */
  public function getSlotDate();

  /**
   * Set the Slot date
   *
   * @param $datetime
   */
  public function setSlotDate($datetime);

  /**
   * Get the approved display
   *
   * @return \Drupal\lighting_display\Entity\LightingDisplayInterface
   */
  public function getApprovedDisplay();

  /**
   * Set the approved display
   *
   * @param \Drupal\lighting_display\Entity\LightingDisplayInterface $lighting_display
   */
  public function setApprovedDisplay(LightingDisplayInterface $lighting_display);

  /**
   * Get the display submissions
   *
   * @return array submissions
   */
  public function getDisplayRequests();

  /**
   * Add a display request
   *
   * @param \Drupal\lighting_display\Entity\LightingDisplayInterface $lighting_display
   */
  public function addDisplayRequest(LightingDisplayInterface $lighting_display);

  /**
   * Remove a lighting display from the submissions
   *
   * @param \Drupal\lighting_display\Entity\LightingDisplayInterface $lighting_display
   */
  public function removeFromRequests(LightingDisplayInterface $lighting_display);

  /**
   * Find if the slot has a given lighting display request
   *
   * @param \Drupal\lighting_display\Entity\LightingDisplayInterface $lighting_display
   * @return bool
   */
  public function hasDisplayRequest(LightingDisplayInterface $lighting_display);

  /**
   * Gets the index of the given Lighting Display.
   *
   * @param \Drupal\lighting_display\Entity\LightingDisplayInterface $lighting_display
   *
   * @return int|bool
   *    The index of the given Product Display, or FALSE if not found.
   */

  public function getDisplayIndex(LightingDisplayInterface $lighting_display);

  /**
   * Gets the Lighting slot creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lighting slot.
   */
  public function getCreatedTime();

  /**
   * Sets the Lighting slot creation timestamp.
   *
   * @param int $timestamp
   *   The Lighting slot creation timestamp.
   *
   * @return \Drupal\lighting_display\Entity\LightingSlotInterface
   *   The called Lighting slot entity.
   */
  public function setCreatedTime($timestamp);

}
