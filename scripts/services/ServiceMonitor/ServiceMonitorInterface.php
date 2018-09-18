<?php

namespace DrupalProject\services\ServiceMonitor;

interface ServiceMonitorInterface
{
    /**
     * Check the status of a service if it is valid or not
     *
     * @return boolean
     */
    public function check();
}
