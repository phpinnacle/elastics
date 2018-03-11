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

class FuzzyTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Fuzzy('field', 'value');

        self::assertEquals('fuzzy', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\Fuzzy('field', 'value');

        self::assertEquals([
            'field' => 'value',
        ], $query->compile());

        $query = new Query\Fuzzy('field', 'value', \ELASTICS_DEFAULT_FUZZINESS);

        self::assertEquals([
            'field' => [
                'value'     => 'value',
                'fuzziness' => \ELASTICS_DEFAULT_FUZZINESS,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function boost()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->boost(1.2);

        self::assertEquals([
            'field' => [
                'value' => 'value',
                'boost' => 1.2,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function prefixLength()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->prefixLength(5);

        self::assertEquals([
            'field' => [
                'value'         => 'value',
                'prefix_length' => 5,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function maxExpansions()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->maxExpansions(10);

        self::assertEquals([
            'field' => [
                'value'          => 'value',
                'max_expansions' => 10,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function fuzziness()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->fuzziness('2');

        self::assertEquals([
            'field' => [
                'value'     => 'value',
                'fuzziness' => '2',
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function transpositions()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->transpositions(true);

        self::assertEquals([
            'field' => [
                'value'          => 'value',
                'transpositions' => true,
            ],
        ], $query->compile());
    }
}
