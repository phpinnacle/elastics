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
use PHPinnacle\Elastics\Traits\Boost;

class Wildcard implements Query
{
    use Boost;

    /**
     * @var string
     */
    private $field;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param string $field
     * @param mixed  $value
     */
    public function __construct(string $field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'wildcard';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'value' => $this->value,
        ];

        if ($this->boost !== null) {
            $query['boost'] = $this->boost;
        }

        return [
            $this->field => $query,
        ];
    }
}
