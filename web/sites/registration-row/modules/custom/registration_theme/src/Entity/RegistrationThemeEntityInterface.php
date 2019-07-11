<?php

namespace Drupal\registration_theme\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Registration theme entity entities.
 *
 * @ingroup registration_theme
 */
interface RegistrationThemeEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Registration theme entity name.
   *
   * @return string
   *   Name of the Registration theme entity.
   */
  public function getName();

  /**
   * Sets the Registration theme entity name.
   *
   * @param string $name
   *   The Registration theme entity name.
   *
   * @return \Drupal\registration_theme\Entity\RegistrationThemeEntityInterface
   *   The called Registration theme entity entity.
   */
  public function setName($name);

  /**
   * Gets the Registration theme entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Registration theme entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Registration theme entity creation timestamp.
   *
   * @param int $timestamp
   *   The Registration theme entity creation timestamp.
   *
   * @return \Drupal\registration_theme\Entity\RegistrationThemeEntityInterface
   *   The called Registration theme entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Registration theme entity published status indicator.
   *
   * Unpublished Registration theme entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Registration theme entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Registration theme entity.
   *
   * @param bool $published
   *   TRUE to set this Registration theme entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\registration_theme\Entity\RegistrationThemeEntityInterface
   *   The called Registration theme entity entity.
   */
  public function setPublished($published);

}
