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

class MatchPhraseTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\MatchPhrase('field', 'phrase');

        self::assertEquals('match_phrase', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\MatchPhrase('field', 'phrase');

        self::assertEquals([
            'field' => [
                'query' => 'phrase',
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function slop()
    {
        $query = new Query\MatchPhrase('field', 'phrase', 1);

        self::assertEquals([
            'field' => [
                'query' => 'phrase',
                'slop'  => 1,
            ],
        ], $query->compile());

        $query->slop(2);

        self::assertEquals([
            'field' => [
                'query' => 'phrase',
                'slop'  => 2,
            ],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function analyzer()
    {
        $query = new Query\MatchPhrase('field', 'phrase');
        $query->analyzer('custom');

        self::assertEquals([
            'field' => [
                'query'    => 'phrase',
                'analyzer' => 'custom',
            ],
        ], $query->compile());
    }
}
