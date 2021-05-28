<?php

namespace App\Controller;

use App\Repository\OrdineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AreaUtenteController extends AbstractController
{
    /**
     * @Route("/utente", name="area_utente")
     */
    public function index(OrdineRepository $ordineRepository): Response
    {
        $utente = $this->getUser();
        $ordini = $ordineRepository->findBy(['idUtente' => $utente]);
        return $this->render('area_utente/index.html.twig', [
            'utente' => $utente,
            'ordini' => $ordini
        ]);
    }
}
