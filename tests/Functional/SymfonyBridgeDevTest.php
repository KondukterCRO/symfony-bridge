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
class SymfonyBridgeDevTest extends TestCase
{

    /**
     *
     */
    public function testDevNoDebugContainer()
    {
        /** @var SymfonyBridgeWrapper $symfonyBridge */
        $symfonyBridge = SymfonyBridgeWrapper::getInstance('dev', false);

        $this->assertInstanceOf(\FixturesDevProjectContainer::class, $symfonyBridge->getContainer());

        // unset
        $symfonyBridge->unsetInstance();
    }

}