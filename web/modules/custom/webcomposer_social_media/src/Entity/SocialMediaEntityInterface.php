<?php

namespace Drupal\webcomposer_social_media\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Social Media entities.
 *
 * @ingroup webcomposer_social_media
 */
interface SocialMediaEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Social Media name.
   *
   * @return string
   *   Name of the Social Media.
   */
  public function getName();

  /**
   * Sets the Social Media name.
   *
   * @param string $name
   *   The Social Media name.
   *
   * @return \Drupal\webcomposer_social_media\Entity\SocialMediaEntityInterface
   *   The called Social Media entity.
   */
  public function setName($name);

  /**
   * Gets the Social Media creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Social Media.
   */
  public function getCreatedTime();

  /**
   * Sets the Social Media creation timestamp.
   *
   * @param int $timestamp
   *   The Social Media creation timestamp.
   *
   * @return \Drupal\webcomposer_social_media\Entity\SocialMediaEntityInterface
   *   The called Social Media entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Social Media published status indicator.
   *
   * Unpublished Social Media are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Social Media is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Social Media.
   *
   * @param bool $published
   *   TRUE to set this Social Media to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_social_media\Entity\SocialMediaEntityInterface
   *   The called Social Media entity.
   */
  public function setPublished($published);

}
