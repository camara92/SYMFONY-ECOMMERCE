<?php
namespace App\Filtrer;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart{
    private $session;
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session){
        $this->session= $session;
        $this->entityManager= $entityManager;
    }
    public function  add($id){
        $cart=$this->session->get('cart', []);
        if(!empty($cart[$id])){
            //ajouter
            $cart[$id]++;
        }else{
            $cart[$id] =1;
        }
        $this->session->set('cart', $cart);
    }
    public function get(){
      return $this->session->get('cart');
}
    public function remove(){
        return $this->session->remove('cart');
    }public function  delete($id){
    $cart = $this->session->get('cart', []);
    unset($cart[$id]);
    return $this->session->set('cart', $cart);
}
public function decrease($id){
        //vérifer si la quantité n'est pa ségale à 1
    $cart=$this->session->get('cart', []);
    if($cart[$id]>1){
        //retirer une quantité
        $cart[$id]--;
    }else
    {
        //suppression une quanitté
        unset($cart[$id]);
    }
    return $this->session->set('cart', $cart);
    }
    public function getFull(){
        $cartComplete = [];
        if($this->get()) {
            foreach ($this->get() as $id => $quantity) {
                $product_object = $this->entityManager->getRepository(Product::class)->findOneById(['id' => $id]);
                if(!$product_object){
                    //le produit n'existe pas donc il faut supprimer la donnée rentrée
                    $this->delete($id);
                    //une fois supprimée il faut continuer
                    continue;
                }

                $cartComplete[] = [
                    'product' => $product_object,
                    'quantity' => $quantity
                ];
            }

        }return $cartComplete;
    }

}