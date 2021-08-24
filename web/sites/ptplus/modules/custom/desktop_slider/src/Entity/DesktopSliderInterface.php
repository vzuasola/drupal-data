<?php

namespace Drupal\desktop_slider\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for definingDesktop slider entities.
 *
 * @ingroupdesktop_slider
 */
interface DesktopSliderInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface
{  // Add get/set methods for your configuration properties here.

  /**
   * Gets theDesktop slider name.
   *
   * @return string
   *   Name of theDesktop slider.
   */
  public function getName();

  /**
   * Sets theDesktop slider name.
   *
   * @param string $name
   *   TheDesktop slider name.
   *
   * @return \Drupal\desktop_slider\Entity\DesktopSliderInterface
   *   The calledDesktop slider entity.
   */
  public function setName($name);

  /**
   * Gets theDesktop slider creation timestamp.
   *
   * @return int
   *   Creation timestamp of theDesktop slider.
   */
  public function getCreatedTime();

  /**
   * Sets theDesktop slider creation timestamp.
   *
   * @param int $timestamp
   *   TheDesktop slider creation timestamp.
   *
   * @return \Drupal\desktop_slider\Entity\DesktopSliderInterface
   *   The calledDesktop slider entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns theDesktop slider published status indicator.
   *
   * UnpublishedDesktop slider are only visible to restricted users.
   *
   * @return bool
   *   TRUE if theDesktop slider is published.
   */
  public function isPublished();

  /**
   * Sets the published status of aDesktop slider.
   *
   * @param bool $published
   *   TRUE to set thisDesktop slider to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\desktop_slider\Entity\DesktopSliderInterface
   *   The calledDesktop slider entity.
   */
  public function setPublished($published);
}
