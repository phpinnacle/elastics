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

trait Fuzzy
{
    use
        Boost,
        MaxExpansions,
        PrefixLength
    ;

    /**
     * @var string
     */
    protected $fuzziness;

    /**
     * @var Boolean
     */
    protected $transpositions;

    /**
     * @param string $fuzziness
     *
     * @return self
     */
    public function fuzziness(string $fuzziness): self
    {
        $this->fuzziness = $fuzziness;

        return $this;
    }

    /**
     * @param Boolean $transpositions
     *
     * @return self
     */
    public function transpositions(bool $transpositions): self
    {
        $this->transpositions = $transpositions;

        return $this;
    }
}
