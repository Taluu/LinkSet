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

namespace Totem\Change;

use PHPUnit\Framework\TestCase;

class ModificationTest extends TestCase
{
    private $change;

    protected function setUp(): void
    {
        $this->change = new Modification('old', 'new');
    }

    public function testOld()
    {
        $this->assertSame('old', $this->change->getOld());
    }

    public function testNew()
    {
        $this->assertSame('new', $this->change->getNew());
    }
}

