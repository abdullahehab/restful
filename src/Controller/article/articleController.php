<?php
/**
 * Created by PhpStorm.
 * User: abdullahehab
 * Date: 11/6/18
 * Time: 2:23 PM
 */

namespace App\Controller\article;


use App\Entity\Article;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;


class articleController extends FOSRestController
{
    /**
     * Creates an Article resource
     * @Rest\Post("/articles")
     * @param Request $request
     * @return View
     */

    public function addAction(Request $request){

        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();

        $article->setName($request->get('name'));
        $article->setDescription($request->get('description'));
        $entityManager->persist($article);
        $entityManager->flush();

        return View::create($article, Response::HTTP_CREATED , []);

    }


    /**
     * Lists all Articles.
     * @Rest\Get("/articles")
     */

    public function show()
    {
        $rep = $this->getDoctrine()->getRepository(Article::class);
        $articles = $rep->findAll();

        return View::create($articles, Response::HTTP_OK , []);
    }


    /**
     * show specific Article
     * @param $articleId
     * @return View
     * @Rest\Get("/articles/{articleId}")
     */

    public function getArticle($articleId){ /* There is an error*/

        $article = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->find($articleId);

        if (!$article){
            throw new EntityNotFoundException('Article with id '.$articleId.' does not exist!');
        }

        return View::create($article, Response::HTTP_OK);
    }


    /**
     * Update Article
     * @param $articleId
     * @param Request $request
     * @Rest\Put("/articles/{articleId}")
     */
    public function updateArticle($articleId, Request $request){

        $entityManager = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($articleId);


        if (!$article){
            throw new EntityNotFoundException('Article with id '.$articleId.' does not exist!');
        }else{
            $article->setName('test5');
            $article->setDescription('description5');
            $entityManager->flush();
        }

        return View::create($article, Response::HTTP_OK);
    }

    /**
     *
     * @Rest\Delete("/articles/{articleId}")
     * @param $articleId
     *
     *
     */
    public function delete($articleId){

        $article = $this->getDoctrine()->getRepository(Article::class)->find($articleId);
        $entityManager = $this->getDoctrine()->getManager();


        if (!$article){
            throw new EntityNotFoundException('Article with id '.$articleId.' does not exist!');
        }else{
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return View::create([], Response::HTTP_NO_CONTENT);

    }

}

