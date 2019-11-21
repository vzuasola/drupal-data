<?php

namespace Drupal\lucky_baby_faq\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky Baby FAQ Entity entities.
 *
 * @ingroup lucky_baby_faq
 */
interface LuckyBabyFAQEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky Baby FAQ Entity name.
   *
   * @return string
   *   Name of the Lucky Baby FAQ Entity.
   */
  public function getName();

  /**
   * Sets the Lucky Baby FAQ Entity name.
   *
   * @param string $name
   *   The Lucky Baby FAQ Entity name.
   *
   * @return \Drupal\lucky_baby_faq\Entity\LuckyBabyFAQEntityInterface
   *   The called Lucky Baby FAQ Entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky Baby FAQ Entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky Baby FAQ Entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky Baby FAQ Entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky Baby FAQ Entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_faq\Entity\LuckyBabyFAQEntityInterface
   *   The called Lucky Baby FAQ Entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky Baby FAQ Entity published status indicator.
   *
   * Unpublished Lucky Baby FAQ Entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky Baby FAQ Entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky Baby FAQ Entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky Baby FAQ Entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_faq\Entity\LuckyBabyFAQEntityInterface
   *   The called Lucky Baby FAQ Entity entity.
   */
  public function setPublished($published);

}
