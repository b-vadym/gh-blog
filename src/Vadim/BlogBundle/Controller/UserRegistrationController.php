<?php

namespace Vadim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vadim\BlogBundle\Entity\User;
use Vadim\BlogBundle\Form\Type\UserRegistrationFormType;

class UserRegistrationController extends Controller
{
    public function registrationAction(Request $request)
    {
        $form = $this->createForm(UserRegistrationFormType::class);

        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Welcome ' . $user->getEmail());

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('vadim_blog.security.login_form_authenticator'),
                    'main'
                );
        }

        return $this->render('@VadimBlog/Registration/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
