<?php

/**
 * (c) Ivan Veštić
 * http://ivanvestic.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Functional\Fixtures\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TestController
 */
class TestController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function testAction(Request $request)
    {
        return new Response('it works');
    }
}