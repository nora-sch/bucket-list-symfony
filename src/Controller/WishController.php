<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        //$ideas = $wishRepository->findBy([], ['dateCreated' => 'DESC']);
        $ideas = $wishRepository->findPublishedWishesWithCategories();
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
    /**
     * @Route("/create", name="create_wish")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $wish = new Wish();
        //$wish->setDateCreated(new \DateTime());

       $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted()&& $wishForm->isValid()){

            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Your wish "'.$wish->getTitle().'" has been added!');
            return $this->redirectToRoute('wish_list_details', ['id'=>$wish->getId()]);
        }

        return $this->render('wish/create.html.twig', [
           'wishForm'=>$wishForm->createView()
        ]);
    }
 }
