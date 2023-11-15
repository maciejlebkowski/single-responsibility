<?php

namespace Acme;

final class ActiveFilter
{
    public function __invoke(DataObject $object) : bool
    {
        return $object->active;
    }
}
