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

namespace PHPinnacle\Elastics\Transport;

use PHPinnacle\Elastics\Request;
use PHPinnacle\Elastics\Response;
use PHPinnacle\Elastics\Transport;

class CurlTransport implements Transport
{
    /**
     * @var array
     */
    private $options;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @param string  $url
     * @param Request $request
     *
     * @return Response
     */
    public function send(string $url, Request $request): Response
    {
        $handle = \curl_init($url);

        \curl_setopt_array($handle, \array_replace($this->options, [
            \CURLOPT_CUSTOMREQUEST  => $request->method(),
            \CURLOPT_POSTFIELDS     => $request->body(),
            \CURLOPT_HTTPHEADER     => $this->buildHeaders($request->headers()),
            \CURLOPT_HEADER         => true,
            \CURLOPT_RETURNTRANSFER => true,
        ]));

        if (!$httpResponse = \curl_exec($handle)) {
            throw new \BadMethodCallException(\curl_error($handle));
        }

        $httpHeaderSize = (int) \curl_getinfo($handle, \CURLINFO_HEADER_SIZE);
        $httpCode       = (int) \curl_getinfo($handle, \CURLINFO_HTTP_CODE);

        // @todo Parse headers
        $header = \substr($httpResponse, 0, $httpHeaderSize);
        $body   = \substr($httpResponse, $httpHeaderSize);

        return new Response($httpCode, $body, $this->parseHeaders($header));
    }

    private function buildHeaders(array $headers): array
    {
        return \array_map(function ($header, $value) {
            return sprintf('%s: %s', $header, $value);
        }, \array_keys($headers), \array_values($headers));
    }

    /**
     * @param string $headerLine
     *
     * @return array
     */
    private function parseHeaders(string $headerLine): array
    {
        return [];
    }
}
