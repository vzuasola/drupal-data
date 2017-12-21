<?php

namespace Drupal\webcomposer_slider_v2\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Webcomposer slider 2.0 entity entities.
 *
 * @ingroup webcomposer_slider_v2
 */
interface WebcomposerSliderV2EntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Webcomposer slider 2.0 entity name.
   *
   * @return string
   *   Name of the Webcomposer slider 2.0 entity.
   */
  public function getName();

  /**
   * Sets the Webcomposer slider 2.0 entity name.
   *
   * @param string $name
   *   The Webcomposer slider 2.0 entity name.
   *
   * @return \Drupal\webcomposer_slider_v2\Entity\WebcomposerSliderV2EntityInterface
   *   The called Webcomposer slider 2.0 entity entity.
   */
  public function setName($name);

  /**
   * Gets the Webcomposer slider 2.0 entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Webcomposer slider 2.0 entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Webcomposer slider 2.0 entity creation timestamp.
   *
   * @param int $timestamp
   *   The Webcomposer slider 2.0 entity creation timestamp.
   *
   * @return \Drupal\webcomposer_slider_v2\Entity\WebcomposerSliderV2EntityInterface
   *   The called Webcomposer slider 2.0 entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Webcomposer slider 2.0 entity published status indicator.
   *
   * Unpublished Webcomposer slider 2.0 entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Webcomposer slider 2.0 entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Webcomposer slider 2.0 entity.
   *
   * @param bool $published
   *   TRUE to set this Webcomposer slider 2.0 entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_slider_v2\Entity\WebcomposerSliderV2EntityInterface
   *   The called Webcomposer slider 2.0 entity entity.
   */
  public function setPublished($published);

}
