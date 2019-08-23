<?php

namespace App\Controller;

use App\Entity\DetailCommande;
use App\Form\DetailCommandeType;
use App\Repository\DetailCommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/detail/commande")
 */
class DetailCommandeController extends AbstractController
{
    /**
     * @Route("/", name="detail_commande_index", methods={"GET"})
     */
    public function index(DetailCommandeRepository $detailCommandeRepository): Response
    {
        return $this->render('detail_commande/index.html.twig', [
            'detail_commandes' => $detailCommandeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="detail_commande_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $detailCommande = new DetailCommande();
        $form = $this->createForm(DetailCommandeType::class, $detailCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detailCommande);
            $entityManager->flush();

            return $this->redirectToRoute('detail_commande_index');
        }

        return $this->render('detail_commande/new.html.twig', [
            'detail_commande' => $detailCommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detail_commande_show", methods={"GET"})
     */
    public function show(DetailCommande $detailCommande): Response
    {
        return $this->render('detail_commande/show.html.twig', [
            'detail_commande' => $detailCommande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="detail_commande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DetailCommande $detailCommande): Response
    {
        $form = $this->createForm(DetailCommandeType::class, $detailCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detail_commande_index');
        }

        return $this->render('detail_commande/edit.html.twig', [
            'detail_commande' => $detailCommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detail_commande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DetailCommande $detailCommande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detailCommande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($detailCommande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('detail_commande_index');
    }
}
