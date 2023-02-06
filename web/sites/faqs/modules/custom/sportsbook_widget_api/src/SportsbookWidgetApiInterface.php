<?php

namespace Drupal\sportsbook_widget_api;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defininga sportsbook widget api entity type.
 */
interface SportsbookWidgetApiInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface
{
  /**
   * Gets thesportsbook widget api title.
   *
   * @return string
   *   Title of thesportsbook widget api.
   */
  public function getTitle();

  /**
   * Sets thesportsbook widget api title.
   *
   * @param string $title
   *   Thesportsbook widget api title.
   *
   * @return \Drupal\sportsbook_widget_api\SportsbookWidgetApiInterface
   *   The calledsportsbook widget api entity.
   */
  public function setTitle($title);
  /**
   * Gets thesportsbook widget api creation timestamp.
   *
   * @return int
   *   Creation timestamp of thesportsbook widget api.
   */
  public function getCreatedTime();

  /**
   * Sets thesportsbook widget api creation timestamp.
   *
   * @param int $timestamp
   *   Thesportsbook widget api creation timestamp.
   *
   * @return \Drupal\sportsbook_widget_api\SportsbookWidgetApiInterface
   *   The calledsportsbook widget api entity.
   */
  public function setCreatedTime($timestamp);
  /**
   * Returns thesportsbook widget api status.
   *
   * @return bool
   *   TRUE if thesportsbook widget api is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets thesportsbook widget api status.
   *
   * @param bool $status
   *   TRUE to enable thissportsbook widget api, FALSE to disable.
   *
   * @return \Drupal\sportsbook_widget_api\SportsbookWidgetApiInterface
   *   The calledsportsbook widget api entity.
   */
  public function setStatus($status);
}
