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
        $query    = new Query\MatchPhrase('field', 'phrase', 1);
        $compiled = $query->compile();

        self::assertArrayHasPath('field.slop', $compiled);
        self::assertEquals(1, $compiled['field']['slop']);

        $query->slop(2);

        $compiled = $query->compile();

        self::assertArrayHasPath('field.slop', $compiled);
        self::assertEquals(2, $compiled['field']['slop']);
    }

    /**
     * @test
     */
    public function analyzer()
    {
        $query = new Query\MatchPhrase('field', 'phrase');
        $query->analyzer('custom');

        $compiled = $query->compile();

        self::assertArrayHasPath('field.analyzer', $compiled);
        self::assertEquals('custom', $compiled['field']['analyzer']);
    }
}
