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

class RangeTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Range('field');

        self::assertEquals('range', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\Range('field', 1.0, 2.0);

        self::assertEquals([
            'field' => [
                'gte'   => 1.0,
                'lte'   => 2.0,
            ],
        ], $query->compile());

        $query->boost(0.2);

        self::assertEquals([
            'field' => [
                'gte'   => 1.0,
                'lte'   => 2.0,
                'boost' => 0.2,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function gt()
    {
        $query = new Query\Range('field');
        $query->gt(10);

        self::assertEquals([
            'field' => [
                'gt' => 10,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function lt()
    {
        $query = new Query\Range('field');
        $query->lt(20);

        self::assertEquals([
            'field' => [
                'lt' => 20,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function date()
    {
        $yesterday = new \DateTime('yesterday');
        $today = new \DateTime('now');

        $query = new Query\Range('field', $yesterday, $today);

        self::assertEquals([
            'field' => [
                'gte' => $yesterday->format(\DATE_RFC3339),
                'lte' => $today->format(\DATE_RFC3339),
            ],
        ], $query->compile());
    }
}
