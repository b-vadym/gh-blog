<?php

namespace Vadim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Vadim\BlogBundle\Form\Type\LoginFormType;

class SecurityController extends Controller
{
    /**
     * @return Response
     */
    public function loginAction(): Response
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginFormType::class, [
            '_username' => $lastUsername,
        ]);

        return $this->render('@VadimBlog/Security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

    /**
     * @throws \RuntimeException
     */
    public function logoutAction()
    {
        throw new \RuntimeException('This should not be reached!');
    }
}
