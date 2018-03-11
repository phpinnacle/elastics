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

class ConstantScoreTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\ConstantScore(new Query\Term('field', 'value'));

        self::assertEquals('constant_score', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\ConstantScore(new Query\Term('field', 'value'));

        self::assertEquals([
            'filter' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
        ], $query->compile());

        $query->boost(1.2);

        self::assertEquals([
            'filter' => [
                'term' => [
                    'field' => 'value',
                ],
            ],
            'boost' => 1.2,
        ], $query->compile());
    }
}
