<?php

namespace Vadim\BlogBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vadim\BlogBundle\Entity\Post;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class PostController extends BaseRestController
{
    /**
     * @param $id
     *
     * Get post by id
     * @SWG\Response(
     *     response=200,
     *     description="Return post",
     *     @Model(type=Post::class, groups={"full"})
     * )
     * @SWG\Parameter(
     *     in="path",
     *     name="id",
     *     description="Post id",
     *     required=true,
     *     type="integer",
     * )
     * @SWG\Tag(name="posts")
     */
    public function getPostAction(int $id)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

        if (!$post) {
            throw $this->createNotFoundException(sprintf('Post with id "%s" is not found', $id));
        }

        return $this->view($post, null, [], [
            'full'
        ]);
    }

    /**
     * @param int $id
     * Get post by id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     * @throws \LogicException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Symfony\Component\Serializer\Exception\NotEncodableValueException
     * @SWG\Parameter(
     *     in="body",
     *     name="Post",
     *     description="Post data",
     *     required=true,
     *     type="object",
     *     @Model(type=Post::class, groups={"full"}),
     * )
     * @SWG\Parameter(
     *     in="path",
     *     name="id",
     *     description="Post id",
     *     required=true,
     *     type="integer",
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Return if update succesfull",
     *     @Model(type=Post::class, groups={"full"})
     * )
     * @SWG\Tag(name="posts")
     */
    public function putPostAction(int $id, Request $request)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

        if (!$post) {
            throw $this->createNotFoundException(sprintf('Post with id "%s" is not found', $id));
        }

        $this->get('serializer')->deserialize($request->getContent(), Post::class, 'json', [
            'object_to_populate' => $post
        ]);

        $violationsList = $this->get('validator')->validate($post);

        if (count($violationsList) !== 0) {
            return $this->view($post, Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->view($post, null, [], [
            'full'
        ]);
    }
}
