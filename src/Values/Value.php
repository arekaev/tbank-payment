<?php

namespace Arekaev\TbankPayment\Values;

use ReflectionClass;

abstract class Value
{
    public function toArray(): array
    {
        $result = [];

        foreach ((new ReflectionClass($this))->getProperties() as $property) {
            if (!$property->isPrivate()) {
                $name = $property->getName();
                $value = $this->$name;

                if ($value !== null) {
                    $result[$name] = $value instanceof Value ? $value->toArray() : $value;
                }

                if (is_array($value)) {
                    foreach ($value as $key => $item) {
                        $result[$name][$key] = $item instanceof Value ? $item->toArray() : $item;
                    }
                }
            }
        }

        return $result;
    }
}