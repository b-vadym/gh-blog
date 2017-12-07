<?php

namespace Vadim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vadim\BlogBundle\Form\Type\TagType;

class TagController extends Controller
{
    public function createAction(Request $request)
    {
        $form = $this->createForm(TagType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tag = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('vadim_blog_post_list');
        }

        return $this->render('@VadimBlog/Tag/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
