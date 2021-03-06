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
    }

    /**
     * @test
     */
    public function boost()
    {
        $query = new Query\ConstantScore(new Query\Term('field', 'value'));
        $query->boost(1.2);

        $compiled = $query->compile();

        self::assertArrayHasPath('boost', $compiled);
        self::assertEquals(1.2, $compiled['boost']);
    }
}
