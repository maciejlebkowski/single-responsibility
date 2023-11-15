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

final class FlowSynchronizerWithAllExtracted
{
    public function __construct(
        private readonly DataSource $dataSource,
        private readonly Repository $repository,
    ) {}

    public function synchronizeActive() : void
    {
        (new Flow())
            ->extract(new DataSourceExtractor($this->dataSource))
            ->transform(new FilterInactiveTransformer())
            ->load(new RepositoryLoader($this->repository))
            ->run();
    }
}
