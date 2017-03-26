<?php
/**
 * (c) Ivan Veštić
 * http://ivanvestic.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Functional;

use Symfony\Component\HttpFoundation\Request;
use Tests\Functional\Fixtures\SymfonyBridgeWrapper;

/**
 *
 */
class ProdSymfonyBridgeTest extends AbstractSymfonyBridgeTestBase
{

    /**
     * @param string|null  $name
     * @param array        $data
     * @param string       $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        self::$symfonyBridge = SymfonyBridgeWrapper::getInstance('prod', false);
    }

    /**
     *
     */
    public function testContainer()
    {
        $this->assertInstanceOf(\FixturesDevDebugProjectContainer::class, self::$symfonyBridge->getContainer());
    }

    /**
     *
     */
    public function testRequestObject()
    {
        $this->assertInstanceOf(Request::class, self::$symfonyBridge->getRequest());
    }
}