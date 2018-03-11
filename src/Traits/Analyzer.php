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

trait Analyzer
{
    /**
     * @var string
     */
    protected $analyzer;

    /**
     * @param string $analyzer
     *
     * @return self
     */
    public function analyzer(string $analyzer): self
    {
        $this->analyzer = $analyzer;

        return $this;
    }
}
