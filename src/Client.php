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

class Client
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $dsn
     *
     * @return self
     */
    public static function curl(string $dsn): self
    {
        return new self(new Connection($dsn, new Transport\CurlTransport()));
    }

    /**
     * @param string $index
     * @param Search $search
     *
     * @return ResultSet
     */
    public function search(string $index, Search $search): ResultSet
    {
        $response = $this->connection->send(Endpoint::search($index), Request::search($search));

        if ($response->isError()) {
            throw Exception\InternalException::forResponse($response);
        }

        return ResultSet::fromResponse($response);
    }

    public function index(string $index, Document ...$document)
    {

    }

    public function update(string $index, Document ...$document)
    {

    }

    public function delete(string $index, string ...$id)
    {

    }
}
