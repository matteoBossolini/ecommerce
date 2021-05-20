<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AreaUtenteController extends AbstractController
{
    /**
     * @Route("/utente", name="area_utente")
     */
    public function index(): Response
    {
        $utente = $this->getUser();
        return $this->render('area_utente/index.html.twig', [
            'utente' => $utente
        ]);
    }
}
