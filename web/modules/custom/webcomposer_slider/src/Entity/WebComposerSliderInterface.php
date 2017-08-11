<?php

namespace Drupal\webcomposer_slider\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Web Composer Slider entities.
 *
 * @ingroup webcomposer_slider
 */
interface WebComposerSliderInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Web Composer Slider type.
   *
   * @return string
   *   The Web Composer Slider type.
   */
  public function getType();

  /**
   * Gets the Web Composer Slider name.
   *
   * @return string
   *   Name of the Web Composer Slider.
   */
  public function getName();

  /**
   * Sets the Web Composer Slider name.
   *
   * @param string $name
   *   The Web Composer Slider name.
   *
   * @return \Drupal\webcomposer_slider\Entity\WebComposerSliderInterface
   *   The called Web Composer Slider entity.
   */
  public function setName($name);

  /**
   * Gets the Web Composer Slider creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Web Composer Slider.
   */
  public function getCreatedTime();

  /**
   * Sets the Web Composer Slider creation timestamp.
   *
   * @param int $timestamp
   *   The Web Composer Slider creation timestamp.
   *
   * @return \Drupal\webcomposer_slider\Entity\WebComposerSliderInterface
   *   The called Web Composer Slider entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Web Composer Slider published status indicator.
   *
   * Unpublished Web Composer Slider are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Web Composer Slider is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Web Composer Slider.
   *
   * @param bool $published
   *   TRUE to set this Web Composer Slider to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_slider\Entity\WebComposerSliderInterface
   *   The called Web Composer Slider entity.
   */
  public function setPublished($published);

}
