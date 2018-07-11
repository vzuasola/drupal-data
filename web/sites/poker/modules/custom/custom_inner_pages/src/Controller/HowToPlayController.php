<?php

namespace Drupal\custom_inner_pages\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\custom_inner_pages\Entity\HowToPlayInterface;

/**
 * Class HowToPlayController.
 *
 *  Returns responses for How to play routes.
 */
class HowToPlayController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a How to play  revision.
   *
   * @param int $how_to_play_revision
   *   The How to play  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($how_to_play_revision) {
    $how_to_play = $this->entityManager()->getStorage('how_to_play')->loadRevision($how_to_play_revision);
    $view_builder = $this->entityManager()->getViewBuilder('how_to_play');

    return $view_builder->view($how_to_play);
  }

  /**
   * Page title callback for a How to play  revision.
   *
   * @param int $how_to_play_revision
   *   The How to play  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($how_to_play_revision) {
    $how_to_play = $this->entityManager()->getStorage('how_to_play')->loadRevision($how_to_play_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $how_to_play->label(),
      '%date' => format_date($how_to_play->getRevisionCreationTime())
    ]);
  }

  /**
   * Generates an overview table of older revisions of a How to play .
   *
   * @param \Drupal\custom_inner_pages\Entity\HowToPlayInterface $how_to_play
   *   A How to play  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(HowToPlayInterface $how_to_play) {
    $account = $this->currentUser();
    $langcode = $how_to_play->language()->getId();
    $langname = $how_to_play->language()->getName();
    $languages = $how_to_play->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $how_to_play_storage = $this->entityManager()->getStorage('how_to_play');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', [
      '@langname' => $langname,
      '%title' => $how_to_play->label()
    ]) : $this->t('Revisions for %title', ['%title' => $how_to_play->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all how to play revisions") ||
      $account->hasPermission('administer how to play entities')));
    $delete_permission = (($account->hasPermission("delete all how to play revisions") ||
      $account->hasPermission('administer how to play entities')));

    $rows = [];

    $vids = $how_to_play_storage->revisionIds($how_to_play);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\custom_inner_pages\HowToPlayInterface $revision */
      $revision = $how_to_play_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) &&
        $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $how_to_play->getRevisionId()) {
          $link = $this->l($date, new Url('entity.how_to_play.revision', [
            'how_to_play' => $how_to_play->id(),
            'how_to_play_revision' => $vid]));
        }
        else {
          $link = $how_to_play->link($date);
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
              Url::fromRoute('entity.how_to_play.translation_revert', [
                'how_to_play' => $how_to_play->id(),
                'how_to_play_revision' => $vid,
                'langcode' => $langcode
              ]) :
              Url::fromRoute('entity.how_to_play.revision_revert', [
                'how_to_play' => $how_to_play->id(),
                'how_to_play_revision' => $vid
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.how_to_play.revision_delete', [
                'how_to_play' => $how_to_play->id(),
                'how_to_play_revision' => $vid
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

    $build['how_to_play_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
