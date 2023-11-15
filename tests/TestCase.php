<?php

namespace Acme;

use PHPUnit\Framework\Attributes\DataProvider;

final class TestCase extends \PHPUnit\Framework\TestCase
{
    #[DataProvider('implementations')]
    public function test(string $class) : void
    {
        $dataSource = DataSourceStub::willReturn(
            new DataObject('foo', false, 1),
            new DataObject('bar', true, 2),
            new DataObject('baz', true, 3),
        );
        $repository = new RepositorySpy();

        $sut = new $class($dataSource, $repository);
        $sut->synchronizeActive();

        $this->assertEquals(
            [
                [
                    'name' => 'bar',
                    'value' => 2,
                ],
                [
                    'name' => 'baz',
                    'value' => 3,
                ],
            ],
            $repository->saved,
        );
    }

    public static function implementations() : iterable
    {
        yield [ClassicSynchronizer::class];
        yield [ClassicSynchronizerWithFilterDelegated::class];
        yield [ClassicSynchronizerWithFilterExtracted::class];
        yield [FlowSynchronizer::class];
        yield [FlowSynchronizerWithLoaderExtracted::class];
        yield [FlowSynchronizerWithAllExtracted::class];
    }
}
