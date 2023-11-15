<?php

namespace Acme;

use Flow\ETL\FlowContext;
use Flow\ETL\Row;
use Flow\ETL\Rows;
use Flow\ETL\Transformer;

final class FilterInactiveTransformer implements Transformer
{

    public function transform(Rows $rows, FlowContext $context) : Rows
    {
        return $rows->filter(static fn (Row $row) => $row->valueOf('active'));
    }

    public function __serialize() : array
    {
        return [];
    }

    public function __unserialize(array $data) : void
    {
    }
}
