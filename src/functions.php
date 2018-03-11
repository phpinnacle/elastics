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

use PHPinnacle\Elastics\Query;

/**
 * @param Query[] ...$queries
 *
 * @return array
 */
function elastics_compile(Query ...$queries): array
{
    $list = \array_map(function (Query $query) {
        return [
            $query->name() => $query->compile(),
        ];
    }, $queries);

    return \count($list) === 1 ? current($list) : $list;
}

/**
 * @param mixed $value
 * @param bool  $pretty
 *
 * @return string
 */
function elastics_encode($value, bool $pretty = false): string
{
    $flags = \JSON_BIGINT_AS_STRING | \JSON_UNESCAPED_UNICODE;

    if ($pretty) {
        $flags |= \JSON_PRETTY_PRINT;
    }

    $encoded = \json_encode($value, $flags);

    if ($encoded === false && $value !== false) {
        throw new \InvalidArgumentException(\json_last_error_msg());
    }

    return $encoded;
}
