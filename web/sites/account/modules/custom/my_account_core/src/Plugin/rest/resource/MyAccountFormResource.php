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

            case 'my_account_help':
                $config = \Drupal::config('my_account_core.help');
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

            case 'my_account_profile_country_mapping':
                // Get only country mapping section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'country_mapping');
                break;

            case 'my_account_profile_country_code_mapping':
                // Get only country mapping section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'country_code_mapping');
                break;

            case 'my_account_profile_btn_config':
                // Get only btn config section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'btn_config');
                break;

            case 'my_account_profile_modal_preview':
                // Get only modal preview section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'modal_preview');
                break;

            case 'my_account_profile_server_side_mapping':
                // Get only server side validation section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'server_side_mapping');
                break;

            case 'my_account_profile_labels':
                // Get only labels section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'myprofile_labels');
                break;

            case 'my_account_profile_general_configuration':
                // Get only general config section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'myprofile_general_configuration');
                break;

            case 'my_account_profile_clientside_validation':
                // Get only general config section values.
                $config = \Drupal::config('my_account_form_profile.profile');
                $values = $this->filter_array_exposed($config->get(), 'myprofile_clientside_validation');
                break;
            case 'bonus_history':
                try {
                  $config = \Drupal::config('my_account_core.bonus_history');
                  $values = $config->get();
                } catch (\Exception $e) {
                  $values = array(
                    'error' => $this->t('Configuration not found')
                  );
                }
                break;
            case 'cant_login':
                try {
                  $config = \Drupal::config('my_account_core.cant_login');
                  $values = $config->get();
                } catch (\Exception $e) {
                  $values = array(
                    'error' => $this->t('Configuration not found')
                  );
                }
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
            $value['home_address'] = $values['home_address_field']['options']['label'];
            $value['contact_preference_label'] = $values['contact_preference_label']['options']['label'];
            $value['contact_preference_top_blurb'] = $values['contact_preference_top_blurb_field'];
            $value['contact_preference_bottom_blurb'] = $values['contact_preference_bottom_blurb_field'];
        } elseif ($key == 'profile') {
            $unsetKeys = $this->getUnsetKeys();

            foreach ($unsetKeys as $key) {
                unset($values[$key]);
            }

            $value = $values;
        } elseif ($key == 'sms_verification') {
            $value['enable_sms_verification'] = $values['enable_sms_verification'];
            $value['verify_text'] = $values['verify_text'];
            $value['modal_verify_header_text'] = $values['modal_verify_header_text'];
            $value['modal_verify_body_text'] = $values['modal_verify_body_text'];
            $value['modal_verification_code_placeholder'] = $values['modal_verification_code_placeholder'];
            $value['modal_verification_resend_code_text'] = $values['modal_verification_resend_code_text'];
            $value['modal_verification_submit_text'] = $values['modal_verification_submit_text'];
            $value['verification_code_response'] = $values['verification_code_response'];
            $value['verification_code_required_message'] = $values['verification_code_required_message'];
            $value['verification_code_min_length_message'] = $values['verification_code_min_length_message'];
            $value['verification_code_max_length_message'] = $values['verification_code_max_length_message'];
            $value['verification_code_numeric_message'] = $values['verification_code_numeric_message'];
        } elseif ($key == 'country_mapping') {
            $value['country_mapping'] = $values['country_mapping_field'];
        } elseif ($key == 'country_code_mapping') {
            $value['country_code_mapping'] = $values['country_code_mapping_field'];
        } elseif ($key == 'btn_config') {
            $value['save_changes'] = $values['save_changes_field'];
            $value['cancel'] = $values['cancel_field'];
        } elseif ($key == 'modal_preview') {
            $value['modal_preview_header'] = $values['modal_preview_header_field'];
            $value['modal_preview_top_blurb'] = $values['modal_preview_top_blurb_field'];
            $value['modal_preview_current_label'] = $values['modal_preview_current_label_field'];
            $value['modal_preview_new_label'] = $values['modal_preview_new_label_field'];
            $value['modal_preview_bottom_blurb'] = $values['modal_preview_bottom_blurb_field'];
            $value['modal_preview_placeholder'] = $values['modal_preview_placeholder_field'];
            $value['modal_preview_btn'] = $values['modal_preview_btn_field'];
        } elseif ($key == 'server_side_mapping') {
            $value['server_side_mapping'] = $values['server_side_validation_field'];
        } elseif ($key == 'myprofile_clientside_validation') {
            $value['required_validation_field'] = $values['required_validation_field'];
            $value['mobile_number_format_validation_field'] = $values['mobile_number_format_validation_field'];
            $value['mobile_number_min_length_validation_field'] = $values['mobile_number_min_length_validation_field'];
            $value['mobile_number_max_length_validation_field'] = $values['mobile_number_max_length_validation_field'];
            $value['address_format_validation_field'] = $values['address_format_validation_field'];
            $value['address_min_length_validation_field'] = $values['address_min_length_validation_field'];
            $value['address_max_length_validation_field'] = $values['address_max_length_validation_field'];
            $value['city_format_validation_field'] = $values['city_format_validation_field'];
            $value['city_min_length_validation_field'] = $values['city_min_length_validation_field'];
            $value['city_max_length_validation_field'] = $values['city_max_length_validation_field'];
            $value['postal_code_format_validation_field'] = $values['postal_code_format_validation_field'];
            $value['postal_code_max_length_value_field'] = $values['postal_code_max_length_value_field'];
            $value['postal_code_max_length_validation_field'] = $values['postal_code_max_length_validation_field'];
            $value['password_format_validation_field'] = $values['password_format_validation_field'];
            $value['password_min_length_validation_field'] = $values['password_min_length_validation_field'];
            $value['password_max_length_validation_field'] = $values['password_max_length_validation_field'];
        } elseif ($key == 'myprofile_labels') {
            $value['country_label'] = $values['country_field']['options']['label'];
            $value['gender_label'] = $values['gender_field']['options']['label'];
            $value['mobile_number_label'] = $values['mobile_number_field']['options']['label'];
            $value['language_label'] = $values['language_field']['options']['label'];
            $value['address_label'] = $values['address_field']['options']['label'];
            $value['city_label'] = $values['city_field']['options']['label'];
            $value['postal_code_label'] = $values['postal_code_field']['options']['label'];
            $value['contact_preference_label'] = $values['contact_preference_field']['options']['label'];
            $value['contact_preference_yes'] = $values['contact_preference_yes_label_field'];
            $value['contact_preference_no'] = $values['contact_preference_no_label_field'];
        } elseif ($key == 'myprofile_general_configuration') {
            $value['primary_label'] = $values['primary_label'];
            $value['add_mobile_label'] = $values['add_mobile_label'];
            $value['no_changed_detected_message'] = $values['no_changed_detected_message'];
            $value['male_label'] = $values['male_label'];
            $value['female_label'] = $values['female_label'];
            $value['message_timeout'] = $values['message_timeout'];
            $value['my_profile_tab'] = $values['my_profile_tab'];
            $value['change_password_tab'] = $values['change_password_tab'];
            $value['fast_reg_flash_message'] = $values['fast_reg_flash_message'];
            $value['fastreg_redirect'] = $values['fastreg_redirect'];
            $value['fastreg_timeout_redirect'] = $values['fastreg_timeout_redirect'];
            $value['fastreg_mobile_redirect'] = $values['fastreg_mobile_redirect'];
        }
        return $value;
    }

    private function getUnsetKeys() {
        return $unsetKeys = [
                'account_field',
                'communication_detail_field',
                'home_address_field',
                'contact_preference_label',
                'contact_preference_top_blurb_field',
                'contact_preference_bottom_blurb_field',
                'contact_preference_bottom_blurb_field',
                'enable_sms_verification_field',
                'verify_text_field',
                'modal_verify_header_text_field',
                'modal_verify_body_text_field',
                'modal_verification_code_placeholder_field',
                'modal_verification_resend_code_text_field',
                'modal_verification_submit_text_field',
                'verification_code_response_field',
                'verification_code_required_message_field',
                'verification_code_min_length_message_field',
                'verification_code_max_length_message_field',
                'country_mapping_field',
                'country_code_mapping_field',
                'save_changes_field',
                'cancel_field',
                'modal_preview_header_field',
                'modal_preview_top_blurb_field',
                'modal_preview_current_label_field',
                'modal_preview_new_label_field',
                'modal_preview_bottom_blurb_field',
                'modal_preview_placeholder_field',
                'modal_preview_btn_field',
                'modal_preview_field',
                'server_side_validation_field',
                'primary_label_field',
                'add_mobile_label_field',
                'no_changed_detected_message_field',
                'required_validation_field',
                'mobile_number_format_validation_field',
                'mobile_number_min_length_validation_field',
                'mobile_number_max_length_validation_field',
                'address_format_validation_field',
                'address_min_length_validation_field',
                'address_max_length_validation_field',
                'city_format_validation_field',
                'city_min_length_validation_field',
                'city_max_length_validation_field',
                'postal_code_format_validation_field',
                'postal_code_max_length_validation_field',
                'postal_code_max_length_value_field',
                'password_format_validation_field',
                'password_min_length_validation_field',
                'password_max_length_validation_field',
                'contact_preference_yes_label_field',
                'contact_preference_no_label_field',
                'male_label_field',
                'female_label_field',
            ];
    }
}
