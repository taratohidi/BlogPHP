<?php

namespace App\Controller;

use App\Entity\Comment;
use DateTime;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Form\MicroPostType;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    // Pass MicroPostRepository class as parameter to index for managing data index(MicroPostRepository $posts)
    public function index(MicroPostRepository $posts): Response
    {
        // dd($posts->findAll());
        // dd($posts->find(id));
        // dd($posts->findOneBy(['title' => 'Welcome to Iran']));
        // dd($posts->findBy(['title' => 'Welcome to Iran'])) #find more than one;

        // $microPost = new MicroPost();
        // $microPost->setTitle(' Save from repository!');
        // $microPost->setText('controler Data');
        // $microPost->setCreated(new DateTime());

        
        // $microPost = $posts->find(3);
        // $posts->remove($microPost, true);

        // $posts->save($microPost, true);
        // $posts->add($microPost, true); same as save

        
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts-> findAll(),
        ]);
    }

    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(MicroPost $post): Response
    {
       
        return $this->render('micro_post/showOne.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
    public function addPost(Request $request, MicroPostRepository $posts): Response
    {
    //   $microPost = new MicroPost();
      $form = $this->createForm(MicroPostType::class, new MicroPost());
      $form -> handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setCreated(new DateTime());
            $posts->add($post, true);

            // Add flash message
            $this->addFlash(
               'success',
               'Your micro post have been addded.'
            );

            // Redirect
            return $this->redirectToRoute('app_micro_post');
            
        }

        return $this -> renderForm(
            'micro_post/addPost.html.twig',
            ['form' => $form]);
       
    }

    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit')]
    public function editPost(MicroPost $post, Request $request, MicroPostRepository $posts): Response
    {
        $form = $this->createForm(MicroPostType::class, $post);
        $form -> handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $posts->add($post, true);

            // Add flash message
            $this->addFlash(
               'success',
               'Your micro post have been updated.'
            );

            // Redirect
            return $this->redirectToRoute('app_micro_post');
            
        }

        return $this -> renderForm(
            'micro_post/edit.html.twig',
            ['form' => $form,
             'post'=> $post]);
       
    }

    #[Route('/micro-post/{post}/comment', name: 'app_micro_post_comment')]
    // #[IsGranted('ROLE_COMMENTER')]
    public function addComment(
        MicroPost $post,
        Request $request,
        CommentRepository $comments
    ): Response {
        $form = $this->createForm(
            CommentType::class,
            new Comment()
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setPost($post);
            // $comment->setAuthor($this->getUser());
            $comments->add($comment, true);

            // Add a flash
            $this->addFlash(
                'success',
                'Your comment have been updated.'
            );

            return $this->redirectToRoute(
                'app_micro_post_show',
                ['post' => $post->getId()]
            );
            // Redirect
        }

        return $this->renderForm(
            'micro_post/comment.html.twig',
            [
                'form' => $form,
                'post' => $post
            ]
        );
    }


}