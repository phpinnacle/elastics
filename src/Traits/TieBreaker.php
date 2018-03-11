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

namespace PHPinnacle\Elastics\Traits;

trait TieBreaker
{
    /**
     * @var float
     */
    protected $tieBreaker;

    /**
     * @param float $tieBreaker
     *
     * @return self
     */
    public function tieBreaker(float $tieBreaker): self
    {
        $this->tieBreaker = $tieBreaker;

        return $this;
    }
}
