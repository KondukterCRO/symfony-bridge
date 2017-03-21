<?php
/**
 *
 * SymfonyBridge
 *
 * (c) Ivan Veštić
 * http://ivanvestic.com
 *
 * Date: 21/03/2017
 * Time: 01:47
 */

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SymfonyBridge
 */
class SymfonyBridge
{

    /** __construct call count */
    private static $__c = 0;

    /** @var SymfonyBridge $instance */
    private static $instance;

    /** @var Container $container */
    private static $container;

    /** @var array */
    private static $environments = ['prod', 'test', 'dev'];


    /**
     * SymfonyBridge constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        // Singleton
        if (self::$__c++ > 0) {
            return;
        }

        self::$container = $container;
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
        if (null != self::$instance) {
            return self::$instance;
        }

        // Environment and Debug params, default ('test', false)
        $env   = ((in_array($_env, self::$environments)) ? $_env : ((false !== getenv('SYMFONY_ENV')) ? getenv('SYMFONY_ENV') : null));
        $debug = ((in_array($_debug, [true, false])) ? $_debug : ((false !== getenv('SYMFONY_DEBUG')) ? getenv('SYMFONY_DEBUG') : false));

        if (null == $env || !in_array($env, self::$environments)) {
            trigger_error("unable to determine environment {$env}", E_USER_ERROR);
            return null;
        }

        $kernel = new \AppKernel($env, $debug);
        $request = Request::createFromGlobals();
        $kernel->handle($request);
        $kernel->boot();

        // store self instance into a static self::$instance
        self::$instance = new self($kernel->getContainer());

        return self::$instance;
    }

    /**
     * @return Container|ContainerInterface|null
     */
    final public static function getContainer()
    {
        return self::$container;
    }

    /**
     * @return object|\Symfony\Component\HttpFoundation\RequestStack
     */
    final public static function getRequestStack()
    {
        return self::$container->get('request_stack');
    }
}