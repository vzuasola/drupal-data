<?php
/**
 * @file
 * Contains \Drupal\webcomposer_domain_import\Form\ImportForm.
 */

namespace Drupal\webcomposer_domain_import\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\file\Entity\File;
use Drupal\Core\Render\Element;
use Drupal\file\Entity;
use Drupal\node\Entity\ENTITY_NAME;
use Symfony\Component\DependencyInjection\SimpleXMLElement;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\Core\Entity\EntityInterface;
use Drupal\taxonomy\Entity\Term;
use Drupal\paragraphs\Entity\Paragraph;
/**
 * Contribute form.
 */
class ImportForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
	  return 'import_taxonomy_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['import_file'] = array(
        '#type' => 'managed_file',
        '#title' => $this->t('Import file'),
        '#required' => TRUE,
        '#upload_validators'  => array(
            'file_validate_extensions' => array('csv xml xlsx'),
            'file_validate_size' => array(25600000),
        ),
        '#upload_location' => 'public://taxonomy_files/',
        '#description' => t('Upload a file to Import taxonomy! Supported format xlsx'),
    );    
    $form['actions']['#type'] = 'actions';    
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Import'),
      '#button_type' => 'primary',
      '#submit' => array('Drupal\webcomposer_domain_import\Controller\WebcomposerDomainImport::DomainImport'),     
   ); 
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
	// Display result.
    foreach ($form_state->getValues() as $key => $value) {	
		if($key == 'field_vocabulary_name')
		{
			$voc_name = $value;
		}     
    }
    create_taxonomy($voc_name);
  }
}


