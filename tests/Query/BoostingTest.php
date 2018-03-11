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

class BoostingTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Boosting();

        self::assertEquals('boosting', $query->name());
    }

    /**
     * @test
     */
    public function positive()
    {
        $term = new Query\Term('field', 'value');

        $query = new Query\Boosting();
        $query->positive($term);

        self::assertEquals([
            'positive' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
        ], $query->compile());

        $query->positive($term, 1.5);

        self::assertEquals([
            'positive' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
            'boost' => 1.5,
        ], $query->compile());
    }

    /**
     * @test
     */
    public function negative()
    {
        $term = new Query\Term('field', 'value');

        $query = new Query\Boosting();
        $query->negative($term);

        self::assertEquals([
            'negative' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
        ], $query->compile());

        $query->negative($term, 1.5);

        self::assertEquals([
            'negative' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
            'negative_boost' => 1.5,
        ], $query->compile());
    }
}
