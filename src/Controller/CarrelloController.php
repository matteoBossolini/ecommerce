<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarrelloController extends AbstractController
{
    /**
     * @Route("/carrello", name="app_carrello")
     */
    public function index(): Response
    {

        if ($this->getUser()) {
            return $this->render('carrello/index.html.twig', [
                'controller_name' => 'CarrelloController',
            ]);   
        } else {
            return $this->redirectToRoute('app_login');
        }
    }
}
