<?php

namespace DrupalProject\services\ServiceMonitor;

use Drupal\Core\Database\Database;

class DatabaseServiceMonitor implements ServiceMonitorInterface
{
    /**
     * @{inheritdoc}
     */
    public function check()
    {
        $result = true;

        try {
            Database::getConnection();
        } catch (\Exception $e) {
            $result = "Cannot establish a connection with the database";
        }

        return $result;
    }
}
