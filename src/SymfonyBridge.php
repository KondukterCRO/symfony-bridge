<?php
/**
 *
 * SymfonyBridge
 *
 * (c) Ivan Veštić
 * http://ivanvestic.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SymfonyBridge
 */
class SymfonyBridge
{
    /** @var SymfonyBridge $instance */
    protected static $instance;

    /** @var Container $container */
    private static $container;

    /** @var array */
    private static $environments = ['prod', 'test', 'dev'];


    /**
     * SymfonyBridge constructor.
     */
    private function __construct()
    {
        // nothing to do here
    }

    /**
     * @param string|null $_env
     * @param bool        $_debug
     *
     * @return SymfonyBridge
     */
    final public static function getInstance(string $_env = null, bool $_debug = false)
    {
        // Singleton
        if (null !== self::$instance) {
            return self::$instance;
        }

        // Environment and Debug params, default ('test', false)
        $env   = ((in_array($_env, self::$environments)) ? $_env : ((false !== getenv('SYMFONY_ENV')) ? getenv('SYMFONY_ENV') : null));
        $debug = ((in_array($_debug, [true, false])) ? $_debug : ((false !== getenv('SYMFONY_DEBUG')) ? getenv('SYMFONY_DEBUG') : false));

        if (null == $env || !in_array($env, self::$environments)) {
            trigger_error("unable to determine environment {$env}", E_USER_ERROR);
            return null;
        }

        // instantiate kernel
        $kernel = new \AppKernel($env, $debug);
        // boot the kernel
        $kernel->boot();

        // create the Request object
        $request = Request::createFromGlobals();

        // at this point the RequestStack->requests is empty
        // push a copy of the Request to the RequestStack, so it can be accessed later
        $kernel->getContainer()->get('request_stack')->push($request);

        // save container
        self::$container = $kernel->getContainer();

        // save SymfonyBridge self instance
        self::$instance = new static();

        return self::$instance;
    }

    /**
     * @return Container|ContainerInterface|null
     */
    final public function getContainer()
    {
        return self::$container;
    }

    /**
     * @return object|\Symfony\Component\HttpFoundation\RequestStack
     */
    final public function getRequestStack()
    {
        return self::$container->get('request_stack');
    }

    /**
     * @return Request|null
     */
    final public function getRequest()
    {
        return self::$container->get('request_stack')->getCurrentRequest();
    }
}