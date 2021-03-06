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

class QueryStringTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\QueryString('this AND that OR thus');

        self::assertEquals('query_string', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\QueryString('this AND that OR thus');

        self::assertEquals([
            'query' => 'this AND that OR thus',
        ], $query->compile());

        $query = new Query\QueryString('this AND that OR thus', 'field');

        self::assertEquals([
            'query'         => 'this AND that OR thus',
            'default_field' => 'field'
        ], $query->compile());
    }

    /**
     * @test
     */
    public function boost()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->boost(0.2);

        $compiled = $query->compile();

        self::assertArrayHasPath('boost', $compiled);
        self::assertEquals(0.2, $compiled['boost']);
    }

    /**
     * @test
     */
    public function prefixLength()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->prefixLength(5);

        $compiled = $query->compile();

        self::assertArrayHasPath('fuzzy_prefix_length', $compiled);
        self::assertEquals(5, $compiled['fuzzy_prefix_length']);
    }

    /**
     * @test
     */
    public function maxExpansions()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->maxExpansions(20);

        $compiled = $query->compile();

        self::assertArrayHasPath('fuzzy_max_expansions', $compiled);
        self::assertEquals(20, $compiled['fuzzy_max_expansions']);
    }

    /**
     * @test
     */
    public function fuzziness()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->fuzziness('AUTO');

        $compiled = $query->compile();

        self::assertArrayHasPath('fuzziness', $compiled);
        self::assertEquals('AUTO', $compiled['fuzziness']);
    }

    /**
     * @test
     */
    public function transpositions()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->transpositions(true);

        $compiled = $query->compile();

        self::assertArrayHasPath('fuzzy_transpositions', $compiled);
        self::assertEquals(true, $compiled['fuzzy_transpositions']);
    }

    /**
     * @test
     */
    public function operator()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->operator(\ELASTICS_OPERATOR_OR);

        $compiled = $query->compile();

        self::assertArrayHasPath('default_operator', $compiled);
        self::assertEquals(\ELASTICS_OPERATOR_OR, $compiled['default_operator']);
    }

    /**
     * @test
     * @expectedException \PHPinnacle\Elastics\Exception\InvalidOperator
     */
    public function invalidOperator()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->operator('invalid');
    }

    /**
     * @test
     */
    public function lenient()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->lenient(true);

        $compiled = $query->compile();

        self::assertArrayHasPath('lenient', $compiled);
        self::assertEquals(true, $compiled['lenient']);
    }

    /**
     * @test
     */
    public function zeroTerms()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->zeroTerms(\ELASTICS_ZERO_TERMS_NONE);

        $compiled = $query->compile();

        self::assertArrayHasPath('zero_terms_query', $compiled);
        self::assertEquals(\ELASTICS_ZERO_TERMS_NONE, $compiled['zero_terms_query']);
    }

    /**
     * @test
     * @expectedException \PHPinnacle\Elastics\Exception\InvalidZeroTerms
     */
    public function invalidZeroTerms()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->zeroTerms('invalid');
    }

    /**
     * @test
     */
    public function cutoffFrequency()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->cutoffFrequency(1.1);

        $compiled = $query->compile();

        self::assertArrayHasPath('cutoff_frequency', $compiled);
        self::assertEquals(1.1, $compiled['cutoff_frequency']);
    }

    /**
     * @test
     */
    public function shouldMatch()
    {
        $query = new Query\QueryString('this AND that OR thus');
        $query->shouldMatch(2);

        $compiled = $query->compile();

        self::assertArrayHasPath('minimum_should_match', $compiled);
        self::assertEquals(2, $compiled['minimum_should_match']);
    }
}
