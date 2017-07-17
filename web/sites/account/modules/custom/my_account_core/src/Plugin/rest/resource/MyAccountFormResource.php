<?php

namespace Drupal\my_account_core\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a My Account Rest Resources
 *
 * @RestResource(
 *   id = "my_account_core_form_resource",
 *   label = @Translation("My Account Rest Resource"),
 *   uri_paths = {
 *     "canonical" = "/api/configuration/{id}"
 *   }
 * )
 */
class MyAccountFormResource extends ResourceBase
{

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get($id)
    {

        // Expired the caches for resources update.
        $build = array(
            '#cache' => array(
                'max-age' => 0,
            ),
        );

        switch ($id) {

            case 'my_account_change_password':
                $config = \Drupal::config('my_account_form_profile.change_password');
                $values = $this->filter_array_exposed($config->get(), 'password');
                break;

            case 'my_account_profile':

                // Make seperte value for Profile field
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'profile');
                break;

            case 'my_account_cashier':
                $config = \Drupal::config('my_account_core.cashier');
                $configValue = $config->get()['cashier_domain_mapping'];
                $domains = explode(PHP_EOL, trim($configValue));
                $values = [];

                // Explode domains
                foreach ($domains as $domain) {
                    list ($key, $value) = explode('|', $domain);
                    $values[$key] = trim($value);
                }
                break;

            case 'my_account_livechat':
                $config = \Drupal::config('my_account_core.livechat');
                $values = $config->get();
                break;

            case 'my_account_access_denied':
                $config = \Drupal::config('my_account_error_handler.403');
                $values = $config->get();
                break;

            case 'my_account_page_not_found':
                $config = \Drupal::config('my_account_error_handler.404');
                $values = $config->get();
                break;

            case 'my_account_profile_header':
                // Get only hader section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'header');
                break;

            case 'my_account_sms_verification':
                // Get only sms verification section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'sms_verification');
                break;

            case 'my_account_header':
                // Get only hader section values.
                $config = \Drupal::config('my_account_core.header');
                $values = $config->get();
                break;
            default:
        }

        return (new ResourceResponse($values))->addCacheableDependency($build);
    }


    /**
     * @return array with header key
     */
    public function filter_array_exposed($values, $key)
    {
        if ($key == 'password') {

            // Convert string with array key messages
            $value_array = explode('|', $values['integration_error_messages']['key_messages']);
            $string = $values['integration_error_messages']['key_messages'];

            // Explode strings
            $list = explode("\n", $string);
            $list = array_map('trim', $list);
            $list = array_filter($list, 'strlen');

            $generated_keys = $explicit_keys = FALSE;
            $field_type = "list_integer";
            foreach ($list as $position => $text) {
                $value = $key = FALSE;
                // Check for an explicit key.
                $matches = array();
                if (preg_match('/(.*)\|(.*)/', $text, $matches)) {
                    $key = $matches[1];
                    $value = $matches[2];
                    $explicit_keys = TRUE;
                } // Otherwise see if we can generate a key from the position.
                elseif ($generate_keys) {
                    $key = (string)$position;
                    $value = $text;
                    $generated_keys = TRUE;
                } else {
                    return;
                }
                // Key value save in array.
                $icore[$key] = $value;
            }

            $values['integration_error_messages']['key_messages'] = $icore;
            // Assign with existing array
            $value = $values;
        }
        if ($key == 'header') {

            // Get only header values for profile.
            $value['account_detail'] = $values['account_field']['options']['label'];
            $value['communication'] = $values['communication_detail_field']['options']['label'];
        } elseif ($key == 'profile') {

            // Get only Profile field.
            unset($values['account_field']);
            unset($values['communication_detail_field']);
            unset($values['enable_sms_verification_field']);
            unset($values['verify_text_field']);
            unset($values['modal_verify_header_text_field']);
            unset($values['modal_verify_body_text_field']);
            unset($values['modal_verification_code_placeholder_field']);
            unset($values['modal_verification_resend_code_text_field']);
            unset($values['modal_verification_submit_text_field']);
            unset($values['verification_code_response_field']);
            unset($values['verification_code_required_message_field']);
            unset($values['verification_code_min_length_message_field']);
            unset($values['verification_code_max_length_message_field']);

            $value = $values;
        } elseif ($key == 'sms_verification') {
            $value['enable_sms_verification'] = $values['enable_sms_verification_field'];
            $value['verify_text'] = $values['verify_text_field'];
            $value['modal_verify_header_text'] = $values['modal_verify_header_text_field'];
            $value['modal_verify_body_text'] = $values['modal_verify_body_text_field'];
            $value['modal_verification_code_placeholder'] = $values['modal_verification_code_placeholder_field'];
            $value['modal_verification_resend_code_text'] = $values['modal_verification_resend_code_text_field'];
            $value['modal_verification_submit_text'] = $values['modal_verification_submit_text_field'];
            $value['verification_code_response'] = $values['verification_code_response_field'];
            $value['verification_code_required_message'] = $values['verification_code_required_message_field'];
            $value['verification_code_min_length_message'] = $values['verification_code_min_length_message_field'];
            $value['verification_code_max_length_message'] = $values['verification_code_max_length_message_field'];
        }
        return $value;
    }


}
