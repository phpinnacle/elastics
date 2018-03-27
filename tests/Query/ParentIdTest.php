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

class ParentIdTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\ParentId('my_child', '_id_1');

        self::assertEquals('parent_id', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\ParentId('my_child', '_id_1');

        self::assertEquals([
            'type' => 'my_child',
            'id'   => '_id_1',
        ], $query->compile());
    }

    /**
     * @test
     */
    public function ignoreUnmapped()
    {
        $query = new Query\ParentId('my_child', '_id_1');
        $query->ignoreUnmapped(true);

        $compiled = $query->compile();

        self::assertArrayHasPath('ignore_unmapped', $compiled);
        self::assertEquals(true, $compiled['ignore_unmapped']);
    }
}
