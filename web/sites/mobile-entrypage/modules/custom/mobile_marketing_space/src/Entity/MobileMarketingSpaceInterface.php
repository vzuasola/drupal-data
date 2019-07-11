<?php

namespace Drupal\mobile_marketing_space\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mobile marketing space entities.
 *
 * @ingroup mobile_marketing_space
 */
interface MobileMarketingSpaceInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Mobile marketing space name.
   *
   * @return string
   *   Name of the Mobile marketing space.
   */
  public function getName();

  /**
   * Sets the Mobile marketing space name.
   *
   * @param string $name
   *   The Mobile marketing space name.
   *
   * @return \Drupal\mobile_marketing_space\Entity\MobileMarketingSpaceInterface
   *   The called Mobile marketing space entity.
   */
  public function setName($name);

  /**
   * Gets the Mobile marketing space creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mobile marketing space.
   */
  public function getCreatedTime();

  /**
   * Sets the Mobile marketing space creation timestamp.
   *
   * @param int $timestamp
   *   The Mobile marketing space creation timestamp.
   *
   * @return \Drupal\mobile_marketing_space\Entity\MobileMarketingSpaceInterface
   *   The called Mobile marketing space entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Mobile marketing space published status indicator.
   *
   * Unpublished Mobile marketing space are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Mobile marketing space is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Mobile marketing space.
   *
   * @param bool $published
   *   TRUE to set this Mobile marketing space to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mobile_marketing_space\Entity\MobileMarketingSpaceInterface
   *   The called Mobile marketing space entity.
   */
  public function setPublished($published);

}
