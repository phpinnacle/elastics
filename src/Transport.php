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

namespace PHPinnacle\Elastics;

interface Transport
{
    /**
     * @param string  $url
     * @param Request $request
     *
     * @return Response
     */
    public function send(string $url, Request $request): Response;
}
