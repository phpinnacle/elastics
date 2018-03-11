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

class MatchAll implements Query
{
    use Traits\Boost;

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'match_all';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        return $this->boost ? [
            'boost' => $this->boost
        ] : [];
    }
}
