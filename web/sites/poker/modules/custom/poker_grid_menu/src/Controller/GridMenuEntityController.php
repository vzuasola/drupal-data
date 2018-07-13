<?php

namespace Drupal\poker_grid_menu\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\poker_grid_menu\Entity\GridMenuEntityInterface;

/**
 * Class GridMenuEntityController.
 *
 *  Returns responses for Grid menu entity routes.
 */
class GridMenuEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Grid menu entity  revision.
   *
   * @param int $grid_menu_entity_revision
   *   The Grid menu entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($grid_menu_entity_revision) {
    $grid_menu_entity = $this->entityManager()->getStorage('grid_menu_entity')->loadRevision($grid_menu_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('grid_menu_entity');

    return $view_builder->view($grid_menu_entity);
  }

  /**
   * Page title callback for a Grid menu entity  revision.
   *
   * @param int $grid_menu_entity_revision
   *   The Grid menu entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($grid_menu_entity_revision) {
    $grid_menu_entity = $this->entityManager()->getStorage('grid_menu_entity')->loadRevision($grid_menu_entity_revision);
    return $this->t('Revision of %title from %date', ['%title' => $grid_menu_entity->label(), '%date' =>
     format_date($grid_menu_entity->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Grid menu entity .
   *
   * @param \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface $grid_menu_entity
   *   A Grid menu entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(GridMenuEntityInterface $grid_menu_entity) {
    $account = $this->currentUser();
    $langcode = $grid_menu_entity->language()->getId();
    $langname = $grid_menu_entity->language()->getName();
    $languages = $grid_menu_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $grid_menu_entity_storage = $this->entityManager()->getStorage('grid_menu_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' =>
     $grid_menu_entity->label()]) : $this->t('Revisions for %title', ['%title' => $grid_menu_entity->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all grid menu entity revisions") || 
      $account->hasPermission('administer grid menu entity entities')));
    $delete_permission = (($account->hasPermission("delete all grid menu entity revisions") || 
      $account->hasPermission('administer grid menu entity entities')));

    $rows = [];

    $vids = $grid_menu_entity_storage->revisionIds($grid_menu_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\poker_grid_menu\GridMenuEntityInterface $revision */
      $revision = $grid_menu_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $grid_menu_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.grid_menu_entity.revision', ['grid_menu_entity' => 
            $grid_menu_entity->id(), 'grid_menu_entity_revision' => $vid]));
        }
        else {
          $link = $grid_menu_entity->link($date);
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
              Url::fromRoute('entity.grid_menu_entity.translation_revert', ['grid_menu_entity' => $grid_menu_entity->id(), 'grid_menu_entity_revision' =>
               $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.grid_menu_entity.revision_revert', ['grid_menu_entity' =>
               $grid_menu_entity->id(), 'grid_menu_entity_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.grid_menu_entity.revision_delete', ['grid_menu_entity' => 
                $grid_menu_entity->id(), 'grid_menu_entity_revision' => $vid]),
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

    $build['grid_menu_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
