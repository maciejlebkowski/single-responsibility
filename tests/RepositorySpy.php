<?php

namespace Acme;

final class RepositorySpy implements Repository
{
    public array $saved = [];

    public function save(string $name, int $value) : void
    {
        $this->saved[] = compact('name', 'value');
    }
}
