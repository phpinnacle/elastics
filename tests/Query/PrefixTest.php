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

class PrefixTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Prefix('field', 'va');

        self::assertEquals('prefix', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\Prefix('field', 'va');

        self::assertEquals([
            'field' => [
                'value' => 'va',
            ],
        ], $query->compile());

        $query->boost(0.2);

        self::assertEquals([
            'field' => [
                'value' => 'va',
                'boost' => 0.2,
            ],
        ], $query->compile());
    }
}
