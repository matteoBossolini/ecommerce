<?php

namespace App\Controller;

use App\Entity\Carrello;
use App\Entity\Prodotto;
use App\Entity\User;
use App\Repository\CarrelloRepository;
use App\Repository\ProdottoRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function index(ProdottoRepository $prodottoRepository, TagRepository $tagRepository): Response
    {
        $prodotti = $prodottoRepository->findAll();
        $tags = $tagRepository->findAll();
        return $this->render('home_page/index.html.twig', [
            'prodotti' => $prodotti,
            'tags' => $tags
        ]);
    }

    /**
     * @Route("/prodotto/{sku}", name="app_ecommerce_prodotto")
     * 
     * @param Prodotto $prodotto
     * @param EntityManagerInterface $em
     *
     * @return RedirectResponse
     */
    public function mostraProdotto(Prodotto $prodotto) {
        return $this->render("home_page/prodotto.html.twig", [
            "prodotto" => $prodotto
        ]);
    }
    
    /**
     * @Route("/carrello/new/{sku}", name="app_aggiungi_carrello")
     */
    public function caricaProdottoNelCarrello(Prodotto $prodotto, CarrelloRepository $carrelloRepository) {
        
        $user = $this->getUser();

        $carrello = $carrelloRepository->findOneBy([
            'idUtente' => $user
        ]);

        $carrello->addSku($prodotto);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute("app_carrello");
    }
}
