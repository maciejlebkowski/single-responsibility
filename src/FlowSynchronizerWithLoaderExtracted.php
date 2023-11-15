<?php

namespace Acme;

use Flow\ETL\DSL\From;
use Flow\ETL\DSL\To;
use Flow\ETL\Flow;
use Flow\ETL\Row;
use Flow\ETL\Rows;
use function Flow\ETL\DSL\entry;
use function Flow\ETL\DSL\lit;
use function Flow\ETL\DSL\when;

final class FlowSynchronizerWithLoaderExtracted
{
    public function __construct(
        private readonly DataSource $dataSource,
        private readonly Repository $repository,
    ) {}

    public function synchronizeActive() : void
    {
        (new Flow())
            ->extract(new DataSourceExtractor($this->dataSource))
            ->filter(when(entry('active'), lit(true)))
            ->load(To::callback(
                fn (Rows $rows) => $rows->each(
                    fn (Row $row) => $this->repository->save(
                        $row->valueOf('name'),
                        $row->valueOf('value'),
                    ),
                ),
            ))
            ->run();
    }
}
