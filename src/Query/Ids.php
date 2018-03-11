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

class Ids implements Query
{
    /**
     * @var array
     */
    private $values;

    /**
     * @var array
     */
    private $types;

    /**
     * @param array       $values
     * @param string[] ...$types
     */
    public function __construct(array $values, string ...$types)
    {
        $this->values = $values;
        $this->types  = $types;
    }

    /**
     * @param string[] ...$types
     *
     * @return self
     */
    public function type(string ...$types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'ids';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'values' => $this->values,
        ];

        if (count($this->types) !== 0) {
            $query['type'] = $this->types;
        }

        return $query;
    }
}
