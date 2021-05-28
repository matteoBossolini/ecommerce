<?php

namespace App\Controller;

use App\Entity\Prodotto;
use App\Repository\CarrelloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarrelloController extends AbstractController
{
    /**
     * @Route("/carrello", name="app_carrello")
     */
    public function index(CarrelloRepository $carrelloRepository): Response
    {
        if ($this->getUser()) {

            $user = $this->getUser();

            $carrello = $carrelloRepository->findOneBy([
                'idUtente' => $user
            ]);

            $prodotti = $carrello->getSku();

            return $this->render('carrello/index.html.twig', [
                'prodotti' => $prodotti,
            ]);   
        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("/carrello/rimuovi/{sku}", name="app_carrello_rimuovi")
     */
    public function rimuoviProdotto(Prodotto $prodotto ,CarrelloRepository $carrelloRepository){

        $user = $this->getUser();

        $carrello = $carrelloRepository->findOneBy([
            'idUtente' => $user
        ]);

        $carrello->removeSku($prodotto);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute("app_carrello");

    }
}
