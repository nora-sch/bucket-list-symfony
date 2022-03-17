<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/wish", name="wish_")
 */
class WishController extends AbstractController
{
    /**
     * @Route("/", name="list_ideas")
     */
    public function list(WishRepository $wishRepository): Response
    {
        $ideas = $wishRepository->findBy([], ['dateCreated' => 'DESC']);
        return $this->render('wish/list.html.twig', [
        'ideas'=>$ideas
        ]);
    }
    /**
     * @Route("/detail/{id}", name="list_details")
     */
    public function wish($id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        return $this->render('wish/listDetail.html.twig', [
            "wish"=>$wish
        ]);
    }
 }
