<?php

namespace Drupal\games_page_background\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\games_page_background\Entity\GamePageBackgroundInterface;

/**
 * Class GamePageBackgroundController.
 *
 *  Returns responses for Game Page Background routes.
 */
class GamePageBackgroundController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Game Page Background  revision.
   *
   * @param int $game_page_background_revision
   *   The Game Page Background  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($game_page_background_revision) {
    $game_page_background = $this->entityManager()->getStorage('game_page_background')->loadRevision($game_page_background_revision);
    $view_builder = $this->entityManager()->getViewBuilder('game_page_background');

    return $view_builder->view($game_page_background);
  }

  /**
   * Page title callback for a Game Page Background  revision.
   *
   * @param int $game_page_background_revision
   *   The Game Page Background  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($game_page_background_revision) {
    $game_page_background = $this->entityManager()->getStorage('game_page_background')->loadRevision($game_page_background_revision);
    return $this->t('Revision of %title from %date', ['%title' => $game_page_background->label(), '%date' => format_date($game_page_background->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Game Page Background .
   *
   * @param \Drupal\games_page_background\Entity\GamePageBackgroundInterface $game_page_background
   *   A Game Page Background  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(GamePageBackgroundInterface $game_page_background) {
    $account = $this->currentUser();
    $langcode = $game_page_background->language()->getId();
    $langname = $game_page_background->language()->getName();
    $languages = $game_page_background->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $game_page_background_storage = $this->entityManager()->getStorage('game_page_background');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $game_page_background->label()]) : $this->t('Revisions for %title', ['%title' => $game_page_background->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all game page Background revisions") || $account->hasPermission('administer game page Background entities')));
    $delete_permission = (($account->hasPermission("delete all game page Background revisions") || $account->hasPermission('administer game page Background entities')));

    $rows = [];

    $vids = $game_page_background_storage->revisionIds($game_page_background);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\games_page_background\GamePageBackgroundInterface $revision */
      $revision = $game_page_background_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $game_page_background->getRevisionId()) {
          $link = $this->l($date, new Url('entity.game_page_background.revision', ['game_page_background' => $game_page_background->id(), 'game_page_background_revision' => $vid]));
        }
        else {
          $link = $game_page_background->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.game_page_background.translation_revert', ['game_page_background' => $game_page_background->id(), 'game_page_background_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.game_page_background.revision_revert', ['game_page_background' => $game_page_background->id(), 'game_page_background_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.game_page_background.revision_delete', ['game_page_background' => $game_page_background->id(), 'game_page_background_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['game_page_background_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
