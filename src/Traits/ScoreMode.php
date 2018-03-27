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

use PHPinnacle\Elastics\Exception;

trait ScoreMode
{
    /**
     * @var string
     */
    private $scoreMode;

    /**
     * @param string $mode
     *
     * @return self
     */
    public function scoreMode(string $mode): self
    {
        if (!\in_array($mode, [
            \ELASTICS_SCORE_MODE_AVG,
            \ELASTICS_SCORE_MODE_SUM,
            \ELASTICS_SCORE_MODE_MIN,
            \ELASTICS_SCORE_MODE_MAX,
            \ELASTICS_SCORE_MODE_NONE,
        ], true)) {
            throw new Exception\InvalidScoreMode($mode);
        }

        $this->scoreMode = $mode;

        return $this;
    }
}
