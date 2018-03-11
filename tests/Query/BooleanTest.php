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

class BooleanTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Boolean();

        self::assertEquals('bool', $query->name());
    }

    /**
     * @test
     */
    public function filter()
    {
        $query = new Query\Boolean();
        $query->filter(
            new Query\Term('field_one', 'value_one'),
            new Query\Term('field_two', 'value_two')
        );

        self::assertEquals([
            'filter' => [
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
    public function must()
    {
        $query = new Query\Boolean();
        $query->must(
            new Query\Term('field_one', 'value_one'),
            new Query\Term('field_two', 'value_two')
        );

        self::assertEquals([
            'must' => [
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
    public function mustNot()
    {
        $query = new Query\Boolean();
        $query->mustNot(
            new Query\Term('field_one', 'value_one'),
            new Query\Term('field_two', 'value_two')
        );

        self::assertEquals([
            'must_not' => [
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
    public function should()
    {
        $query = new Query\Boolean();
        $query->should(
            new Query\Term('field_one', 'value_one'),
            new Query\Term('field_two', 'value_two')
        );

        self::assertEquals([
            'should' => [
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
}
