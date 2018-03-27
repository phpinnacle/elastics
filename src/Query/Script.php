<?php
/*
 * This file is part of PHPinnacle/Elastics.
 *
 * (c) PHPinnacle Team <dev@phpinnacle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PHPinnacle\Elastics\Query;

use PHPinnacle\Elastics\Query;

class Script implements Query
{
    /**
     * @var string
     */
    private $source;

    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $lang;

    /**
     * @param string $source
     * @param array  $params
     * @param string $lang
     */
    public function __construct(string $source, array $params = [], string $lang = \ELASTICS_LANG_PAINLESS)
    {
        $this->source = $source;
        $this->params = $params;
        $this->lang   = $lang;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'script';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        return [
            'script' => [
                'source' => $this->source,
                'params' => $this->params,
                'lang'   => $this->lang,
            ],
        ];
    }
}
