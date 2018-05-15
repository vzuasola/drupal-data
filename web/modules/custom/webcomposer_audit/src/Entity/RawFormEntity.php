<?php

namespace Drupal\webcomposer_audit\Entity;

use Drupal\Core\Entity\Entity;
use Drupal\Core\TypedData\MapDataDefinition;
use Drupal\Core\TypedData\Plugin\DataType\Any;

/**
 *
 */
class RawFormEntity extends Entity
{
    private $id;
    private $name;
    private $before;

    /**
     *
     */
    public function __construct($name, array $values)
    {
        $this->id = $name;
        $this->name = $name;

        $parsedValues = $this->parseArrayDataToYmlStr($values);
        parent::__construct($this->createData($parsedValues), 'config');
    }

    /**
     *
     */
    public function __sleep()
    {
        $vars = get_object_vars($this);
        return array_keys($vars);
    }

    /**
     *
     */
    public function __wakeup()
    {
    }

    /**
     *
     */
    private function createData($values)
    {
        $data = [];

        foreach ($values as $key => $value) {
            $type = MapDataDefinition::create();
            $item = Any::createInstance($type, $key);
            $item->setValue($value);

            $data[$key] = $item;
        }

        return $data;
    }

    /**
     *
     */
    public function label()
    {
        return $this->name;
    }

    /**
     *
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     */
    public function getOriginal()
    {
        return $this->before;
    }

    /**
     *
     */
    public function setOriginal($before)
    {
        $this->before = $before;
    }

    /**
     *
     */
    private function parseArrayDataToYmlStr($data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $string = "";
                foreach ($value as $keyValidation => $validationValue) {
                    if (is_array($validationValue)) {
                        $string .= "- " . $keyValidation . ":\n";
                        foreach ($validationValue as $validationParamKey => $validationParamValue) {
                            $string .= "  - " . $validationParamKey . ": " . $validationParamValue . "\n";
                        }
                    } else {
                        $string .= "- " . $keyValidation . ": " . $validationValue . "\n";
                    }

                }
                $data[$key] = $string;
            }
        }

        return $data;
    }
}
