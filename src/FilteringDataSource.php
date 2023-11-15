<?php

namespace Acme;

final class FilteringDataSource implements DataSource
{
    public function __construct(private readonly DataSource $other)
    {
    }

    public function all() : array
    {
        return array_filter(
            $this->other->all(),
            new ActiveFilter(),
        );
    }
}
