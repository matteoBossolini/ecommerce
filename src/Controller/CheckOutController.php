<?php

namespace App\Controller;

use App\Entity\Ordine;
use App\Entity\Prodotto;
use App\Form\ShippingFormType;
use App\Repository\CarrelloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckOutController extends AbstractController
{
    /**
     * @Route("/checkout/{sku}", name="checkout_prodotto")
     */
    public function compraProdotto(Prodotto $prodotto, Request $request): Response
    {
        if ($this->getUser()) {
            $prodotti = array($prodotto);

            $ordine = new Ordine();
            $form = $this->createForm(ShippingFormType::class, $ordine);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $ordine->setIdUtente($this->getUser());

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($ordine);

                $quantitaProdotto = $prodotto->getQuantita();
                $prodotto->setQuantita($quantitaProdotto-1);
                
                $ordine->addSku($prodotto);
                $this->getDoctrine()->getManager()->flush();

                return $this->render('check_out/thank_you.html.twig', [
                    'ordine' => $ordine,
                ]);
            }

            return $this->render('check_out/index.html.twig', [
                'prodotti' => $prodotti,
                'shippingForm' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute("app_login");
        }
    }

    /**
     * @Route("/checkout", name="checkout_carrello")
     */
    public function compraCarrello(CarrelloRepository $carrelloRepository, Request $request): Response
    {   
        $user = $this->getUser();

        $carrello = $carrelloRepository->findOneBy([
            'idUtente' => $user
        ]);

        $prodotti = $carrello->getSku();

        $ordine = new Ordine();
        $form = $this->createForm(ShippingFormType::class, $ordine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ordine->setIdUtente($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ordine);

            foreach ($prodotti as $prodotto) {
                $quantitaProdotto = $prodotto->getQuantita();
                $prodotto->setQuantita($quantitaProdotto-1);

                $ordine->addSku($prodotto);

                $carrello->removeSku($prodotto);
            }
            $this->getDoctrine()->getManager()->flush();
            
            return $this->render('check_out/thank_you.html.twig', [
                'ordine' => $ordine,
            ]);
        }

        return $this->render('check_out/index.html.twig', [
            'prodotti' => $prodotti,
            'shippingForm' => $form->createView()
        ]);
    }
}
