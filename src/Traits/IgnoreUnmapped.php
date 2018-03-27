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

trait IgnoreUnmapped
{
    /**
     * @var bool
     */
    private $ignoreUnmapped;

    /**
     * @param bool $value
     *
     * @return self
     */
    public function ignoreUnmapped(bool $value): self
    {
        $this->ignoreUnmapped = $value;

        return $this;
    }
}
