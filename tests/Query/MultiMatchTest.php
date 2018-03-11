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

class MultiMatchTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\MultiMatch(['field_one', 'field_two'], 'query string');

        self::assertEquals('multi_match', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\MultiMatch(['field_one', 'field_two'], 'query string');

        self::assertEquals([
            'fields' => ['field_one', 'field_two'],
            'query'  => 'query string',
        ], $query->compile());

        $query = new Query\MultiMatch(['field_one', 'field_two'], 'query string', \ELASTICS_TYPE_CROSS_FIELDS);

        self::assertEquals([
            'fields' => ['field_one', 'field_two'],
            'query'  => 'query string',
            'type'   => \ELASTICS_TYPE_CROSS_FIELDS,
        ], $query->compile());
    }

    /**
     * @test
     */
    public function tieBreaker()
    {
        $query = new Query\MultiMatch(['field_one', 'field_two'], 'query string');
        $query->tieBreaker(0.7);

        self::assertEquals([
            'fields'      => ['field_one', 'field_two'],
            'query'       => 'query string',
            'tie_breaker' => 0.7,
        ], $query->compile());
    }

    /**
     * @test
     * @expectedException \PHPinnacle\Elastics\Exception\InvalidMatchType
     */
    public function invalidType()
    {
        new Query\MultiMatch(['field_one', 'field_two'], 'query', 'invalid');
    }
}
