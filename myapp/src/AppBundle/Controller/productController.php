<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Produit;
use AppBundle\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


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
     * @Route("/product/create", name="create_product")
     */
    public function createproduct(Request $request)
    {
        return $this->render('activity/createproduct.html.twig');
    }

    /**
     * @Route("/product/edit/{id}/{productLabel}/{Price}/{Quantity}", name="edit_product")
     */
    public function editproduct($id, Request $request)
    {
        return $this->render('activity/editproduct.html.twig');
    }

    /**
     * @Route("/get-product/{id}", name="detail_product")
     */
    public function detailproduct($id)
    {
        $products =  $this->getDoctrine()->getManager()->getRepository('AppBundle:Produit')->findOneBy($id);
        var_dump($products);
        return $this->render('activity/detailproduct.html.twig', array('products' => $products));
    }
}
