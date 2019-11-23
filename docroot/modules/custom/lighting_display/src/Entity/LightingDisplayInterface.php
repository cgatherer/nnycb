<?php

namespace Drupal\lighting_display\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Lighting display entities.
 *
 * @ingroup lighting_display
 */
interface LightingDisplayInterface extends ContentEntityInterface, EntityChangedInterface {


  /**
   * Gets the Lighting display Tower color.
   *
   * @return string
   *   Tower color like this: Blue|#0000ff
   */
  public function getTowerColor();

  /**
   * Sets the Lighting display Tower color.
   *
   * @param string $color
   *   The Tower color.
   */
  public function setTowerColor($color);

  /**
   * Gets the Lighting display Pier color.
   *
   * @return string
   *   Pier color like this: Blue|#0000ff
   */
  public function getPierColor1();

  /**
   * Sets the Lighting display Pier color.
   *
   * @param string $color
   *   The Pier color.
   */
  public function setPierColor1($color);

  /**
   * Gets the Lighting display Pier other color.
   *
   * @return string
   *   Pier color like this: Blue|#0000ff
   */
  public function getPierColor2();

  /**
   * Sets the Lighting display Pier other color.
   *
   * @param string $color
   *   The other color.
   */
  public function setPierColor2($color);

  /**
   * Gets the Lighting display applicant's name.
   *
   * @return string
   *   Name of the Lighting display applicant.
   */
  public function getApplicantName();

  /**
   * Sets the Lighting display applicant's name.
   *
   * @param string $name
   *   The applicant's name.
   */
  public function setApplicantName($name);

  /**
   * Gets the Lighting display applicant's organization.
   *
   * @return string
   *   Name of the applicant's org.
   */
  public function getApplicantOrg();

  /**
   * the Lighting display applicant's organization.
   *
   * @param string $org
   *   The applicant's organization
   */
  public function setApplicantOrg($org);

  /**
   * Gets the Lighting display applicant's zip.
   *
   * @return string
   *   Zip of the Lighting display applicant.
   */
  public function getApplicantZip();

  /**
   * Sets the Lighting display applicant's zip.
   *
   * @param string $zip
   *   The applicant zip.
   */
  public function setApplicantZip($zip);

  /**
   * Gets the Lighting display' slot entity.
   *
   * @return \Drupal\lighting_display\Entity\LightingSlotInterface
   */
  public function getSlot();

  /**
   * Gets the Lighting display' slot id.
   *
   * @return int|null
   *   The slot ID, or null.
   */
  public function getSlotId();

  /**
   * Sets the unique identification number of the slot linked to this display
   *
   * @param int $slot_id
   *    The unique identification number of the display slot
   */
  public function setSlotId($slot_id);

  /**
   * Set the lighting slot for the lighting display
   *
   * @param \Drupal\lighting_display\Entity\LightingSlotInterface $slot
   */
  public function setSlot(LightingSlotInterface $slot);


  /**
   * Gets is display approved by admin for its slot
   *
   * @return bool
   */
  public function getApproved();

  /**
   * Sets is display approved by admin for its slot
   *
   * @param $boolean
   */
  public function setApproved($boolean);

  /**
   * Gets the Lighting display name.
   *
   * @return string
   *   Name of the Lighting display.
   */
  public function getName();

  /**
   * Sets the Lighting display name.
   *
   * @param string $name
   *   The Lighting display name.
   *
   * @return \Drupal\lighting_display\Entity\LightingDisplayInterface
   *   The called Lighting display entity.
   */
  public function setName($name);

  /**
   * Gets the description of hte lighting display
   *
   * @return string
   */
  public function getDescription();

  /**
   * Sets the description of the lighting display
   *
   * @param string $desc
   */
  public function setDescription($desc);

  /**
   * Gets is display permitted for share/social by admin
   *
   * @return bool
   */
  public function getPermission();

  /**
   * Sets is display permitted for share/social by admin
   *
   * @param $boolean
   */
  public function setPermission($boolean);

  /**
   * Gets the Lighting display creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lighting display.
   */
  public function getCreatedTime();

  /**
   * Sets the Lighting display creation timestamp.
   *
   * @param int $timestamp
   *   The Lighting display creation timestamp.
   *
   * @return \Drupal\lighting_display\Entity\LightingDisplayInterface
   *   The called Lighting display entity.
   */
  public function setCreatedTime($timestamp);

}
