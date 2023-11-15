<?php

namespace Acme;

final class DataSourceStub implements DataSource
{
    public static function willReturn(DataObject ...$objects) : self
    {
        return new self($objects);
    }

    private function __construct(private readonly array $objects)
    {
    }

    public function all() : array
    {
        return $this->objects;
    }
}
