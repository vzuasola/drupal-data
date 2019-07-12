<?php

namespace Drupal\webcomposer_slider\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Webcomposer slider entity entities.
 *
 * @ingroup webcomposer_slider
 */
interface WebcomposerSliderEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Webcomposer slider entity name.
   *
   * @return string
   *   Name of the Webcomposer slider entity.
   */
  public function getName();

  /**
   * Sets the Webcomposer slider entity name.
   *
   * @param string $name
   *   The Webcomposer slider entity name.
   *
   * @return \Drupal\webcomposer_slider\Entity\WebcomposerSliderEntityInterface
   *   The called Webcomposer slider entity entity.
   */
  public function setName($name);

  /**
   * Gets the Webcomposer slider entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Webcomposer slider entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Webcomposer slider entity creation timestamp.
   *
   * @param int $timestamp
   *   The Webcomposer slider entity creation timestamp.
   *
   * @return \Drupal\webcomposer_slider\Entity\WebcomposerSliderEntityInterface
   *   The called Webcomposer slider entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Webcomposer slider entity published status indicator.
   *
   * Unpublished Webcomposer slider entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Webcomposer slider entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Webcomposer slider entity.
   *
   * @param bool $published
   *   TRUE to set this Webcomposer slider entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_slider\Entity\WebcomposerSliderEntityInterface
   *   The called Webcomposer slider entity entity.
   */
  public function setPublished($published);

}
