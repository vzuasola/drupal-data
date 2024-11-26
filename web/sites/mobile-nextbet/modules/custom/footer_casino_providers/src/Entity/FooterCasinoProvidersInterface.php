<?php

namespace Drupal\footer_casino_providers\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Footer Casino Providers entities.
 *
 * @ingroup footer_casino_providers
 */
interface FooterCasinoProvidersInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

    // Add get/set methods for your configuration properties here.

    /**
     * Gets the Footer Casino Providers name.
     *
     * @return string
     *   Name of the Footer Casino Providers.
     */
    public function getName();

    /**
     * Sets the Footer Casino Providers name.
     *
     * @param string $name
     *   The Footer Casino Providers name.
     *
     * @return \Drupal\footer_casino_providers\Entity\FooterCasinoProvidersInterface
     *   The called Footer Casino Providers entity.
     */
    public function setName($name);

    /**
     * Gets the Footer Casino Providers creation timestamp.
     *
     * @return int
     *   Creation timestamp of the Footer Casino Providers.
     */
    public function getCreatedTime();

    /**
     * Sets the Footer Casino Providers creation timestamp.
     *
     * @param int $timestamp
     *   The Footer Casino Providers creation timestamp.
     *
     * @return \Drupal\footer_casino_providers\Entity\FooterCasinoProvidersInterface
     *   The called Footer Casino Providers entity.
     */
    public function setCreatedTime($timestamp);

    /**
     * Returns the Footer Casino Providers published status indicator.
     *
     * Unpublished Footer Casino Providers are only visible to restricted users.
     *
     * @return bool
     *   TRUE if the Footer Casino Providers is published.
     */
    public function isPublished();

    /**
     * Sets the published status of a Footer Casino Providers.
     *
     * @param bool $published
     *   TRUE to set this Footer Casino Providers to published, FALSE to set it to unpublished.
     *
     * @return \Drupal\footer_casino_providers\Entity\FooterCasinoProvidersInterface
     *   The called Footer Casino Providers entity.
     */
    public function setPublished($published);
}
