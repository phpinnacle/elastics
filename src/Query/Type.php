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

class Type implements Query
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value = '_doc')
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'type';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        return [
            'value' => $this->value,
        ];
    }
}
