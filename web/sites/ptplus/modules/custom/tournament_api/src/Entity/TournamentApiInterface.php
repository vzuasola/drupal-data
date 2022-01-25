<?php

namespace Drupal\tournament_api\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for definingTournament Api entities.
 *
 * @ingrouptournament_api
 */
interface TournamentApiInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface
{  // Add get/set methods for your configuration properties here.

  /**
   * Gets theTournament Api name.
   *
   * @return string
   *   Name of theTournament Api.
   */
  public function getName();

  /**
   * Sets theTournament Api name.
   *
   * @param string $name
   *   TheTournament Api name.
   *
   * @return \Drupal\tournament_api\Entity\TournamentApiInterface
   *   The calledTournament Api entity.
   */
  public function setName($name);

  /**
   * Gets theTournament Api creation timestamp.
   *
   * @return int
   *   Creation timestamp of theTournament Api.
   */
  public function getCreatedTime();

  /**
   * Sets theTournament Api creation timestamp.
   *
   * @param int $timestamp
   *   TheTournament Api creation timestamp.
   *
   * @return \Drupal\tournament_api\Entity\TournamentApiInterface
   *   The calledTournament Api entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns theTournament Api published status indicator.
   *
   * UnpublishedTournament Api are only visible to restricted users.
   *
   * @return bool
   *   TRUE if theTournament Api is published.
   */
  public function isPublished();

  /**
   * Sets the published status of aTournament Api.
   *
   * @param bool $published
   *   TRUE to set thisTournament Api to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\tournament_api\Entity\TournamentApiInterface
   *   The calledTournament Api entity.
   */
  public function setPublished($published);
}
