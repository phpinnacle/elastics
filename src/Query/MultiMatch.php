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
use PHPinnacle\Elastics\Exception;

class MultiMatch implements Query
{
    use
        Traits\Match,
        Traits\TieBreaker
    ;

    /**
     * @var array
     */
    private $fields;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $type;

    /**
     * @param array  $fields
     * @param string $query
     * @param string $type
     */
    public function __construct(array $fields, string $query, string $type = null)
    {
        $this->guardType($type);

        $this->fields = $fields;
        $this->query  = $query;
        $this->type   = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'multi_match';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'fields' => $this->fields,
            'query'  => $this->query,
        ];

        if ($this->type !== null) {
            $query['type'] = $this->type;
        }

        if ($this->tieBreaker !== null) {
            $query['tie_breaker'] = $this->tieBreaker;
        }

        return $query + $this->options([
            \ELASTICS_FIELD_TRANSPOSITIONS => 'fuzzy_transpositions',
        ]);
    }

    /**
     * @param string $value
     *
     * @return void
     */
    private function guardType(string $value = null)
    {
        if ($value === null) {
            return;
        }

        if (!\in_array($value, [
            \ELASTICS_TYPE_BEST_FIELDS,
            \ELASTICS_TYPE_MOST_FIELDS,
            \ELASTICS_TYPE_CROSS_FIELDS,
            \ELASTICS_TYPE_PHRASE,
            \ELASTICS_TYPE_PHRASE_PREFIX,
        ], true)) {
            throw new Exception\InvalidMatchType($value);
        };
    }
}
