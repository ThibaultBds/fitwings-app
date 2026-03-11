<?php

namespace App\Models;

use ArrayAccess;

abstract class BaseModel implements ArrayAccess
{
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public function fill(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function offsetExists(mixed $offset): bool
    {
        return property_exists($this, (string) $offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->{(string) $offset} ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (property_exists($this, (string) $offset)) {
            $this->{(string) $offset} = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        // non utilisé
    }
}
