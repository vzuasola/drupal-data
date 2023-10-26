<?php

namespace Drupal\webcomposer_content_slider\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Content Slider entity entities.
 *
 * @ingroup webcomposer_content_slider
 */
interface ContentSliderEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Content Slider entity name.
   *
   * @return string
   *   Name of the Content Slider entity.
   */
  public function getName();

  /**
   * Sets the Content Slider entity name.
   *
   * @param string $name
   *   The Content Slider entity name.
   *
   * @return \Drupal\webcomposer_content_slider\Entity\ContentSliderEntityInterface
   *   The called Content Slider entity entity.
   */
  public function setName($name);

  /**
   * Gets the Content Slider entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Content Slider entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Content Slider entity creation timestamp.
   *
   * @param int $timestamp
   *   The Content Slider entity creation timestamp.
   *
   * @return \Drupal\webcomposer_content_slider\Entity\ContentSliderEntityInterface
   *   The called Content Slider entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Content Slider entity published status indicator.
   *
   * Unpublished Content Slider entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Content Slider entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Content Slider entity.
   *
   * @param bool $published
   *   TRUE to set this Content Slider entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_content_slider\Entity\ContentSliderEntityInterface
   *   The called Content Slider entity entity.
   */
  public function setPublished($published);

}
