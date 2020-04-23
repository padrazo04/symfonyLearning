<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Services\FileUploader;
use App\Services\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PostRepository $PostRepository
     * @return Response
     */
    public function index1(PostRepository $PostRepository)
    {
        $posts = $PostRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/createhc", name="createHardCoded")
     * @param Request $request
     * @return Response
     */
    public function createHardCoded()
    {
        $post = new Post();

        $post->setTitle('Harry Potter and the deathly hallows');
        $post->setGenre('Adventure, Fantasy');

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);

        $em->flush();

        return new Response('Post created and added to database');
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function create(Request $request, FileUploader $fileUploader, Notification $notification)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            /** @var UploadedFile $file */
            $file = $request->files->get('post')['attachment'];
            if($file) {
                $filename = $fileUploader->uploadFile($file);

                $post->setImage($filename);
                $em->persist($post);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('post.index'));
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="deleteHardCoded")
     * @param Post $post
     * @return Response
     */
    public function deleteHardCoded(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);

        $em->flush();

        $this->addFlash('success', 'Post was removed');

        return $this->redirect($this->generateUrl('post.index'));
    }
    /**
 * @Route("/show1/{id}", name="show1")
 * @param $id
 * @param PostRepository $postRepository
 * @return Response
 */
    public function show1($id, PostRepository $postRepository)
    {
        $post = $postRepository->find($id);

        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/show2/{id}", name="show2")
     * @param Post
     */
    public function show2(Post $post)
    {
        return $this->render('post/show.html.twig', [
           'post' => $post
        ]);
    }

    /**
     * @Route("/show3/{id}", name="show3")
     * @param Post
     * CUSTOM QUERY
     */
    public function show3($id, PostRepository $postRepository)
    {
        $post = $postRepository->findPostWithCategory($id);

        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }
}
