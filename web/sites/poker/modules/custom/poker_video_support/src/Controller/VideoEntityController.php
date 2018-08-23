<?php

namespace Drupal\poker_video_support\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\poker_video_support\Entity\VideoEntityInterface;

/**
 * Class VideoEntityController.
 *
 *  Returns responses for Video entity routes.
 */
class VideoEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Video entity  revision.
   *
   * @param int $poker_video_entity_revision
   *   The Video entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($poker_video_entity_revision) {
    $poker_video_entity = $this->entityManager()->getStorage('poker_video_entity')
        ->loadRevision($poker_video_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('poker_video_entity');

    return $view_builder->view($poker_video_entity);
  }

  /**
   * Page title callback for a Video entity  revision.
   *
   * @param int $poker_video_entity_revision
   *   The Video entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($poker_video_entity_revision) {
    $poker_video_entity = $this->entityManager()->getStorage('poker_video_entity')
        ->loadRevision($poker_video_entity_revision);
    return $this->t('Revision of %title from %date', [
        '%title' => $poker_video_entity->label(),
        '%date' => format_date($poker_video_entity->getRevisionCreationTime())
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Video entity .
   *
   * @param \Drupal\poker_video_support\Entity\VideoEntityInterface $poker_video_entity
   *   A Video entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(VideoEntityInterface $poker_video_entity) {
    $account = $this->currentUser();
    $langcode = $poker_video_entity->language()->getId();
    $langname = $poker_video_entity->language()->getName();
    $languages = $poker_video_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $poker_video_entity_storage = $this->entityManager()->getStorage('poker_video_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', [
        '@langname' => $langname,
        '%title' => $poker_video_entity->label()
    ]) : $this->t('Revisions for %title', ['%title' => $poker_video_entity->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all video entity revisions") ||
        $account->hasPermission('administer video entity entities')));
    $delete_permission = (($account->hasPermission("delete all video entity revisions") ||
        $account->hasPermission('administer video entity entities')));

    $rows = [];

    $vids = $poker_video_entity_storage->revisionIds($poker_video_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\poker_video_support\VideoEntityInterface $revision */
      $revision = $poker_video_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)
        ->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $poker_video_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.poker_video_entity.revision', [
            'poker_video_entity' => $poker_video_entity->id(),
            'poker_video_entity_revision' => $vid
          ]));
        }
        else {
          $link = $poker_video_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}
                <p class="revision-log">{{ message }}</p>{% endif %}',
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
              Url::fromRoute('entity.poker_video_entity.translation_revert', [
                'poker_video_entity' => $poker_video_entity->id(),
                'poker_video_entity_revision' => $vid, 'langcode' => $langcode
              ]) :
              Url::fromRoute('entity.poker_video_entity.revision_revert', [
                'poker_video_entity' => $poker_video_entity->id(),
                'poker_video_entity_revision' => $vid
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.poker_video_entity.revision_delete', [
                'poker_video_entity' => $poker_video_entity->id(),
                'poker_video_entity_revision' => $vid
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

    $build['poker_video_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
