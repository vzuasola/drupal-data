<?php
namespace Drupal\webcomposer_domain_import\Controller;

use Drupal\Core\Controller\ControllerBase;

class DomainImportController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    $build = [
      '#markup' => 'Domain Import'
    ];
    $config = $this->config('webcomposer_config.toggle_configuration');
    $domain_import = \Drupal::service('webcomposer_domain_import.domain_import');
    // get how many domains per batch
    $domain_batch = $config->get('domains_batch');
    $domain_batch = (int)$domain_batch + 1;
    $fid = \Drupal::request()->query->get('import_file')[0];

    // form for masterplaceholders
    $build['form_masterplaceholder'] = \Drupal::formBuilder()->getForm(
      '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
        'submit_callback' => array('::submitPlaceholder'),
        'action' => 'Import MASTER PLACEHOLDERS',
        'fid' => $fid,
        'id' => 'domain-import-form-placeholder',
      ]
    );
    $domains = $domain_import->getExcelDomains($fid);
    foreach ($domains as $group => $domain) {
      // form for domain groups
      $build["form_domain_group_$group"] = \Drupal::formBuilder()->getForm(
        '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
          'submit_callback' => array('::submitDomainGroup'),
          'action' => "Import DOMAIN GROUP: $group",
          'fid' => $fid,
          'group' => $group,
          'id' => 'domain-import-form-group',
        ]
      );
      $domain_avg = ceil(count($domain)/$domain_batch);
      for ($i = 0; $i < $domain_avg; $i++) {
        // form for domains
        $domain_slice = array_slice($domain, ($i * $domain_batch), $domain_batch);
        $id = "domain-import-form_". strtolower($group). $i;
        $build[$id] = \Drupal::formBuilder()->getForm(
            '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
              'submit_callback' => array('::submitDomainBatch'),
              'action' => "Import DOMAINS: ". implode(", ", $domain_slice),
              'fid' => $fid,
              'group' => $group,
              'id' => $id,
              'domain_slice' => $domain_slice,
            ]
        );
      }
    }

    $build['form_removebackup'] = \Drupal::formBuilder()->getForm(
      '\Drupal\webcomposer_domain_import\Form\BatchImportForm', [
        'submit_callback' => array('::submitDomainRemoveBackup'),
        'action' => 'Remove previous import',
        'fid' => $fid,
        'id' => 'domain-import-form_remove-backup',
      ]
    );
    return $build;
  }

}