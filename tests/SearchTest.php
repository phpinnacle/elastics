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

namespace PHPinnacle\Elastics\Tests;

use PHPinnacle\Elastics\Query;
use PHPinnacle\Elastics\Search;

class SearchTest extends ElasticsTest
{
    /**
     * @test
     */
    public function match()
    {
        $search = Search::match(new Query\Term('field', 'value'));

        self::assertEquals([
            'query' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
        ], $search->body());
    }

    /**
     * @test
     */
    public function matchNone()
    {
        $search = Search::matchNone();

        self::assertEquals([
            'query' => [
                'match_none' => [],
            ],
        ], $search->body());
    }

    /**
     * @test
     */
    public function matchAll()
    {
        $search = Search::matchAll();

        self::assertEquals([
            'query' => [
                'match_all' => [],
            ],
        ], $search->body());

        $search = Search::matchAll(1.2);

        self::assertEquals([
            'query' => [
                'match_all' => [
                    'boost' => 1.2,
                ],
            ],
        ], $search->body());
    }

    /**
     * @test
     */
    public function limit()
    {
        $search = Search::matchAll();
        $search->limit(50);

        $request = $search->body();

        self::assertArrayHasKey('size', $request);
        self::assertEquals(50, $request['size']);
    }

    /**
     * @test
     */
    public function order()
    {
        $search = Search::matchAll();
        $search
            ->order('key_one', \ELASTICS_SORT_ASC)
            ->order('key_two', \ELASTICS_SORT_DESC)
        ;

        $request = $search->body();

        self::assertArrayHasKey('sort', $request);
        self::assertEquals([
            'key_one' => \ELASTICS_SORT_ASC,
            'key_two' => \ELASTICS_SORT_DESC,
        ], $request['sort']);
    }

    /**
     * @test
     * @expectedException \PHPinnacle\Elastics\Exception\InvalidSortDirection
     */
    public function invalidOrder()
    {
        $search = Search::matchAll();
        $search->order('key_one', 'invalid');
    }

    /**
     * @test
     */
    public function after()
    {
        $search = Search::matchAll();
        $search->after(['1', 2]);

        $request = $search->body();

        self::assertArrayHasKey('search_after', $request);
        self::assertEquals(['1', 2], $request['search_after']);
    }

    /**
     * @test
     */
    public function json()
    {
        $search = Search::match(new Query\Term('field', 'value'));

        self::assertJsonStringEqualsJsonString(\json_encode([
            'query' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
        ]), \json_encode($search));
    }

    /**
     * @test
     */
    public function stringify()
    {
        $search = Search::match(new Query\Term('field', 'value'));

        self::assertJsonStringEqualsJsonString(\json_encode([
            'query' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
        ]), (string) $search);
    }
}
