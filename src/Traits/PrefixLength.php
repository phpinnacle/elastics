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

trait PrefixLength
{
    /**
     * @var int
     */
	protected $prefixLength;

    /**
     * @param int $prefixLength
     *
     * @return self
     */
    public function prefixLength(int $prefixLength): self
    {
        $this->prefixLength = $prefixLength;

        return $this;
    }
}
