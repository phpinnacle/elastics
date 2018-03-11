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

class ConstantScore implements Query
{
    use Traits\Boost;

    /**
     * @var Query
     */
    private $query;

    /**
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'constant_score';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'filter' => \elastics_compile($this->query),
        ];

        if ($this->boost !== null) {
            $query['boost'] = $this->boost;
        }

        return $query;
    }
}
