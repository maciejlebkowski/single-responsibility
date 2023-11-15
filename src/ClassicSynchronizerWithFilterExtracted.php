<?php

namespace Acme;

final class ClassicSynchronizerWithFilterExtracted
{
    public function __construct(
        private readonly DataSource $dataSource,
        private readonly Repository $repository,
    ) {}

    public function synchronizeActive() : void
    {
        $records = $this->dataSource->all();
        $records = array_filter(
            $records,
            new ActiveFilter(),
        );

        foreach ($records as $record) {
            $this->repository->save($record->name, $record->value);
        }
    }
}
