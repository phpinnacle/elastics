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

namespace PHPinnacle\Elastics\Query;

use PHPinnacle\Elastics\Query;

class Boosting implements Query
{
    /**
     * @var Query
     */
    private $positiveQuery;

    /**
     * @var float
     */
    private $positiveBoost;

    /**
     * @var Query
     */
    private $negativeQuery;

    /**
     * @var float
     */
    private $negativeBoost;

    /**
     * @param Query      $positive
     * @param float|null $boost
     *
     * @return Boosting
     */
    public function positive(Query $positive, float $boost = null): self
    {
        $this->positiveQuery = $positive;
        $this->positiveBoost = $boost;

        return $this;
    }

    /**
     * @param Query      $negative
     * @param float|null $boost
     *
     * @return Boosting
     */
    public function negative(Query $negative, float $boost = null): self
    {
        $this->negativeQuery = $negative;
        $this->negativeBoost = $boost;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'boosting';
    }

    /**
     * @return array
     */
    public function compile(): array
    {
        $query = [];

        if ($this->positiveQuery) {
            $query['positive'] = \elastics_compile($this->positiveQuery);
        }

        if ($this->positiveBoost !== null) {
            $query['boost'] = $this->positiveBoost;
        }

        if ($this->negativeQuery) {
            $query['negative'] = \elastics_compile($this->negativeQuery);
        }

        if ($this->negativeBoost !== null) {
            $query['negative_boost'] = $this->negativeBoost;
        }

        return $query;
    }
}
