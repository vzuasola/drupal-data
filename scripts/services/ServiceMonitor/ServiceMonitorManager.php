<?php

namespace DrupalProject\services\ServiceMonitor;

class ServiceMonitorManager
{
    private $services = [];

    /**
     *
     */
    public function setService($id, ServiceMonitorInterface $service)
    {
        $this->services[$id] = $service;
    }

    /**
     *
     */
    public function getStatuses()
    {
        $statuses = [];

        foreach ($this->services as $key => $service) {
            $statuses[$key] = $service->check();
        }

        return $statuses;
    }
}
