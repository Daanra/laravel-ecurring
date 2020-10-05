<?php

namespace Daanra\Ecurring\Models;

use ReflectionClass;
use ReflectionProperty;

class BaseModel
{
    public string $id;

    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();
            if (isset($parameters[$property])) {
                $this->{$property} = $parameters[$property];
            }
        }
    }

    public static function make(array $data = [])
    {
        return new static($data);
    }
}
