<?php

namespace Drupal\webcomposer_marketing_script\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Marketing Script entities.
 *
 * @ingroup webcomposer_marketing_script
 */
interface MarketingScriptEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Marketing Script name.
   *
   * @return string
   *   Name of the Marketing Script.
   */
  public function getName();

  /**
   * Sets the Marketing Script name.
   *
   * @param string $name
   *   The Marketing Script name.
   *
   * @return \Drupal\webcomposer_marketing_script\Entity\MarketingScriptEntityInterface
   *   The called Marketing Script entity.
   */
  public function setName($name);

  /**
   * Gets the Marketing Script creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Marketing Script.
   */
  public function getCreatedTime();

  /**
   * Sets the Marketing Script creation timestamp.
   *
   * @param int $timestamp
   *   The Marketing Script creation timestamp.
   *
   * @return \Drupal\webcomposer_marketing_script\Entity\MarketingScriptEntityInterface
   *   The called Marketing Script entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Marketing Script published status indicator.
   *
   * Unpublished Marketing Script are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Marketing Script is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Marketing Script.
   *
   * @param bool $published
   *   TRUE to set this Marketing Script to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_marketing_script\Entity\MarketingScriptEntityInterface
   *   The called Marketing Script entity.
   */
  public function setPublished($published);

}
