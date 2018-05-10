<?php

namespace Drupal\jamboree_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "jamboree_config",
 *   route = {
 *     "title" = "Jamboree Configuration",
 *     "path" = "/admin/config/jamboree/jamboree_config",
 *   },
 *   menu = {
 *     "title" = "Jamboree Configuration",
 *     "description" = "Provides jamboree configuration",
 *     "parent" = "jamboree_config.jamboree_config_list",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.jamboree_configuration'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['jamboree_settings_tab'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Jamboree Configurations'),
    ];

    $this->sectionAnnouncement($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function sectionAnnouncement(array &$form) {
    $form['announcement_group'] = [
      '#type' => 'details',
      '#title' => $this->t('Announcement Bar'),
      '#collapsible' => true,
      '#group' => 'jamboree_settings_tab',
    ];

    $form['announcement_group']['critical_issue'] = [
      '#type' => 'details',
      '#title' => $this->t('Critical Announcement'),
    ];

    $form['announcement_group']['critical_issue']['critical_announcement'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Critical Issue announcements',
      '#description' => $this->t('Show/hide Critical Issue announcement. Default value is "Enabled".'),
      '#default_value' => $this->get('critical_announcement'),
      '#translatable' => true,
    ];

    $default_critical_announcement = $this->get('critical_announcement_content');
    $form['announcement_group']['critical_issue']['critical_announcement_content'] = [
      '#type' => 'text_format',
      '#title' => t('Announcement Content'),
      '#default_value' => $default_critical_announcement['value'],
      '#description' => $this->t('NOTE: Announcement content must not be empty and announcement must be enabled to show announcement.'),
      '#format' => $default_critical_announcement['format'],
      '#states' => [
        'invisible' => [
          'input[name="critical_announcement"]' => ['checked' => false],
        ],
      ],
      '#translatable' => true,
    ];

    $form['announcement_group']['critical_issue']['critical_announcement_scheduler'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Critical Issue Scheduler',
      '#default_value' => $this->get('critical_announcement_scheduler'),
      '#translatable' => true,
      '#states' => [
        'invisible' => [
          'input[name="critical_announcement"]' => ['checked' => false],
        ],
      ],
    ];

    $form['announcement_group']['critical_issue']['critical_issue_scheduler'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Critical Issue Scheduler'),
      '#states' => [
        'invisible' => [
          'input[name="critical_announcement_scheduler"]' => ['checked' => false],
        ],
      ],
    ];

    $criticalStartDate = $this->get('critical_issue_start_date');
    if ($criticalStartDate) {
        $criticalStartDate = DrupalDateTime::createFromTimestamp(date($criticalStartDate));
    }
    $form['announcement_group']['critical_issue']['critical_issue_scheduler']['critical_issue_start_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Start Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $criticalStartDate,
      '#translatable' => true,
    ];

    $criticalEndDate = $this->get('critical_issue_end_date');
    if ($criticalEndDate) {
        $criticalEndDate = DrupalDateTime::createFromTimestamp(date($criticalEndDate));
    }
    $form['announcement_group']['critical_issue']['critical_issue_scheduler']['critical_issue_end_date'] = [
      '#type' => 'datetime',
      '#title' => t('End Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $criticalEndDate,
      '#translatable' => true,
    ];

    $form['announcement_group']['news_issue'] = [
      '#type' => 'details',
      '#title' => $this->t('News Announcement'),
    ];

    $form['announcement_group']['news_issue']['news_announcement'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable news announcements',
      '#description' => $this->t('Show/hide news announcement. Default value is "Enabled".'),
      '#default_value' => $this->get('news_announcement'),
      '#translatable' => true,
    ];

    $default_news_announcement = $this->get('news_announcement_content');
    $form['announcement_group']['news_issue']['news_announcement_content'] = [
      '#type' => 'text_format',
      '#title' => t('News Content'),
      '#description' => $this->t('NOTE: Announcement content must not be empty and announcement must be enabled to show announcement.'),
      '#default_value' => $default_news_announcement['value'],
      '#format' => $default_news_announcement['format'],
      '#states' => [
        'invisible' => [
          'input[name="news_announcement"]' => ['checked' => false],
        ],
      ],
      '#translatable' => true,
    ];

    $form['announcement_group']['news_issue']['news_announcement_scheduler'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Announcement Scheduler',
      '#default_value' => $this->get('critical_announcement_scheduler'),
      '#translatable' => true,
      '#states' => [
        'invisible' => [
          'input[name="news_announcement"]' => ['checked' => false],
        ],
      ],
    ];

    $form['announcement_group']['news_issue']['news_issue_scheduler'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('News Scheduler'),
      '#states' => [
        'invisible' => [
          'input[name="news_announcement_scheduler"]' => ['checked' => false],
        ],
      ],
    ];

    $announcementStartDate = $this->get('news_announcement_start_date');
    if ($announcementStartDate) {
        $announcementStartDate = DrupalDateTime::createFromTimestamp(date($announcementStartDate));
    }
    $form['announcement_group']['news_issue']['news_issue_scheduler']['news_announcement_start_date'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Start Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $announcementStartDate,
      '#translatable' => true,
    ];

    $announcementEndDate = $this->get('news_announcement_end_date');
    if ($announcementEndDate) {
        $announcementEndDate = DrupalDateTime::createFromTimestamp(date($announcementEndDate));
    }
    $form['announcement_group']['news_issue']['news_issue_scheduler']['news_announcement_end_date'] = [
      '#type' => 'datetime',
      '#title' => t('End Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $announcementEndDate,
      '#translatable' => true,
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'critical_announcement',
      'critical_announcement_content',
      'critical_announcement_scheduler',
      'critical_issue_start_date',
      'critical_issue_end_date',
      'news_announcement',
      'news_announcement_content',
      'news_announcement_scheduler',
      'news_announcement_start_date',
      'news_announcement_end_date',
    ];

    foreach ($keys as $key) {
        switch ($key) {
            case 'critical_issue_start_date':
            case 'critical_issue_end_date':
            case 'news_announcement_start_date':
            case 'news_announcement_end_date':
                $data[$key] = strtotime($form_state->getvalue($key));
                break;
            default:
                $data[$key] = $form_state->getValue($key);
                break;
        }
    }

    $this->save($data);
  }
}
