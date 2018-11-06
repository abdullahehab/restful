<?php

namespace App\Controller\article;

use App\Entity\Product;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;



class ProductController extends FOSRestController
{
    /**
     * Creates an product resource
     * @Rest\Post("/products")
     * @param Request $request
     * @return View
     */

    public function addProduct(Request $request)
    {

       $entityManager = $this->getDoctrine()->getManager();

       $product = new Product();
       $product->setName($request->get('name'));
       $product->setPrice($request->get('price'));
       $product->setDescription($request->get('description'));

       $entityManager->persist($product);
       $entityManager->flush();

        return View::create($product, Response::HTTP_CREATED , []);
    }


    /**
     * show all products
     * @return view
     * @Rest\Get("products")
     *
     */
    public function show(){

        $product = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return View::create($product, Response::HTTP_CREATED , []);
    }

    /**
     * @param $productId
     * @return view
     * @throws EntityNotFoundException
     * @Rest\Get("products/{productId}")
     */
    public function getProduct($productId){

        $product = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->find($productId);

        if (!$product){
            throw new EntityNotFoundException('Product with id '.$productId.' does not exist!');
        }

        return View::create($product, Response::HTTP_OK);
    }



    /**
     * Update products
     * @param $id
     * @param Request $request
     * @Rest\Put("/products/{productId}")
     */
    public function updateProduct($productId, Request $request){

        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Product::class)->find($productId);


        if (!$product){
            throw new EntityNotFoundException('Product with id '.$productId.' does not exist!');
        }else{
            $product->setName('testName');
            $product->setPrice(2000);
            $product->setDescription('testDescription');
            $entityManager->flush();
        }

        return View::create($product, Response::HTTP_OK);
    }

    /**
     *
     * @Rest\Delete("/products/{productId}")
     * @param $productId
     */
    public function delete($productId){

        $product = $this->getDoctrine()->getRepository(Product::class)->find($productId);
        $entityManager = $this->getDoctrine()->getManager();


        if (!$product){
            throw new EntityNotFoundException('Product with id '.$productId.' does not exist!');
        }else{
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return View::create([], Response::HTTP_NO_CONTENT);

    }


}
