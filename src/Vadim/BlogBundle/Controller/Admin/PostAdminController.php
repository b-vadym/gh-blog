<?php

namespace Vadim\BlogBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;

class PostAdminController
{
    public function listAction()
    {
        return new Response('admin_section');
    }
}
