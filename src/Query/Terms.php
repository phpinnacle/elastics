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

class Terms implements Query
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var array
     */
    private $values;

    /**
     * @var array
     */
    private $lookup;

    /**
     * @param string $field
     * @param array  $values
     */
    public function __construct(string $field, array $values = [])
    {
        $this->field  = $field;
        $this->values = \array_values($values);
    }

    /**
     * @param string $index
     * @param string $id
     * @param string $path
     * @param string $type
     *
     * @return self
     */
    public function lookup(string $index, string $id, string $path, string $type = '_doc'): self
    {
        $this->lookup = [
            'index' => $index,
            'type'  => $type,
            'id'    => $id,
            'path'  => $path,
        ];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'terms';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        return [
            $this->field => $this->lookup ? $this->lookup : $this->values,
        ];
    }
}
