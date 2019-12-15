<?php

namespace App\Controller;

use App\Message\SmsNotification;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    /**
     * @Route("/book", name="book")
     */
    public function index()
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    /**
     * @Route("/ping", name="book_ping", methods={"POST"})
     */
    public function __invoke(MessageBusInterface $bus, Request $request) : Response
    {

        $update = new Update('http://monsite.fr/ping', json_encode(['status'=>'Test']));

        $bus->dispatch($update);

        return new Response("success");
    }
}
