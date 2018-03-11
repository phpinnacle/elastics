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

class Term implements Query
{
    use Traits\Boost;

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
        return 'term';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        if ($this->boost === null) {
            return [
                $this->field => $this->value,
            ];
        }

        return [
            $this->field => [
                'value' => $this->value,
                'boost' => $this->boost,
            ],
        ];
    }
}
