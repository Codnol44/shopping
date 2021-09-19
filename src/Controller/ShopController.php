<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Form\ShoppingType;
use ContainerV0YikgD\getShopRepositoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route(path="/shop/create", name="shop_create", methods={"GET", "POST"})
     */
    public function create(EntityManagerInterface $entityManager, Request $request)
    {
        $shop = new Shop();
        $shopform = $this->createForm(ShoppingType::class, $shop);
        $shopform->handleRequest($request);

        if($shopform->isSubmitted()){
            //Enregistrer les données en BDD
            $entityManager->persist($shop);
            $entityManager->flush();

            //Message de validation
            $this->addFlash('success', 'Cet élément a bien été ajouté à la liste !');
            return $this->redirectToRoute('shop_detail', ['id' => $shop->getId()]);
        }

        return $this->render('shop/create.html.twig', ['shopForm' => $shopform->createView()]);
    }

    /**
     * @Route(path="/shop/delete{id}", requirements={"id":"\d+"}, name="shop_delete", methods={"GET"})
     */
    public function delete(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $shop= $entityManager->getRepository('App:Shop')->find($request->get('id'));

        //Supprimer l'élément de la BDD
        $entityManager->remove($shop);
        $entityManager->flush();

        //Message de validation
        $this->addFlash('success', 'Cet élément a bien été retiré de la liste !');
        return $this->redirectToRoute('shop_shoplist');
    }

    /**
     * @Route(path="/shop/shoplist", name="shop_shoplist", methods={"GET"})
     */
    public function shoplist(Request $request, EntityManagerInterface $entityManager)
    {
        // Récupération de la page
        $page = $request->get('page', 1);

        // Récupération des shops par pagination
        $shops = $entityManager->getRepository('App:Shop')->getShopsByQB($page, 1000);

        return $this->render('shop/shoplist.html.twig', ['shops' => $shops]);
    }

    /**
     * @Route(path="/shop/detail/{id}", requirements={"id":"\d+"}, name="shop_detail", methods={"GET"})
     */
    public function detail(Request $request, EntityManagerInterface $entityManager)
    {
        // Récupération de l'identifiant
        $id = (int)$request->get('id');

        // Récupération du shop par son id
        $shop = $entityManager->getRepository('App:Shop')->findOneBy(['id' => $id]);
        if (is_null($shop)) {
            throw $this->createNotFoundException('Not Found !');
        }

        return $this->render('shop/detail.html.twig', ['shop' => $shop]);
    }

}