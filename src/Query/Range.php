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

class Range implements Query
{
    use Traits\Boost;

    /**
     * @var string
     */
    private $field;

    /**
     * @var array
     */
    private $left;

    /**
     * @var array
     */
    private $right;

    /**
     * @param string $field
     * @param mixed  $gte
     * @param mixed  $lte
     */
    public function __construct(string $field, $gte = null, $lte = null)
    {
        $this->field = $field;

        $this->gte($gte);
        $this->lte($lte);
    }

    /**
     * @param mixed $value
     *
     * @return self
     */
    public function gt($value): self
    {
        $this->limit('left', 'gt', $value);

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return self
     */
    public function gte($value): self
    {
        $this->limit('left', 'gte', $value);

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return self
     */
    public function lt($value): self
    {
        $this->limit('right', 'lt', $value);

        return $this;
    }

    /**
     * @param mixed $value
     *
     * @return self
     */
    public function lte($value): self
    {
        $this->limit('right', 'lte', $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'range';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = (array) $this->left + (array) $this->right;

        if ($this->boost) {
            $query['boost'] = $this->boost;
        }

        return [
            $this->field => $query,
        ];
    }

    /**
     * @param $type
     * @param $value
     * @param $field
     */
    private function limit(string $field, string $type, $value)
    {
        if ($value === null) {
            $this->{$field} = null;
        } elseif ($value instanceof \DateTimeInterface) {
            $this->{$field} = [
                $type => $value->format(\DATE_RFC3339),
            ];
        } elseif (\is_scalar($value)) {
            $this->{$field} = [
                $type => $value,
            ];
        }
    }
}
