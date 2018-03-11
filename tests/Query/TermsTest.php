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

class TermsTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Terms('field', [1,2,3]);

        self::assertEquals('terms', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $query = new Query\Terms('field', [1,2,3]);

        self::assertEquals([
            'field' => [1,2,3],
        ], $query->compile());
    }

    /**
     * @test
     */
    public function lookup()
    {
        $query = new Query\Terms('field');
        $query->lookup('users', '2', 'followers', 'user');

        self::assertEquals([
            'field' => [
                'index' => 'users',
                'type'  => 'user',
                'id'    => '2',
                'path'  => 'followers',
            ],
        ], $query->compile());
    }
}
