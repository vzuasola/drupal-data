<?php

namespace Drupal\lucky_baby_404\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky Baby 404 Image Entity entities.
 *
 * @ingroup lucky_baby_404
 */
interface LuckyBaby404ImageEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky Baby 404 Image Entity name.
   *
   * @return string
   *   Name of the Lucky Baby 404 Image Entity.
   */
  public function getName();

  /**
   * Sets the Lucky Baby 404 Image Entity name.
   *
   * @param string $name
   *   The Lucky Baby 404 Image Entity name.
   *
   * @return \Drupal\lucky_baby_404\Entity\LuckyBaby404ImageEntityInterface
   *   The called Lucky Baby 404 Image Entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky Baby 404 Image Entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky Baby 404 Image Entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky Baby 404 Image Entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky Baby 404 Image Entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_404\Entity\LuckyBaby404ImageEntityInterface
   *   The called Lucky Baby 404 Image Entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky Baby 404 Image Entity published status indicator.
   *
   * Unpublished Lucky Baby 404 Image Entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky Baby 404 Image Entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky Baby 404 Image Entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky Baby 404 Image Entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_404\Entity\LuckyBaby404ImageEntityInterface
   *   The called Lucky Baby 404 Image Entity entity.
   */
  public function setPublished($published);

}
