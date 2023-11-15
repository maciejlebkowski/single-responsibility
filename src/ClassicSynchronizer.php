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
        $records = array_filter(
            $records,
            static fn (DataObject $item) => $item->active,
        );

        foreach ($records as $record) {
            $this->repository->save($record->name, $record->value);
        }
    }
}
