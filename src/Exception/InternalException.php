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

use PHPinnacle\Elastics\Response;

abstract class InternalException extends ElasticsException
{
    /**
     * @param Response $response
     *
     * @return self
     */
    public static function forResponse(Response $response): self
    {
        $payload = \elastics_decode($response->body());

        switch ($response->status()) {
            case 400:
            case 404:
                return self::clientException($payload['error']);
            case 406:
                return new NotAcceptable($payload['error']);
            default:
                var_dump($payload);exit();
        }
    }

    /**
     * @param array $error
     *
     * @return self
     */
    private static function clientException(array $error): self
    {
        switch ($error['type']) {
            case 'illegal_argument_exception':
                return new IllegalArgument($error['reason']);
            case 'index_not_found_exception':
                return new IndexNotFound($error['index']);
            default:
                var_dump($error);exit();
        }
    }
}
