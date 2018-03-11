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

class Match implements Query
{
    use Traits\Match;

    /**
     * @var string
     */
    private $field;

    /**
     * @var mixed
     */
    private $query;

    /**
     * @param string $field
     * @param mixed  $query
     */
    public function __construct(string $field, $query)
    {
        $this->field = $field;
        $this->query = $query;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'match';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'query' => $this->query,
        ];

        $query += $this->options([
            \ELASTICS_FIELD_TRANSPOSITIONS => 'fuzzy_transpositions',
        ]);

        return [
            $this->field => $query,
        ];
    }
}
