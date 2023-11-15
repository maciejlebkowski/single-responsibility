<?php

namespace Acme;

use Flow\ETL\FlowContext;
use Flow\ETL\Loader;
use Flow\ETL\Row;
use Flow\ETL\Rows;

final class RepositoryLoader implements Loader
{
    public function __construct(private readonly Repository $repository)
    {
    }

    public function load(Rows $rows, FlowContext $context) : void
    {
        $rows->each(
            fn (Row $row) => $this->repository->save(
                $row->valueOf('name'),
                $row->valueOf('value'),
            ),
        );
    }

    public function __serialize() : array
    {
        return [];
    }

    public function __unserialize(array $data) : void
    {
    }
}
