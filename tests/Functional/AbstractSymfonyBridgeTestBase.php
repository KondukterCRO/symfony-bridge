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

/**
 *
 */
abstract class AbstractSymfonyBridgeTestBase extends TestCase
{
    /** @var \Tests\Functional\Fixtures\SymfonyBridgeWrapper $symfonyBridge */
    protected static $symfonyBridge;

    /**
     * test-case: AppKernel environment specific container
     */
    abstract public function testContainer();

    /**
     * test-case: \Symfony\Component\HttpFoundation\Request
     */
    abstract public function testRequestObject();

    /**
     * tear down after each child test class has finished running
     */
    public static function tearDownAfterClass()
    {
        // unset
        self::$symfonyBridge->unsetInstance();
    }
}