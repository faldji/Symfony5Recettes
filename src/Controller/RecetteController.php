<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecetteController
 * @package App\Controller
 */
class RecetteController extends AbstractController
{
    /**
     * @Route("/", name="recette_index", methods={"GET"})
     * @param RecetteRepository $recetteRepository
     * @return Response
     */
    public function index(RecetteRepository $recetteRepository): Response
    {
        return $this->render('recette/index.html.twig', [
            'recettes' => $recetteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/recette/new", name="recette_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $recette = new Recette();

        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('recette_index');
        }

        return $this->render('recette/new.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/recette/{id}", name="recette_show", methods={"GET"})
     * @param Recette $recette
     * @return Response
     */
    public function show(Recette $recette): Response
    {
        return $this->render('recette/show.html.twig', [
            'recette' => $recette,
        ]);
    }

    /**
     * @Route("/recette/{id}/edit", name="recette_edit", methods={"GET","POST"})
     * @param $id
     * @param Request $request
     * @param Recette $recette
     * @param RecetteRepository $recetteRepository
     * @return Response
     */
    public function edit(Request $request, Recette $recette): Response
    {
        $form = $this->createForm(RecetteType::class, $recette);
        $oldIngredient = new ArrayCollection();
        foreach ($recette->getIngredients() as $ingredient)
            $oldIngredient->add($ingredient);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($oldIngredient as $item){
                    if (!$recette->getIngredients()->contains($item))
                        $this->getDoctrine()->getManager()->remove($item);
                }
                $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('recette_index');
        }

        return $this->render('recette/edit.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/recette/drop/{id}", name="recette_delete", methods={"DELETE","GET"})
     * @param Request $request
     * @param Recette $recette
     * @return Response
     */
    public function delete(Request $request, Recette $recette): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recette->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($recette->getIngredients() as $item){
                $entityManager->remove($item);
            }
            $entityManager->remove($recette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recette_index');
    }
}
