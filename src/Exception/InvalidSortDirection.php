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

class InvalidSortDirection extends ElasticsException
{
    /**
     * @param string $sort
     */
    public function __construct(string $sort)
    {
        parent::__construct(\sprintf('Invalid sort direction! Expected: "all", "none". Got: "%s".', $sort));
    }
}
