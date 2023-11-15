<?php

namespace Acme;

final class ClassicSynchronizer
{
    public function __construct(
        private readonly DataSource $dataSource,
        private readonly Repository $repository,
    ) {}

    public function synchronizeActive() : void
    {
        $records = $this->dataSource->all();

        foreach ($records as $record) {
            if ($record->active) {
                $this->repository->save($record->name, $record->value);
            }
        }
    }
}
