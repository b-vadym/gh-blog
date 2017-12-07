<?php

namespace Vadim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vadim\BlogBundle\Entity\Post;
use Vadim\BlogBundle\Form\Type\PostType;

class PostController extends Controller
{
    use KnpPaginationControllerTrait;

    /**
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request): Response
    {
        $postRepository = $this->getDoctrine()->getRepository(Post::class);
        $query = $postRepository->findPublishedQuery();
        $pagination = $this->knpPaginate($request, $query, 10);

        return $this->render('@VadimBlog/Post/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('vadim_blog_post_show', [
                'id' => $post->getId(),
            ]);
        }

        return $this->render('@VadimBlog/Post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Post $post
     * @return Response
     */
    public function showAction(Post $post): Response
    {
        return $this->render('@VadimBlog/Post/show.html.twig', [
            'post' => $post,
        ]);
    }
}
