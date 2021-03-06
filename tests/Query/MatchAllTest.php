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

class MatchAllTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\MatchAll();

        self::assertEquals('match_all', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\MatchAll();

        self::assertEquals([], $query->compile());
    }

    /**
     * @test
     */
    public function boost()
    {
        $query = new Query\MatchAll();
        $query->boost(1.2);

        $compiled = $query->compile();

        self::assertArrayHasPath('boost', $compiled);
        self::assertEquals(1.2, $compiled['boost']);
    }
}
