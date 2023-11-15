<?php

namespace Acme;

interface DataSource
{
    /** @return DataObject[] */
    public function all() : array;
}
