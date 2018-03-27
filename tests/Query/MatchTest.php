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

class MatchTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Match('field', 'query string');

        self::assertEquals('match', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\Match('field', 'query string');

        self::assertEquals([
            'field' => [
                'query' => 'query string',
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function boost()
    {
        $query = new Query\Match('field', 'query string');
        $query->boost(0.2);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.boost', $compiled);
        self::assertEquals(0.2, $compiled['field']['boost']);
    }

    /**
     * @test
     */
    public function prefixLength()
    {
        $query = new Query\Match('field', 'query string');
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
        $query = new Query\Match('field', 'query string');
        $query->maxExpansions(20);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.max_expansions', $compiled);
        self::assertEquals(20, $compiled['field']['max_expansions']);
    }

    /**
     * @test
     */
    public function fuzziness()
    {
        $query = new Query\Match('field', 'query string');
        $query->fuzziness('AUTO');

        $compiled = $query->compile();

        self::assertArrayHasPath('field.fuzziness', $compiled);
        self::assertEquals('AUTO', $compiled['field']['fuzziness']);
    }

    /**
     * @test
     */
    public function transpositions()
    {
        $query = new Query\Match('field', 'query string');
        $query->transpositions(true);

        $compiled = $query->compile();

        self::assertArrayHasKey('field', $compiled);
        self::assertArrayHasKey('fuzzy_transpositions', $compiled['field']);
        self::assertEquals(true, $compiled['field']['fuzzy_transpositions']);
    }

    /**
     * @test
     */
    public function operator()
    {
        $query = new Query\Match('field', 'query string');
        $query->operator(\ELASTICS_OPERATOR_OR);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.operator', $compiled);
        self::assertEquals(\ELASTICS_OPERATOR_OR, $compiled['field']['operator']);
    }

    /**
     * @test
     * @expectedException \PHPinnacle\Elastics\Exception\InvalidOperator
     */
    public function invalidOperator()
    {
        $query = new Query\Match('field', 'query string');
        $query->operator('invalid');
    }

    /**
     * @test
     */
    public function lenient()
    {
        $query = new Query\Match('field', 'query string');
        $query->lenient(true);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.lenient', $compiled);
        self::assertEquals(true, $compiled['field']['lenient']);
    }

    /**
     * @test
     */
    public function zeroTerms()
    {
        $query = new Query\Match('field', 'query string');
        $query->zeroTerms(\ELASTICS_ZERO_TERMS_NONE);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.zero_terms_query', $compiled);
        self::assertEquals(\ELASTICS_ZERO_TERMS_NONE, $compiled['field']['zero_terms_query']);
    }

    /**
     * @test
     * @expectedException \PHPinnacle\Elastics\Exception\InvalidZeroTerms
     */
    public function invalidZeroTerms()
    {
        $query = new Query\Match('field', 'query string');
        $query->zeroTerms('invalid');
    }

    /**
     * @test
     */
    public function cutoffFrequency()
    {
        $query = new Query\Match('field', 'query string');
        $query->cutoffFrequency(1.1);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.cutoff_frequency', $compiled);
        self::assertEquals(1.1, $compiled['field']['cutoff_frequency']);
    }

    /**
     * @test
     */
    public function shouldMatch()
    {
        $query = new Query\Match('field', 'query string');
        $query->shouldMatch(2);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.minimum_should_match', $compiled);
        self::assertEquals(2, $compiled['field']['minimum_should_match']);
    }
}
