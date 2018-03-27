<?php
/*
 * This file is part of PhpStorm.
 *
 * (c) PHPinnacle Team <dev@phpinnacle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PHPinnacle\Elastics\Tests\Query;

use PHPinnacle\Elastics\Tests\ElasticsTest;
use PHPinnacle\Elastics\Query;

class IdsTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Ids([1,2]);

        self::assertEquals('ids', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\Ids([1,2]);

        self::assertEquals([
            'values' => [1,2],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function type()
    {
        $query = new Query\Ids([1,2]);
        $query->type('user', 'customer');

        $compiled = $query->compile();

        self::assertArrayHasPath('type', $compiled);
        self::assertEquals(['user', 'customer'], $compiled['type']);
    }
}
