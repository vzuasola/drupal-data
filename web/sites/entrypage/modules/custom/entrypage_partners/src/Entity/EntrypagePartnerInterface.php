<?php

namespace Drupal\entrypage_partners\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Entrypage partner entities.
 *
 * @ingroup entrypage_partners
 */
interface EntrypagePartnerInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

    // Add get/set methods for your configuration properties here.

    /**
     * Gets the Entrypage partner name.
     *
     * @return string
     *   Name of the Entrypage partner.
     */
    public function getName();

    /**
     * Sets the Entrypage partner name.
     *
     * @param string $name
     *   The Entrypage partner name.
     *
     * @return \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface
     *   The called Entrypage partner entity.
     */
    public function setName($name);

    /**
     * Gets the Entrypage partner creation timestamp.
     *
     * @return int
     *   Creation timestamp of the Entrypage partner.
     */
    public function getCreatedTime();

    /**
     * Sets the Entrypage partner creation timestamp.
     *
     * @param int $timestamp
     *   The Entrypage partner creation timestamp.
     *
     * @return \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface
     *   The called Entrypage partner entity.
     */
    public function setCreatedTime($timestamp);

    /**
     * Returns the Entrypage partner published status indicator.
     *
     * Unpublished Entrypage partner are only visible to restricted users.
     *
     * @return bool
     *   TRUE if the Entrypage partner is published.
     */
    public function isPublished();

    /**
     * Sets the published status of a Entrypage partner.
     *
     * @param bool $published
     *   TRUE to set this Entrypage partner to published, FALSE to set it to unpublished.
     *
     * @return \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface
     *   The called Entrypage partner entity.
     */
    public function setPublished($published);
}
