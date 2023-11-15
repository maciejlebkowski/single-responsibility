<?php

namespace Acme;

interface Repository
{
    public function save(string $name, int $value) : void;
}
