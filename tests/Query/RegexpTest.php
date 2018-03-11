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

class RegexpTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Regexp('field', 'value');

        self::assertEquals('regexp', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\Regexp('field', 's.*y');

        self::assertEquals([
            'field' => [
                'value' => 's.*y',
            ],
        ], $query->compile());

        $query->boost(0.2);

        self::assertEquals([
            'field' => [
                'value' => 's.*y',
                'boost' => 0.2,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function flags()
    {
        $query = new Query\Regexp('field', 's.*y');
        $query->flags(
            \ELASTICS_REGEXP_INTERSECTION |
            \ELASTICS_REGEXP_COMPLEMENT |
            \ELASTICS_REGEXP_EMPTY
        );

        $compiled = $query->compile();

        self::assertArrayHasKey('field', $compiled);
        self::assertArrayHasKey('flags', $compiled['field']);
        self::assertEquals('COMPLEMENT|EMPTY|INTERSECTION', $compiled['field']['flags']);
    }

    /**
     * @test
     */
    public function maxStates()
    {
        $query = new Query\Regexp('field', 's.*y');
        $query->maxStates(5000);

        $compiled = $query->compile();

        self::assertArrayHasKey('field', $compiled);
        self::assertArrayHasKey('max_determinized_states', $compiled['field']);
        self::assertEquals(5000, $compiled['field']['max_determinized_states']);
    }
}
