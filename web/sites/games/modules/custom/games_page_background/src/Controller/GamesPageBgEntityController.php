<?php

namespace Drupal\games_page_background\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\games_page_background\Entity\GamesPageBgEntityInterface;

/**
 * Class GamesPageBgEntityController.
 *
 *  Returns responses for Games Page Background routes.
 *
 * @package Drupal\games_page_background\Controller
 */
class GamesPageBgEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Games Page Background  revision.
   *
   * @param int $games_page_bg_entity_revision
   *   The Games Page Background  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($games_page_bg_entity_revision) {
    $games_page_bg_entity = $this->entityManager()->getStorage('games_page_bg_entity')->loadRevision($games_page_bg_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('games_page_bg_entity');

    return $view_builder->view($games_page_bg_entity);
  }

  /**
   * Page title callback for a Games Page Background  revision.
   *
   * @param int $games_page_bg_entity_revision
   *   The Games Page Background  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($games_page_bg_entity_revision) {
    $games_page_bg_entity = $this->entityManager()->getStorage('games_page_bg_entity')->loadRevision($games_page_bg_entity_revision);
    return $this->t('Revision of %title from %date', array('%title' => $games_page_bg_entity->label(), '%date' => format_date($games_page_bg_entity->getRevisionCreationTime())));
  }

  /**
   * Generates an overview table of older revisions of a Games Page Background .
   *
   * @param \Drupal\games_page_background\Entity\GamesPageBgEntityInterface $games_page_bg_entity
   *   A Games Page Background  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(GamesPageBgEntityInterface $games_page_bg_entity) {
    $account = $this->currentUser();
    $langcode = $games_page_bg_entity->language()->getId();
    $langname = $games_page_bg_entity->language()->getName();
    $languages = $games_page_bg_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $games_page_bg_entity_storage = $this->entityManager()->getStorage('games_page_bg_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $games_page_bg_entity->label()]) : $this->t('Revisions for %title', ['%title' => $games_page_bg_entity->label()]);
    $header = array($this->t('Revision'), $this->t('Operations'));

    $revert_permission = (($account->hasPermission("revert all games page background revisions")
                        || $account->hasPermission('administer games page background entities')));
    $delete_permission = (($account->hasPermission("delete all games page background revisions")
                        || $account->hasPermission('administer games page background entities')));

    $rows = array();

    $vids = $games_page_bg_entity_storage->revisionIds($games_page_bg_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\games_page_background\GamesPageBgEntityInterface $revision */
      $revision = $games_page_bg_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->revision_timestamp->value, 'short');
        if ($vid != $games_page_bg_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.games_page_bg_entity.revision', [
              'games_page_bg_entity' => $games_page_bg_entity->id(),
              'games_page_bg_entity_revision' => $vid
          ]));
        }
        else {
          $link = $games_page_bg_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}
                {% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->revision_log_message->value, '#allowed_tags' => Xss::getHtmlTagList()],
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
              Url::fromRoute('entity.games_page_bg_entity.translation_revert', [
                  'games_page_bg_entity' => $games_page_bg_entity->id(),
                  'games_page_bg_entity_revision' => $vid,
                  'langcode' => $langcode
              ]) :
              Url::fromRoute('entity.games_page_bg_entity.revision_revert', [
                  'games_page_bg_entity' => $games_page_bg_entity->id(),
                  'games_page_bg_entity_revision' => $vid
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.games_page_bg_entity.revision_delete', [
                  'games_page_bg_entity' => $games_page_bg_entity->id(),
                  'games_page_bg_entity_revision' => $vid
              ]),
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

    $build['games_page_bg_entity_revisions_table'] = array(
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    );

    return $build;
  }

}
