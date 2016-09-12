<?php
/**
 * This file is part of the Totem package
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 *
 * @copyright Baptiste Clavié <clavie.b@gmail.com>
 * @license   http://www.opensource.org/licenses/MIT-License MIT License
 */

namespace Totem\Snapshot;

use Totem\Snapshot;

/**
 * Represents a snapshot of a collection
 *
 * A collection is an array of numerical indexes of array elements
 *
 * @internal
 * @author Baptiste Clavié <clavie.b@gmail.com>
 */
final class CollectionSnapshot extends Snapshot
{
    /**
     * Data mapper between the primary key and the real integer key of
     * this collection
     *
     * @var int[]
     */
    private $link;

    public function __construct($raw, array $data, array $link)
    {
        if (!is_array($raw) && !$raw instanceof Traversable) {
            throw new InvalidArgumentException(sprintf('Expected a traversable, got %s', gettype($raw)));
        }

        parent::__construct($raw, $data);

        $this->link = $link;
    }

    /** {@inheritDoc} */
    public function isComparable(Snapshot $snapshot): bool
    {
        return $snapshot instanceof CollectionSnapshot;
    }

    /**
     * Returns the original key for the primary key $primary
     *
     * @param mixed $primary Primary key to search
     *
     * @throws InvalidArgumentException primary key not found
     */
    public function getOriginalKey(string $primary): int
    {
        if (!isset($this->link[$primary])) {
            throw new InvalidArgumentException(sprintf('The primary key "%s" is not in the computed dataset', $primary));
        }

        return $this->link[$primary];
    }
}

