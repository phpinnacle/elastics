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

trait Boost
{
    /**
     * @var float
     */
	protected $boost;

    /**
     * @param float $boost
     *
     * @return self
     */
    public function boost(float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }
}
