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

class HasChild implements Query
{
    use
        Traits\IgnoreUnmapped,
        Traits\ScoreMode
    ;

    /**
     * @var string
     */
    private $type;

    /**
     * @var Query
     */
    private $query;

    /**
     * @var int
     */
    private $minChildren;

    /**
     * @var int
     */
    private $maxChildren;

    /**
     * @param string $type
     * @param Query  $query
     */
    public function __construct(string $type, Query $query)
    {
        $this->type  = $type;
        $this->query = $query;
    }

    /**
     * @param int $min
     *
     * @return self
     */
    public function minChildren(int $min): self
    {
        $this->minChildren = $min;

        return $this;
    }

    /**
     * @param int $max
     *
     * @return self
     */
    public function maxChildren(int $max): self
    {
        $this->maxChildren = $max;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'has_child';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'type'  => $this->type,
            'query' => $this->query,
        ];

        if ($this->scoreMode !== null) {
            $query['score_mode'] = $this->scoreMode;
        }

        if ($this->ignoreUnmapped !== null) {
            $query['ignore_unmapped'] = $this->ignoreUnmapped;
        }

        if ($this->minChildren !== null) {
            $query['min_children'] = $this->minChildren;
        }

        if ($this->maxChildren !== null) {
            $query['max_children'] = $this->maxChildren;
        }

        return $query;
    }
}
