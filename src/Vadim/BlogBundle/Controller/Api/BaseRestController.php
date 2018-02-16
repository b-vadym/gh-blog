<?php

namespace Vadim\BlogBundle\Controller\Api;

use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class BaseRestController extends FOSRestController
{
    /**
     * @param null $data
     * @param null $statusCode
     * @param array $headers
     * @param array $serializationGroups
     * @return View
     */
    protected function view($data = null, $statusCode = null, array $headers = [], $serializationGroups = [])
    {
        $view = View::create($data, $statusCode, $headers);

        if ($serializationGroups) {
            $view->setContext((new Context())->setGroups($serializationGroups));
        }

        return $view;
    }

}
