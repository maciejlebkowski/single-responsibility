<?php

namespace Acme;

final class ClassicSynchronizerWithFilterDelegated
{
    private readonly DataSource $dataSource;

    public function __construct(
        DataSource $dataSource,
        private readonly Repository $repository,
    ) {
        $this->dataSource = new FilteringDataSource($dataSource);
    }

    public function synchronizeActive() : void
    {
        $records = $this->dataSource->all();

        foreach ($records as $record) {
            $this->repository->save($record->name, $record->value);
        }
    }
}
