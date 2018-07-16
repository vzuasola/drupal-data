<?php

namespace Drupal\poker_download_page\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\poker_download_page\Entity\DownloadPageEntityInterface;

/**
 * Class DownloadPageEntityController.
 *
 *  Returns responses for Download page entity routes.
 */
class DownloadPageEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Download page entity  revision.
   *
   * @param int $download_page_entity_revision
   *   The Download page entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($download_page_entity_revision) {
    $download_page_entity = $this->entityManager()->getStorage('download_page_entity')->loadRevision($download_page_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('download_page_entity');

    return $view_builder->view($download_page_entity);
  }

  /**
   * Page title callback for a Download page entity  revision.
   *
   * @param int $download_page_entity_revision
   *   The Download page entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($download_page_entity_revision) {
    $download_page_entity = $this->entityManager()->getStorage('download_page_entity')->loadRevision($download_page_entity_revision);
    return $this->t('Revision of %title from %date', 
        ['%title' => $download_page_entity->label(), '%date' => format_date($download_page_entity->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Download page entity .
   *
   * @param \Drupal\poker_download_page\Entity\DownloadPageEntityInterface $download_page_entity
   *   A Download page entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(DownloadPageEntityInterface $download_page_entity) {
    $account = $this->currentUser();
    $langcode = $download_page_entity->language()->getId();
    $langname = $download_page_entity->language()->getName();
    $languages = $download_page_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $download_page_entity_storage = $this->entityManager()->getStorage('download_page_entity');

    $build['#title'] = $has_translations 
        ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $download_page_entity->label()])
        : $this->t('Revisions for %title', ['%title' => $download_page_entity->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all download page entity revisions")
        || $account->hasPermission('administer download page entity entities')));
    $delete_permission = (($account->hasPermission("delete all download page entity revisions")
        || $account->hasPermission('administer download page entity entities')));

    $rows = [];

    $vids = $download_page_entity_storage->revisionIds($download_page_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\poker_download_page\DownloadPageEntityInterface $revision */
      $revision = $download_page_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $download_page_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.download_page_entity.revision', ['download_page_entity' => $download_page_entity->id(), 'download_page_entity_revision' => $vid]));
        }
        else {
          $link = $download_page_entity->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>
            {% endif %}',
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
              Url::fromRoute('entity.download_page_entity.translation_revert', ['download_page_entity' => $download_page_entity->id(), 'download_page_entity_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.download_page_entity.revision_revert', ['download_page_entity' => $download_page_entity->id(), 'download_page_entity_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.download_page_entity.revision_delete', 
                ['download_page_entity' => $download_page_entity->id(), 'download_page_entity_revision' => $vid]),
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

    $build['download_page_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
