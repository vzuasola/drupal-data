<?php

namespace DrupalProject\services\ServiceMonitor;

use Drupal\Core\Database\Database;
use Drupal\Core\Site\Settings;
use Predis\Client;

class RedisServiceMonitor implements ServiceMonitorInterface
{
    /**
     * @{inheritdoc}
     */
    public function check()
    {
        $result = true;

        $settings = Settings::get('webcomposer_cache')['redis'];

        if ($settings) {
            $client = new Client($settings['clients'], $settings['options']);

            try {
                $client->ping();
            } catch (\Exception $e) {
                $result = "The session handler Redis client is not accessible";
            }
        }

        return $result;
    }
}
