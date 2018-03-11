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

namespace PHPinnacle\Elastics;

class Search implements \JsonSerializable
{
    /**
     * @var Query
     */
    private $query;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var array
     */
    private $sort = [];

    /**
     * @var array
     */
    private $after = [];

    /**
     * @param Query $query
     */
    private function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * @param Query $query
     *
     * @return self
     */
    public static function match(Query $query): self
    {
        return new self($query);
    }

    /**
     * @param float|null $boost
     *
     * @return self
     */
    public static function matchAll(float $boost = null): self
    {
        $query = new Query\MatchAll();

        if ($boost !== null) {
            $query->boost($boost);
        }

        return new self($query);
    }

    /**
     * @return self
     */
    public static function matchNone(): self
    {
        return new self(new Query\MatchNone());
    }

    /**
     * @param int $limit
     *
     * @return self
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param string $field
     * @param string $direction
     *
     * @return self
     */
    public function order(string $field, string $direction): self
    {
        $direction = \strtolower($direction);

        if ($direction !== \ELASTICS_SORT_ASC && $direction !== \ELASTICS_SORT_DESC) {
            throw new Exception\InvalidSortDirection($direction);
        }

        $this->sort[$field] = $direction;

        return $this;
    }

    /**
     * @param array $after
     *
     * @return self
     */
    public function after(array $after): self
    {
        $this->after = $after;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function body(): array
    {
        $search = [
            'query' => \elastics_compile($this->query),
        ];

        if ($this->limit !== null) {
            $search['size'] = $this->limit;
        }

        if (!empty($this->sort)) {
            $search['sort'] = $this->sort;
        }

        if (!empty($this->after)) {
            $search['search_after'] = $this->after;
        }

        return $search;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->body();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return \elastics_encode($this->jsonSerialize());
    }
}
