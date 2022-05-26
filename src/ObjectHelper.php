<?php

namespace App;

final class ObjectHelper
{
    /**
     * Permet d'hydrater le post
     * @param $object
     * @param array $data
     * @param array $fields
     * @return void
     */
    public static function hydrate($object, array $data, array $fields): void
    {
        foreach ($fields as $field) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
            $object->$method($data[$field]);
        }

    }
}