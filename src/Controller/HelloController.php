<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//  extends AbstractController make twig file of controller
class HelloController extends AbstractController
{
    private array $messages = ['Hi', 'Hello', 'Good Morning', "bye", 'hola'];

// option you can specify how many items to be return:({limit<\d+>?3}) 

    #[Route('/{limit<\d+>?4}', name: 'app_hello')]
    public function index(int $limit): Response
    {
        // return new Response(implode(',', array_slice($this-> messages,0, $limit)));
        return $this -> render(
            'hello/index.html.twig',
            ['messages'=>  array_slice($this-> messages,0, $limit)]
        );
    }

    // /hello/{id\d+>} it means it must be integer if not return 404 error

    #[Route('/messages/{id<\d+>}', name: 'app_Show_one')]
    public function showOne($id): Response
    {
        return $this->render(
            // for every controller you have to spesify the path of its template file
           'hello/show_one.html.twig',
           ['message' => $this -> messages[$id]]

        );
    }
}
