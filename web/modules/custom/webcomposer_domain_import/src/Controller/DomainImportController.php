<?php
namespace Drupal\webcomposer_domain_import\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;

class DomainImportController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    if (!isset ($_SESSION['webcomposer_domain_import']['export_time'])) {
      $_SESSION['webcomposer_domain_import']['export_time'] = time();
    }
    $processed_forms = $_SESSION['webcomposer_domain_import']['processed_forms'] ?? [];
    $config = $this->config('webcomposer_config.toggle_configuration');
    $domain_import = \Drupal::service('webcomposer_domain_import.domain_import');
    // get how many domains per batch
    $domain_batch = $config->get('domains_batch');
    $domain_batch = (int)$domain_batch + 1;
    $fid = \Drupal::request()->query->get('import_file')[0];
    $ctr = 1;

    if ($fid && File::load($fid)) {
     // form for masterplaceholders
      $build["domain-import-form-$ctr"] = \Drupal::formBuilder()->getForm(
        '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
          'submit_callback' => array('::submitPlaceholder'),
          'title' => 'Import MASTER PLACEHOLDERS',
          'action' => 'Import MASTER PLACEHOLDERS',
          'fid' => $fid,
          'id' => "domain-import-form-$ctr",
        ]
      );
      $domains = $domain_import->getExcelDomains($fid);
      $languages = $domain_import->getExcelLanguages($fid);
      foreach ($domains as $group => $domain) {
        $ctr++;
        // form for domain groups
        $build["domain-import-form-$ctr"] = \Drupal::formBuilder()->getForm(
          '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
            'submit_callback' => array('::submitDomainGroup'),
            'title' => "Import DOMAIN GROUP - $group",
            'action' => $group,
            'fid' => $fid,
            'group' => $group,
            'id' => "domain-import-form-$ctr",
          ]
        );
        $domain_avg = ceil(count($domain)/$domain_batch);
        for ($i = 0; $i < $domain_avg; $i++) {
          $ctr++;
          // form for domains
          $domain_slice = array_slice($domain, ($i * $domain_batch), $domain_batch);
          $domain_slice_grouped = implode(", ", $domain_slice);
          $build["domain-import-form-$ctr"] = \Drupal::formBuilder()->getForm(
              '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
                'submit_callback' => array('::submitDomainBatch'),
                'title' => "Import DOMAINS of $group Group",
                'action' => $domain_slice_grouped,
                'fid' => $fid,
                'group' => $group,
                'id' => "domain-import-form-$ctr",
                'domain_slice' => $domain_slice,
              ]
          );
          $ctr++;
          $build["domain-import-form-$ctr"] = \Drupal::formBuilder()->getForm(
            '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
              'submit_callback' => array('::submitTranslatePlaceholder'),
              'title' => "Import DOMAINS Placeholder of $domain_slice_grouped",
              'action' => $domain_slice_grouped,
              'fid' => $fid,
              'group' => $group,
              'id' => "domain-import-form-$ctr",
              'domain_slice' => $domain_slice,
            ]
          );
        }
      }
      $ctr++;
      $build["domain-import-form-$ctr"] = \Drupal::formBuilder()->getForm(
        '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
          'submit_callback' => array('::submitDomainRemoveBackup'),
          'title' => "Remove Import Backup",
          'action' => "Remove domains imported before ".
            \Drupal::service('date.formatter')->format(
              $_SESSION['webcomposer_domain_import']['export_time'],
              'custom',
              'F j, Y h:ia'
            ),
          'fid' => $fid,
          'id' => "domain-import-form-$ctr",
        ]
      );

      // filter out processed forms
      $forms = [];
      for ($i = 1; $i <= $ctr; $i++) {
        if (in_array("domain-import-form-$i", $processed_forms)) {
          unset($build["domain-import-form-$i"]);
        } else {
          $forms[] = "domain-import-form-$i";
        }
      }

      $build['#attached']['library'][] = 'webcomposer_domain_import/domain-batch-process';
      $build['#attached']['drupalSettings']['domain_import']['form_to_process'] =  $forms[0] ?? '';
      return $build;
    } else {
      drupal_set_message('Import file is required', 'error');
      $response = new RedirectResponse(\Drupal::url('webcomposer_domain_import.webcomposer_domain_import'), 302);
      $response->send();
      return;
    }
  }

}