<?php

namespace App\Controller;

use DateTime;
use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
