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

namespace PHPinnacle\Elastics\Exception;

class InvalidZeroTerms extends ElasticsException
{
    /**
     * @param string $zeroTerms
     */
    public function __construct(string $zeroTerms)
    {
        parent::__construct(\sprintf('Invalid zero terms! Expected: "all", "none". Got: "%s".', $zeroTerms));
    }
}
