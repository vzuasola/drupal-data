<?php

namespace Drupal\mobilehub\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\mobilehub\Entity\MobileTilesInterface;

/**
 * Class MobileTilesController.
 *
 *  Returns responses for Mobile tiles routes.
 */
class MobileTilesController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Mobile tiles  revision.
   *
   * @param int $mobile_tiles_revision
   *   The Mobile tiles  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($mobile_tiles_revision) {
    $mobile_tiles = $this->entityManager()->getStorage('mobile_tiles')->loadRevision($mobile_tiles_revision);
    $view_builder = $this->entityManager()->getViewBuilder('mobile_tiles');

    return $view_builder->view($mobile_tiles);
  }

  /**
   * Page title callback for a Mobile tiles  revision.
   *
   * @param int $mobile_tiles_revision
   *   The Mobile tiles  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($mobile_tiles_revision) {
    $mobile_tiles = $this->entityManager()->getStorage('mobile_tiles')->loadRevision($mobile_tiles_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $mobile_tiles->label(),
      '%date' => format_date($mobile_tiles->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Mobile tiles .
   *
   * @param \Drupal\mobilehub\Entity\MobileTilesInterface $mobile_tiles
   *   A Mobile tiles  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(MobileTilesInterface $mobile_tiles) {
    $account = $this->currentUser();
    $langcode = $mobile_tiles->language()->getId();
    $langname = $mobile_tiles->language()->getName();
    $languages = $mobile_tiles->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $mobile_tiles_storage = $this->entityManager()->getStorage('mobile_tiles');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', [
      '@langname' => $langname,
      '%title' => $mobile_tiles->label()
    ]) : $this->t('Revisions for %title', ['%title' => $mobile_tiles->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all mobile tiles revisions") ||
      $account->hasPermission('administer mobile tiles entities')));
    $delete_permission = (($account->hasPermission("delete all mobile tiles revisions") ||
      $account->hasPermission('administer mobile tiles entities')));

    $rows = [];

    $vids = $mobile_tiles_storage->revisionIds($mobile_tiles);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\mobilehub\MobileTilesInterface $revision */
      $revision = $mobile_tiles_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $mobile_tiles->getRevisionId()) {
          $link = $this->l($date, new Url('entity.mobile_tiles.revision', [
            'mobile_tiles' => $mobile_tiles->id(),
            'mobile_tiles_revision' => $vid]));
        }
        else {
          $link = $mobile_tiles->link($date);
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
              Url::fromRoute('entity.mobile_tiles.translation_revert', [
                'mobile_tiles' => $mobile_tiles->id(),
                'mobile_tiles_revision' => $vid,
                'langcode' => $langcode]) :
              Url::fromRoute('entity.mobile_tiles.revision_revert', [
                'mobile_tiles' => $mobile_tiles->id(),
                'mobile_tiles_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.mobile_tiles.revision_delete', [
                'mobile_tiles' => $mobile_tiles->id(),
                'mobile_tiles_revision' => $vid]),
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

    $build['mobile_tiles_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
