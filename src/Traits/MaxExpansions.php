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

trait MaxExpansions
{
    /**
     * @var int
     */
	protected $maxExpansions;

    /**
     * @param int $maxExpansions
     *
     * @return self
     */
    public function maxExpansions(int $maxExpansions): self
    {
        $this->maxExpansions = $maxExpansions;

        return $this;
    }
}
