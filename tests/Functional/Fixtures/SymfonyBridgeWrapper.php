<?php

/**
 * User: ivestic
 * Date: 25/03/2017
 */

namespace Tests\Functional\Fixtures;

/**
 * Class SymfonyBridgeWrapper
 */
class SymfonyBridgeWrapper extends \SymfonyBridge
{
    /**
     *
     */
    public function unsetInstance()
    {
        self::$instance = null;
    }

}