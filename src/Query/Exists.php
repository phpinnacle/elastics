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

class Exists implements Query
{
    /**
     * @var string
     */
    private $field;

    /**
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'exists';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        return [
            'field' => $this->field,
        ];
    }
}
