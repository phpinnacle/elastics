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

class MatchPhrasePrefixTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\MatchPhrasePrefix('field', 'qu');

        self::assertEquals('match_phrase_prefix', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\MatchPhrasePrefix('field', 'qu');

        self::assertEquals([
            'field' => [
                'query' => 'qu',
            ],
        ], $query->compile());
    }
}
