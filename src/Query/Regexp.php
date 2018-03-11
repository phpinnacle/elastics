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

class Regexp implements Query
{
    use Traits\Boost;

    const FLAGS = [
        'ALL'          => \ELASTICS_REGEXP_ALL,
        'ANYSTRING'    => \ELASTICS_REGEXP_ANYSTRING,
        'COMPLEMENT'   => \ELASTICS_REGEXP_COMPLEMENT,
        'EMPTY'        => \ELASTICS_REGEXP_EMPTY,
        'INTERSECTION' => \ELASTICS_REGEXP_INTERSECTION,
        'INTERVAL'     => \ELASTICS_REGEXP_INTERVAL,
    ];

    /**
     * @var string
     */
    private $field;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var int
     */
    private $flags;

    /**
     * @var int
     */
    private $maxStates;

    /**
     * @param string $field
     * @param mixed  $value
     * @param int    $flags
     */
    public function __construct(string $field, $value, int $flags = null)
    {
        $this->field = $field;
        $this->value = $value;
        $this->flags = $flags;
    }

    /**
     * @param int $flags
     *
     * @return self
     */
    public function flags(int $flags): self
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @param int $maxStates
     *
     * @return self
     */
    public function maxStates(int $maxStates): self
    {
        $this->maxStates = $maxStates;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'regexp';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'value' => $this->value,
        ];

        if ($this->flags !== null) {
            $query['flags'] = $this->buildFlagsString($this->flags);
        }

        if ($this->maxStates !== null) {
            $query['max_determinized_states'] = $this->maxStates;
        }

        if ($this->boost !== null) {
            $query['boost'] = $this->boost;
        }

        return [
            $this->field => $query,
        ];
    }

    /**
     * @param int $flags
     *
     * @return string
     */
    public function buildFlagsString(int $flags): string
    {
        $mask = [];

        foreach (self::FLAGS as $key => $bit) {
            if ($flags & $bit) {
                $mask[] = $key;
            }
        }

        return \implode('|', $mask);
    }
}
