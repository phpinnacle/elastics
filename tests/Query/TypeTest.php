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

class TypeTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Type();

        self::assertEquals('type', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\Type('user');

        self::assertEquals([
            'value' => 'user',
        ], $query->compile());
    }
}
