<?php

namespace Drupal\entrypage_front_blocks\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface;

/**
 * Class EntrypageFrontBlockController.
 *
 *  Returns responses for Entrypage front block routes.
 *
 * @package Drupal\entrypage_front_blocks\Controller
 */
class EntrypageFrontBlockController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Entrypage front block  revision.
   *
   * @param int $entrypage_front_block_revision
   *   The Entrypage front block  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($entrypage_front_block_revision) {
    $entrypage_front_block = $this->entityManager()->getStorage('entrypage_front_block')->loadRevision($entrypage_front_block_revision);
    $view_builder = $this->entityManager()->getViewBuilder('entrypage_front_block');

    return $view_builder->view($entrypage_front_block);
  }

  /**
   * Page title callback for a Entrypage front block  revision.
   *
   * @param int $entrypage_front_block_revision
   *   The Entrypage front block  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($entrypage_front_block_revision) {
    $entrypage_front_block = $this->entityManager()->getStorage('entrypage_front_block')->loadRevision($entrypage_front_block_revision);
    return $this->t('Revision of %title from %date', array('%title' => $entrypage_front_block->label(), '%date' => format_date($entrypage_front_block->getRevisionCreationTime())));
  }

  /**
   * Generates an overview table of older revisions of a Entrypage front block .
   *
   * @param \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface $entrypage_front_block
   *   A Entrypage front block  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(EntrypageFrontBlockInterface $entrypage_front_block) {
    $account = $this->currentUser();
    $langcode = $entrypage_front_block->language()->getId();
    $langname = $entrypage_front_block->language()->getName();
    $languages = $entrypage_front_block->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $entrypage_front_block_storage = $this->entityManager()->getStorage('entrypage_front_block');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $entrypage_front_block->label()]) : $this->t('Revisions for %title', ['%title' => $entrypage_front_block->label()]);
    $header = array($this->t('Revision'), $this->t('Operations'));

    $revert_permission = (($account->hasPermission("revert all entrypage front block revisions") || $account->hasPermission('administer entrypage front block entities')));
    $delete_permission = (($account->hasPermission("delete all entrypage front block revisions") || $account->hasPermission('administer entrypage front block entities')));

    $rows = array();

    $vids = $entrypage_front_block_storage->revisionIds($entrypage_front_block);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\entrypage_front_blocks\EntrypageFrontBlockInterface $revision */
      $revision = $entrypage_front_block_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->revision_timestamp->value, 'short');
        if ($vid != $entrypage_front_block->getRevisionId()) {
          $link = $this->l($date, new Url('entity.entrypage_front_block.revision', ['entrypage_front_block' => $entrypage_front_block->id(), 'entrypage_front_block_revision' => $vid]));
        }
        else {
          $link = $entrypage_front_block->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
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
              Url::fromRoute('entity.entrypage_front_block.translation_revert', ['entrypage_front_block' => $entrypage_front_block->id(), 'entrypage_front_block_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.entrypage_front_block.revision_revert', ['entrypage_front_block' => $entrypage_front_block->id(), 'entrypage_front_block_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.entrypage_front_block.revision_delete', ['entrypage_front_block' => $entrypage_front_block->id(), 'entrypage_front_block_revision' => $vid]),
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

    $build['entrypage_front_block_revisions_table'] = array(
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    );

    return $build;
  }

}
