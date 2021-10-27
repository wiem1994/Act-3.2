<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Produit;
use AppBundle\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class productController extends Controller
{
    /**
     * @Route("/get-all-products", name="product")
     */
    public function listproducts()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Produit')->findAll();
        return $this->render('activity/product.html.twig', array('products' => $products));
    }

    /**
     * @Route("/product/create/{productLabel}/{price}/{quantity}", name="create_product")
     */
    public function createproduct($productLabel, $price, $quantity)

    {
        $product = new Produit();



        $product->setproductLabel($productLabel);



        $product->setPrice($price);



        $product->setQuantity($quantity);



        $entityManager = $this->getDoctrine()->getManager();



        $entityManager->persist($product);



        $entityManager->flush();



        return new Response('saved product n ' . $product->getId());
    }

    /**
     * @Route("/product/edit/{id}/{productLabel}/{price}/{quantity}", name="edit_product")
     */
    public function editproduct($id, $productLabel, $price, $quantity)
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository('AppBundle:Produit')->find($id);

        $product->setProductLabel($productLabel);

        $product->setPrice($price);

        $product->setQuantity($quantity);

        $em->flush();
        return new Response($product->getId());

        //        return $this->render('activity/editproduct.html.twig');
    }
    /**
     * @Route("/get-product/{id}", name="detail_product")
     */
    public function detailproduct($id)
    {
        $products =  $this->getDoctrine()->getManager()->getRepository('AppBundle:Produit')->find($id);
        var_dump($products);
        return $this->render('activity/detailproduct.html.twig', array('products' => $products));
    }
}
