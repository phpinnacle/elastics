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

class QueryStringSimpleTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');

        self::assertEquals('simple_query_string', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');

        self::assertEquals([
            'query' => 'this AND that OR thus',
        ], $query->compile());

        $query = new Query\QueryStringSimple('this AND that OR thus', 'field', 'other_field');

        self::assertEquals([
            'query'  => 'this AND that OR thus',
            'fields' => ['field', 'other_field'],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function boost()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->boost(0.2);

        self::assertEquals([
            'query' => 'this AND that OR thus',
            'boost' => 0.2,
        ], $query->compile());
    }

    /**
     * @test
     */
    public function prefixLength()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->prefixLength(5);

        $compiled = $query->compile();

        self::assertArrayHasKey('fuzzy_prefix_length', $compiled);
        self::assertEquals(5, $compiled['fuzzy_prefix_length']);
    }

    /**
     * @test
     */
    public function maxExpansions()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->maxExpansions(20);

        $compiled = $query->compile();

        self::assertArrayHasKey('fuzzy_max_expansions', $compiled);
        self::assertEquals(20, $compiled['fuzzy_max_expansions']);
    }

    /**
     * @test
     */
    public function fuzziness()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->fuzziness('AUTO');

        $compiled = $query->compile();

        self::assertArrayHasKey('fuzziness', $compiled);
        self::assertEquals('AUTO', $compiled['fuzziness']);
    }

    /**
     * @test
     */
    public function transpositions()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->transpositions(true);

        $compiled = $query->compile();

        self::assertArrayHasKey('fuzzy_transpositions', $compiled);
        self::assertEquals(true, $compiled['fuzzy_transpositions']);
    }

    /**
     * @test
     */
    public function operator()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->operator(\ELASTICS_OPERATOR_OR);

        $compiled = $query->compile();

        self::assertArrayHasKey('default_operator', $compiled);
        self::assertEquals(\ELASTICS_OPERATOR_OR, $compiled['default_operator']);
    }

    /**
     * @test
     * @expectedException \PHPinnacle\Elastics\Exception\InvalidOperator
     */
    public function invalidOperator()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->operator('invalid');
    }

    /**
     * @test
     */
    public function lenient()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->lenient(true);

        $compiled = $query->compile();

        self::assertArrayHasKey('lenient', $compiled);
        self::assertEquals(true, $compiled['lenient']);
    }

    /**
     * @test
     */
    public function zeroTerms()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->zeroTerms(\ELASTICS_ZERO_TERMS_NONE);

        $compiled = $query->compile();

        self::assertArrayHasKey('zero_terms_query', $compiled);
        self::assertEquals(\ELASTICS_ZERO_TERMS_NONE, $compiled['zero_terms_query']);
    }

    /**
     * @test
     * @expectedException \PHPinnacle\Elastics\Exception\InvalidZeroTerms
     */
    public function invalidZeroTerms()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->zeroTerms('invalid');
    }

    /**
     * @test
     */
    public function cutoffFrequency()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->cutoffFrequency(1.1);

        $compiled = $query->compile();

        self::assertArrayHasKey('cutoff_frequency', $compiled);
        self::assertEquals(1.1, $compiled['cutoff_frequency']);
    }

    /**
     * @test
     */
    public function shouldMatch()
    {
        $query = new Query\QueryStringSimple('this AND that OR thus');
        $query->shouldMatch(2);

        $compiled = $query->compile();

        self::assertArrayHasKey('minimum_should_match', $compiled);
        self::assertEquals(2, $compiled['minimum_should_match']);
    }
}
