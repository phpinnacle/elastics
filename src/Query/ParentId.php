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

class ParentId implements Query
{
    use Traits\IgnoreUnmapped;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $id;

    /**
     * @param string $type
     * @param string $id
     */
    public function __construct(string $type, string $id)
    {
        $this->type  = $type;
        $this->id    = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'parent_id';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'type' => $this->type,
            'id'   => $this->id,
        ];

        if ($this->ignoreUnmapped !== null) {
            $query['ignore_unmapped'] = $this->ignoreUnmapped;
        }

        return $query;
    }
}
