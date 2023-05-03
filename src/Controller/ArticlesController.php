<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/articles', name: 'articles')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'articles' => $articleRepository->findAll()
        ]);
    }

    #[Route('/articles/{id}/show', name: 'articles_show', requirements: ['id' => '\d+'])]
    public function show($id, ArticleRepository $articleRepository): Response
    {
        return $this->render('/articles/show.html.twig', [
            'article' => $articleRepository->findOneById($id)
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'], priority: 2)]
    public function new(Request $request, ArticleRepository $articleRepository): Response
    {
        $article = new Article();
        $articleAdd = $this->createForm(ArticleType::class, $article);

        $articleAdd->handleRequest($request);

        if($articleAdd->isSubmitted() && $articleAdd->isValid()) {
            $articleRepository->save($article, true);
        }
        return $this->render('articles/new.html.twig', [
            'article_add' => $articleAdd->createView()
        ]);
    }

    #[Route('/{id}/update', name: 'update', methods: ['GET', 'POST'])]
    public function update(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        $articleUpdate = $this->createForm(ArticleType::class, $article);

        $articleUpdate->handleRequest($request);

        if ($articleUpdate->isSubmitted() && $articleUpdate->isValid()) {
            $articleRepository->save($article, true);
        }

        return $this->render('articles/update.html.twig', [
            'articles_update' => $articleUpdate->createView()
        ]);
    }
}