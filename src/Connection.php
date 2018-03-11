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

class Connection
{
    /**
     * @var string
     */
    private $dsn;

    /**
     * @var Transport
     */
    private $transport;

    /**
     * @param string    $dsn
     * @param Transport $transport
     */
    public function __construct(string $dsn, Transport $transport)
    {
        $this->dsn       = $dsn;
        $this->transport = $transport;
    }

    /**
     * @param Endpoint $endpoint
     * @param Request  $request
     *
     * @return Response
     */
    public function send(Endpoint $endpoint, Request $request): Response
    {
        return $this->transport->send($endpoint->url($this->dsn), $request);
    }
}
