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

class HasParent implements Query
{
    use Traits\IgnoreUnmapped;

    /**
     * @var string
     */
    private $type;

    /**
     * @var Query
     */
    private $query;

    /**
     * @var bool
     */
    private $score;

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
     * @param bool $value
     *
     * @return self
     */
    public function score(bool $value): self
    {
        $this->score = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'has_parent';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'parent_type' => $this->type,
            'query'       => $this->query,
        ];

        if ($this->score !== null) {
            $query['score'] = $this->score;
        }

        if ($this->ignoreUnmapped !== null) {
            $query['ignore_unmapped'] = $this->ignoreUnmapped;
        }

        return $query;
    }
}
