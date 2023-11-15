<?php

namespace Acme;

final class DataObject
{
    public function __construct(
        public readonly string $name,
        public readonly bool $active,
        public readonly int $value,
    ) {
    }
}

