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
 *     "title" = "Announcement Configuration",
 *     "path" = "/admin/config/jamboree/announcement_configuration",
 *   },
 *   menu = {
 *     "title" = "Announcement Configuration",
 *     "description" = "Provides announcement configuration",
 *     "parent" = "jamboree_config.jamboree_announcement",
 *     "weight" = 30
 *   },
 * )
 */
class JamboreeAnnouncementForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['jamboree_config.announcement_configuration'];
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
    $form['critical_issue'] = [
      '#type' => 'details',
      '#title' => $this->t('Critical Announcement'),
    ];

    $form['critical_issue']['critical_announcement'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable Critical Issue announcements',
      '#description' => $this->t('Show/hide Critical Issue announcement. Default value is "Enabled".'),
      '#default_value' => $this->get('critical_announcement'),
      '#translatable' => true,
    ];

    $form['critical_issue']['critical_announcement_add_background'] = [
      '#type' => 'checkbox',
      '#title' => 'Add Background',
      '#default_value' => $this->get('critical_announcement_add_background'),
      '#states' => [
        'invisible' => [
          'input[name="critical_announcement"]' => ['checked' => false],
        ],
      ],
      '#translatable' => true,
    ];

    $default_critical_announcement = $this->get('critical_announcement_content');
    $form['critical_issue']['critical_announcement_content'] = [
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

    $form['critical_issue']['critical_announcement_scheduler'] = [
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

    $form['critical_issue']['critical_issue_scheduler'] = [
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
    $form['critical_issue']['critical_issue_scheduler']['critical_issue_start_date'] = [
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
    $form['critical_issue']['critical_issue_scheduler']['critical_issue_end_date'] = [
      '#type' => 'datetime',
      '#title' => t('End Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $criticalEndDate,
      '#translatable' => true,
    ];

    $form['news_issue'] = [
      '#type' => 'details',
      '#title' => $this->t('News Announcement'),
    ];

    $form['news_issue']['news_announcement'] = [
      '#type' => 'checkbox',
      '#title' => 'Enable news announcements',
      '#description' => $this->t('Show/hide news announcement. Default value is "Enabled".'),
      '#default_value' => $this->get('news_announcement'),
      '#translatable' => true,
    ];

    $form['news_issue']['news_announcement_add_background'] = [
      '#type' => 'checkbox',
      '#title' => 'Add Background',
      '#default_value' => $this->get('news_announcement_add_background'),
      '#states' => [
        'invisible' => [
          'input[name="news_announcement"]' => ['checked' => false],
        ],
      ],
      '#translatable' => true,
    ];

    $default_news_announcement = $this->get('news_announcement_content');
    $form['news_issue']['news_announcement_content'] = [
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

    $form['news_issue']['news_announcement_scheduler'] = [
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

    $form['news_issue']['news_issue_scheduler'] = [
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
    $form['news_issue']['news_issue_scheduler']['news_announcement_start_date'] = [
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
    $form['news_issue']['news_issue_scheduler']['news_announcement_end_date'] = [
      '#type' => 'datetime',
      '#title' => t('End Date'),
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i',
      '#default_value' => $announcementEndDate,
      '#translatable' => true,
    ];

    $form['announcement_pages'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Show announcement on specific pages'),
      '#rows' => 4,
      '#resizable' => $this->t('vertical'),
      '#translatable' => true,
      '#default_value' => $this->get('announcement_pages'),
      '#description' => $this->t('Specify pages by using their paths. Enter one path per line. The \'*\' character is a wildcard. An example path is /promotion/* for every user page.'),
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
      'critical_announcement_add_background',
      'news_announcement',
      'news_announcement_content',
      'news_announcement_scheduler',
      'news_announcement_start_date',
      'news_announcement_end_date',
      'news_announcement_add_background',
      'announcement_pages',
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
