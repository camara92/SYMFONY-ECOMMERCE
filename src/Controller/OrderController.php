<?php

namespace App\Controller;

use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/commande", name="order")
     */
    public function index(): Response
    {   //vérifier si l'user a une adresse dans son compte ?
        //debuguer dessous

        if(!$this->getUser()->getAdresses()->getValues()){
            return $this->redirectToRoute('account_address_add');
        }
        $form= $this->createForm(OrderType::class, null, [
            'user'=>$this->getUser()
        ]);

        return $this->render('order/index.html.twig', [
            'form'=>$form->createView()
        ]);

    }
}
