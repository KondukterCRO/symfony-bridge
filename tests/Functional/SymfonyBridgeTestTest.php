<?php
/**
 * (c) Ivan Veštić
 * http://ivanvestic.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Functional;

use PHPUnit\Framework\TestCase;
use Tests\Functional\Fixtures\SymfonyBridgeWrapper;

/**
 *
 */
class SymfonyBridgeTestTest extends TestCase
{

    /**
     *
     */
    public function testTestNoDebugContainer()
    {
        /** @var SymfonyBridgeWrapper $symfonyBridge */
        $symfonyBridge = SymfonyBridgeWrapper::getInstance('test', false);

        $this->assertInstanceOf(\FixturesTestProjectContainer::class, $symfonyBridge->getContainer());

        // unset
        $symfonyBridge->unsetInstance();
    }

}