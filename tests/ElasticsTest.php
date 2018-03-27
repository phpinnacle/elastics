<?php
/*
 * This file is part of PHPinnacle/Elastics.
 *
 * (c) PHPinnacle Team <dev@phpinnacle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPinnacle\Elastics\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Util\InvalidArgumentHelper;

abstract class ElasticsTest extends TestCase
{
    public static function assertArrayHasPath($path, $array, $message = '')
    {
        if (!(\is_int($path) || \is_string($path))) {
            throw InvalidArgumentHelper::factory(1, 'integer or string');
        }

        if (!(\is_array($array) || $array instanceof \ArrayAccess)) {
            throw InvalidArgumentHelper::factory(2, 'array or ArrayAccess');
        }

        $constraint = new Constraint\ArrayHasPath($path);

        static::assertThat($array, $constraint, $message);
    }
}
