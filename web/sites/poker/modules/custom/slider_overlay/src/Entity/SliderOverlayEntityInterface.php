<?php

namespace Drupal\slider_overlay\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Slider Overlay entities.
 *
 * @ingroup slider_overlay
 */
interface SliderOverlayEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Slider Overlay name.
   *
   * @return string
   *   Name of the Slider Overlay.
   */
  public function getName();

  /**
   * Sets the Slider Overlay name.
   *
   * @param string $name
   *   The Slider Overlay name.
   *
   * @return \Drupal\slider_overlay\Entity\SliderOverlayEntityInterface
   *   The called Slider Overlay entity.
   */
  public function setName($name);

  /**
   * Gets the Slider Overlay creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Slider Overlay.
   */
  public function getCreatedTime();

  /**
   * Sets the Slider Overlay creation timestamp.
   *
   * @param int $timestamp
   *   The Slider Overlay creation timestamp.
   *
   * @return \Drupal\slider_overlay\Entity\Slider OverlayEntityInterface
   *   The called Slider Overlay entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Slider Overlay published status indicator.
   *
   * Unpublished Slider Overlay are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Slider Overlay is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Slider Overlay.
   *
   * @param bool $published
   *   TRUE to set this Slider Overlay to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\slider_overlay\Entity\Slider OverlayEntityInterface
   *   The called Slider Overlay entity.
   */
  public function setPublished($published);

}
