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

class QueryStringSimple implements Query
{
    use Traits\Match;

    /**
     * @var string
     */
    private $query;

    /**
     * @var array
     */
    private $fields;

    /**
     * @param string      $query
     * @param string[] ...$fields
     */
    public function __construct(string $query, string ...$fields)
    {
        $this->query  = $query;
        $this->fields = $fields;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'simple_query_string';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'query' => $this->query,
        ];

        if (\count($this->fields) > null) {
            $query['fields'] = $this->fields;
        }

        $query += $this->options([
            \ELASTICS_FIELD_OPERATOR       => 'default_operator',
            \ELASTICS_FIELD_PREFIX_LENGTH  => 'fuzzy_prefix_length',
            \ELASTICS_FIELD_MAX_EXPANSIONS => 'fuzzy_max_expansions',
            \ELASTICS_FIELD_TRANSPOSITIONS => 'fuzzy_transpositions',
        ]);

        return $query;
    }
}
