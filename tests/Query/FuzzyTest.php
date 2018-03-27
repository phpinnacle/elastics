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

        $compiled = $query->compile();

        self::assertArrayHasPath('field.boost', $compiled);
        self::assertEquals(1.2, $compiled['field']['boost']);
    }

    /**
     * @test
     */
    public function prefixLength()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->prefixLength(5);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.prefix_length', $compiled);
        self::assertEquals(5, $compiled['field']['prefix_length']);
    }

    /**
     * @test
     */
    public function maxExpansions()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->maxExpansions(10);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.max_expansions', $compiled);
        self::assertEquals(10, $compiled['field']['max_expansions']);
    }

    /**
     * @test
     */
    public function fuzziness()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->fuzziness('2');

        $compiled = $query->compile();

        self::assertArrayHasPath('field.fuzziness', $compiled);
        self::assertEquals('2', $compiled['field']['fuzziness']);
    }

    /**
     * @test
     */
    public function transpositions()
    {
        $query = new Query\Fuzzy('field', 'value');
        $query->transpositions(true);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.transpositions', $compiled);
        self::assertEquals(true, $compiled['field']['transpositions']);
    }
}
