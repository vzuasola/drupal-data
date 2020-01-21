(function ($, Drupal, drupalSettings) {
    'use strict';
   
    Drupal.behaviors.webcomposer_domain_import = {
      attach: function attach(context, settings) {
        setTimeout(function() {
            $("#" + drupalSettings.domain_import.form_to_process).submit();
        }, 1000);
      }
    };
  })(jQuery, Drupal, drupalSettings);