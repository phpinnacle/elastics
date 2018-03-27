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

class DisMaxTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\DisMax();

        self::assertEquals('dis_max', $query->name());
    }

    /**
     * @test
     */
    public function compileSingle()
    {
        $query = new Query\DisMax(new Query\Term('field', 'value'));

        self::assertEquals([
            'queries' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function boost()
    {
        $query = new Query\DisMax(new Query\Term('field', 'value'));
        $query->boost(1.2);

        $compiled = $query->compile();

        self::assertArrayHasPath('boost', $compiled);
        self::assertEquals(1.2, $compiled['boost']);
    }

    /**
     * @test
     */
    public function compileMultiple()
    {
        $query = new Query\DisMax(
            new Query\Term('field_one', 'value_one'),
            new Query\Term('field_two', 'value_two')
        );

        self::assertEquals([
            'queries' => [
                [
                    'term' => [
                        'field_one' => 'value_one',
                    ],
                ],
                [
                    'term' => [
                        'field_two' => 'value_two',
                    ],
                ],
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function tieBreaker()
    {
        $query = new Query\DisMax(new Query\Term('field', 'value'));
        $query->tieBreaker(0.7);

        self::assertEquals([
            'queries' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
            'tie_breaker' => 0.7,
        ], $query->compile());
    }
}
