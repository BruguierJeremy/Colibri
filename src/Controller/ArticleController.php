<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/create", name="create_article", methods={"GET", "POST"})
     */
    public function create(Request $request, ArticleRepository $articleRepository, EntityManagerInterface $entityManager): Response
    {

        /**
        * On récupère le user en session
        * @var \App\Entity\User $user
        */
        $user = $this->getUser();

        $article = new Article;
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Associe le user en session à l'article
            $article->setUser($user);
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('Succés', 'Article ajouté.');

            return $this->redirectToRoute('app_main', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/create.html.twig', compact('article', 'form'));
    }

    /**
     * @Route("/article/{id}", name="detail_article")
     */
    public function detail(Article $article, Request $request, ArticleRepository $articleRepository): Response
    {

        return $this->render('article/detail.html.twig', compact('article'));

    }
}
