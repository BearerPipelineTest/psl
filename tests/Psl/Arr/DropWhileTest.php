<?php

declare(strict_types=1);

namespace Psl\Tests\Arr;

use PHPUnit\Framework\TestCase;
use Psl\Arr;

class DropWhileTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testDropWhile(array $expected, array $array, callable $callable): void
    {
        $result = Arr\drop_while($array, $callable);

        self::assertSame($expected, $result);
    }

    public function provideData(): iterable
    {
        yield [[1, 2, 3, 4, 5], [1, 2, 3, 4, 5], fn (int $_): bool => false];
        yield [[3 => 4, 4 => 5], [1, 2, 3, 4, 5], fn (int $i) => $i <= 3];
        yield [[2 => 3, 3 => 4, 4 => 5], [1, 2, 3, 4, 5], fn (int $i) => $i <= 2];
        yield [[], [1, 2, 3, 4, 5], fn (int $_) => true];
    }
}
