<?php

namespace Drupal\poker_vip_page\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\poker_vip_page\Entity\PokerVipEntityInterface;

/**
 * Class PokerVipEntityController.
 *
 *  Returns responses for Poker vip entity routes.
 */
class PokerVipEntityController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Poker vip entity  revision.
   *
   * @param int $poker_vip_entity_revision
   *   The Poker vip entity  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($poker_vip_entity_revision) {
    $poker_vip_entity = $this->entityManager()->getStorage('poker_vip_entity')->loadRevision($poker_vip_entity_revision);
    $view_builder = $this->entityManager()->getViewBuilder('poker_vip_entity');

    return $view_builder->view($poker_vip_entity);
  }

  /**
   * Page title callback for a Poker vip entity  revision.
   *
   * @param int $poker_vip_entity_revision
   *   The Poker vip entity  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($poker_vip_entity_revision) {
    $poker_vip_entity = $this->entityManager()->getStorage('poker_vip_entity')->loadRevision($poker_vip_entity_revision);
    return $this->t('Revision of %title from %date', [
      '%title' => $poker_vip_entity->label(),
      '%date' => format_date($poker_vip_entity->getRevisionCreationTime())
    ]);
  }

  /**
   * Generates an overview table of older revisions of a Poker vip entity .
   *
   * @param \Drupal\poker_vip_page\Entity\PokerVipEntityInterface $poker_vip_entity
   *   A Poker vip entity  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(PokerVipEntityInterface $poker_vip_entity) {
    $account = $this->currentUser();
    $langcode = $poker_vip_entity->language()->getId();
    $langname = $poker_vip_entity->language()->getName();
    $languages = $poker_vip_entity->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $poker_vip_entity_storage = $this->entityManager()->getStorage('poker_vip_entity');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', [
      '@langname' => $langname,
      '%title' => $poker_vip_entity->label()
    ]) : $this->t('Revisions for %title', ['%title' => $poker_vip_entity->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all poker vip entity revisions") ||
        $account->hasPermission('administer poker vip entity entities')));
    $delete_permission = (($account->hasPermission("delete all poker vip entity revisions") ||
        $account->hasPermission('administer poker vip entity entities')));

    $rows = [];

    $vids = $poker_vip_entity_storage->revisionIds($poker_vip_entity);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\poker_vip_page\PokerVipEntityInterface $revision */
      $revision = $poker_vip_entity_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $poker_vip_entity->getRevisionId()) {
          $link = $this->l($date, new Url('entity.poker_vip_entity.revision', [
            'poker_vip_entity' => $poker_vip_entity->id(),
            'poker_vip_entity_revision' => $vid
          ]));
        }
        else {
          $link = $poker_vip_entity->link($date);
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
              Url::fromRoute('entity.poker_vip_entity.translation_revert', [
                'poker_vip_entity' => $poker_vip_entity->id(),
                'poker_vip_entity_revision' => $vid,
                'langcode' => $langcode
              ]) :
              Url::fromRoute('entity.poker_vip_entity.revision_revert', [
                'poker_vip_entity' => $poker_vip_entity->id(),
                'poker_vip_entity_revision' => $vid
              ]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.poker_vip_entity.revision_delete', [
                'poker_vip_entity' => $poker_vip_entity->id(),
                'poker_vip_entity_revision' => $vid
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

    $build['poker_vip_entity_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
