<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Filtrer\Cart;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcountAdressController extends AbstractController
{   //enregistrement dans notre base de données
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager=$entityManager;
    }
    /**
     * @Route("/compte/adresses", name="account_address")
     */
    public function index(): Response


    {  //lors de la création de l'entité adress on a une fonction getAdress qui pemet de récupérer les adresses des utilisateurs
        //dd($this->getUser()->getAdresses);
        //dd($this->getUser());
        return $this->render('account/address.html.twig');
    }
    //suppression de acount_adress pour le mettre dans dossier acount pour la bonne gestion
    //on remplace la route /acount/Adress par /compte/adresses
    //pou rester dans le rôle user
    //ensuite on crée un ormulaire make:form pour l'ajout des adresses


    /**
     * @Route("/compte/ajouter-une-addresse", name="account_address_add")
     */
    public function add(Cart $cart, Request $request): Response


    {   $address = new Adress();
        $form=$this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $address->setUser($this->getUser());
            $this->entityManager->persist($address);
            $this->entityManager->flush();
//si adress ajoutée donc on fait une rédirection vers le compte

            //dd($address);
            if($cart->get()){
                //si il y a des produits dans panier donc on redirecte vers panier
                return $this->redirectToRoute('order');
            }else{
                return $this->redirectToRoute('account_address');
            }
        }
       return $this->render('account/address_form.html.twig',[

           'form'=>$form->createView()
       ]);
    }
    //modification et suppression des adresses
    /**
     * @Route("/compte/modifier-une-addresse/{id}", name="account_address_edit")
     */
    public function modifier(Request $request,$id): Response


    {
        //on cherche l'objet qu'on veut modifier

       // $address = new Adress();
        $address = $this->entityManager->getRepository(Adress::class)->findOneById($id);
        //vérifier si l'adresse existe
        if(!$address || $address->getUser() != $this->getUser()){


            //s'il n'existe pas on le redirige vers adresse
            //verifie egalement si l'adres est bien de celui de user
            return $this->redirectToRoute('account_address');
        }
        $form=$this->createForm(AddressType::class, $address);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $this->entityManager->flush();
//si adress ajoutée donc on fait une rédirection vers le compte
            return $this->redirectToRoute('account_address');
            //dd($address);
        }
        return $this->render('account/address_form.html.twig',[

            'form'=>$form->createView()
        ]);
    }
    //suppression
    /**
     * @Route("/compte/supprimer-une-addresse/{id}", name="account_address_delete")
     */
    public function delete($id): Response


    {
        //on cherche l'objet qu'on veut modifier

        // $address = new Adress();
        $address = $this->entityManager->getRepository(Adress::class)->findOneById($id);
        //vérifier si l'adresse existe
        if($address || $address->getUser() == $this->getUser()){
            $this->entityManager->remove($address);
            $this->entityManager->flush();
            //si adress ajoutée donc on fait une
        }
        //$form=$this->createForm(AddressType::class, $address);
        //$form->handleRequest($request);
        //if($form->isSubmitted()&& $form->isValid()){
          // rédirection vers le compte
            return $this->redirectToRoute('account_address');


    }
}
