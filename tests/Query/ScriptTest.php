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

class ScriptTest extends ElasticsTest
{
    /**
     * @test
     */
    public function name()
    {
        $query = new Query\Script('ctx.script.source');

        self::assertEquals('script', $query->name());
    }

    /**
     * @test
     */
    public function compile()
    {
        $source = "doc['num1'].value > params.value";
        $lang   =  \ELASTICS_LANG_PAINLESS;
        $params = [
            'value' => 1,
        ];

        $query = new Query\Script($source, $params, $lang);

        self::assertEquals([
            'script' => [
                'source' => $source,
                'params' => $params,
                'lang'   => $lang,
            ],
        ], $query->compile());
    }
}
