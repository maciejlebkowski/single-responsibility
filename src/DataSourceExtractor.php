<?php

namespace Acme;

use Flow\ETL\Extractor;
use Flow\ETL\FlowContext;
use Flow\ETL\Rows;

final class DataSourceExtractor implements Extractor
{

    public function __construct(private readonly DataSource $dataSource)
    {
    }

    public function extract(FlowContext $context) : \Generator
    {
        $records = $this->dataSource->all();
        foreach ($records as $record) {
            yield Rows::fromArray([get_object_vars($record)]);
        }
    }
}
