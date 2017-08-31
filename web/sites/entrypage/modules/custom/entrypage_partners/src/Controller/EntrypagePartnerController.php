<?php

namespace Drupal\entrypage_partners\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\entrypage_partners\Entity\EntrypagePartnerInterface;

/**
 * Class EntrypagePartnerController.
 *
 *  Returns responses for Entrypage partner routes.
 *
 * @package Drupal\entrypage_partners\Controller
 */
class EntrypagePartnerController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Entrypage partner  revision.
   *
   * @param int $entrypage_partner_revision
   *   The Entrypage partner  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($entrypage_partner_revision) {
    $entrypage_partner = $this->entityManager()->getStorage('entrypage_partner')->loadRevision($entrypage_partner_revision);
    $view_builder = $this->entityManager()->getViewBuilder('entrypage_partner');

    return $view_builder->view($entrypage_partner);
  }

  /**
   * Page title callback for a Entrypage partner  revision.
   *
   * @param int $entrypage_partner_revision
   *   The Entrypage partner  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($entrypage_partner_revision) {
    $entrypage_partner = $this->entityManager()->getStorage('entrypage_partner')->loadRevision($entrypage_partner_revision);
    return $this->t('Revision of %title from %date', array('%title' => $entrypage_partner->label(), '%date' => format_date($entrypage_partner->getRevisionCreationTime())));
  }

  /**
   * Generates an overview table of older revisions of a Entrypage partner .
   *
   * @param \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface $entrypage_partner
   *   A Entrypage partner  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(EntrypagePartnerInterface $entrypage_partner) {
    $account = $this->currentUser();
    $langcode = $entrypage_partner->language()->getId();
    $langname = $entrypage_partner->language()->getName();
    $languages = $entrypage_partner->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $entrypage_partner_storage = $this->entityManager()->getStorage('entrypage_partner');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $entrypage_partner->label()]) : $this->t('Revisions for %title', ['%title' => $entrypage_partner->label()]);
    $header = array($this->t('Revision'), $this->t('Operations'));

    $revert_permission = (($account->hasPermission("revert all entrypage partner revisions") || $account->hasPermission('administer entrypage partner entities')));
    $delete_permission = (($account->hasPermission("delete all entrypage partner revisions") || $account->hasPermission('administer entrypage partner entities')));

    $rows = array();

    $vids = $entrypage_partner_storage->revisionIds($entrypage_partner);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\entrypage_partners\EntrypagePartnerInterface $revision */
      $revision = $entrypage_partner_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->revision_timestamp->value, 'short');
        if ($vid != $entrypage_partner->getRevisionId()) {
          $link = $this->l($date, new Url('entity.entrypage_partner.revision', ['entrypage_partner' => $entrypage_partner->id(), 'entrypage_partner_revision' => $vid]));
        }
        else {
          $link = $entrypage_partner->link($date);
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
              Url::fromRoute('entity.entrypage_partner.translation_revert', ['entrypage_partner' => $entrypage_partner->id(), 'entrypage_partner_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.entrypage_partner.revision_revert', ['entrypage_partner' => $entrypage_partner->id(), 'entrypage_partner_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.entrypage_partner.revision_delete', ['entrypage_partner' => $entrypage_partner->id(), 'entrypage_partner_revision' => $vid]),
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

    $build['entrypage_partner_revisions_table'] = array(
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    );

    return $build;
  }

}
