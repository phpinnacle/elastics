<?php
/*
 * This file is part of PhpStorm.
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

class DisMax implements Query
{
    use
        Traits\Boost,
        Traits\TieBreaker
    ;

    /**
     * @var Query[]
     */
    private $queries;

    /**
     * {@inheritdoc}
     */
    public function __construct(Query ...$queries)
    {
        $this->queries = $queries;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'dis_max';
    }

    /**
     * @return array
     */
    public function compile(): array
    {
        $query = [
            'queries' => \elastics_compile(...$this->queries),
        ];

        if ($this->boost !== null) {
            $query['boost'] = $this->boost;
        }

        if ($this->tieBreaker !== null) {
            $query['tie_breaker'] = $this->tieBreaker;
        }

        return $query;
    }
}
