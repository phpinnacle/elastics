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
use PHPinnacle\Elastics\Traits;

class Nested implements Query
{
    use
        Traits\IgnoreUnmapped,
        Traits\ScoreMode
    ;

    /**
     * @var string
     */
    private $path;

    /**
     * @var Query
     */
    private $query;

    /**
     * @param string $path
     * @param Query  $query
     */
    public function __construct(string $path, Query $query)
    {
        $this->path  = $path;
        $this->query = $query;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'nested';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'path'  => $this->path,
            'query' => $this->query,
        ];

        if ($this->scoreMode !== null) {
            $query['score_mode'] = $this->scoreMode;
        }

        if ($this->ignoreUnmapped !== null) {
            $query['ignore_unmapped'] = $this->ignoreUnmapped;
        }

        return $query;
    }
}
