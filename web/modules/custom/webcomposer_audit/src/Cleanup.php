<?php

namespace Drupal\webcomposer_audit;

class Cleanup
{
    public static function runCleanup($forceRun = false) : bool
    {
        $config = \Drupal::config('webcomposer_audit.cleanup_configuration')->get();
        $limit_num = $config['limit_num'] ?? 50;
        $limit_date_num = $config['limit_date_num'] ?? 6;
        $limit_date_unit = strtolower($config['limit_date_unit'] ?? 'month');
        $cleanup_enabled = ($config['cleanup_enabled'] ?? 0) === 1;
        $allowed_hours_start = $config['allowed_hours_start'] ?? 6;
        $allowed_hours_end = $config['allowed_hours_end'] ?? 9;


        $currentHour = (int) (new \DateTime('now', new \DateTimeZone('UTC')))->format('G');
        $inAllowedHours = ($currentHour >= $allowed_hours_start && $currentHour <= $allowed_hours_end);

        $shouldRun = ( $cleanup_enabled && $inAllowedHours ) || $forceRun;

        if(!$shouldRun){
            return false;
        }

        $dateStringTemplate = strtr(
            '-{limit_date_num} {limit_date_unit}',
            [
                '{limit_date_num}' => $limit_date_num,
                '{limit_date_unit}' => $limit_date_unit
            ]
        );
        $minDateLimit = strtotime('-6 month');
        $userDateLimit = strtotime($dateStringTemplate);
        $dateLimit = min($minDateLimit, $userDateLimit);

        $options = [
            "limit" => $limit_num,
            "where" => [
                "timestamp" => [
                    "value" => $dateLimit,
                    "operator" => "<",
                ],
            ],
            "orderby" => [
                "field" => "timestamp",
                "sort" => "asc",
            ],
        ];

        $ids = \Drupal::service('webcomposer_audit.database_storage')->getDistinct('id', $options);
        $deleted = \Drupal::service('webcomposer_audit.database_storage')->deleteByIds($ids);
        \Drupal::state()->set('webcomposer_audit.last_cleanup_execute', \Drupal::time()->getRequestTime());
        \Drupal::state()->set('webcomposer_audit.last_cleanup_count', $deleted);
        return true;
    }
}
