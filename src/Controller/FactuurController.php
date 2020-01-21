<?php

namespace App\Controller;

use App\Entity\Bestelling;
use App\Entity\Factuur;
use App\Entity\Gerecht;
use App\Form\FactuurType;
use App\Repository\BestellingRepository;
use App\Repository\FactuurRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/factuur")
 */
class FactuurController extends AbstractController
{
    /**
     * @Route("/", name="factuur_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(FactuurRepository $factuurRepository): Response
    {
        return $this->render('factuur/index.html.twig', [
            'factuurs' => $factuurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="factuur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $factuur = new Factuur();
        $form = $this->createForm(FactuurType::class, $factuur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($factuur);
            $entityManager->flush();

            return $this->redirectToRoute('factuur_index');
        }

        return $this->render('factuur/new.html.twig', [
            'factuur' => $factuur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="factuur_show", methods={"GET"})
     */
    public function show(Factuur $factuur, BestellingRepository $bestellingRepository): Response
    {
        $bestellingen = $factuur->getBestelling();
        $Aantallen = [];
        $Bestellingen = [];

        foreach ($bestellingen as $bestelling) {
            $gerecht = $bestelling->getGerecht();

            if (isset($Aantallen[$gerecht->getId()])) {
                $Aantallen[$gerecht->getId()]["Aantal"]++;
            } else {
                array_push($Bestellingen, $bestelling);
                $Aantallen[$gerecht->getId()] = ["Aantal" => 1];
            }
        }

        return $this->render('factuur/show.html.twig', [
            'factuur'  => $factuur,
            'Bestellingen' => $Bestellingen,
            'Aantallen' => $Aantallen
        ]);
    }

    /**
     * @Route("/{id}/edit", name="factuur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Factuur $factuur): Response
    {
        $form = $this->createForm(FactuurType::class, $factuur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('factuur_index');
        }

        return $this->render('factuur/edit.html.twig', [
            'factuur' => $factuur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="factuur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Factuur $factuur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$factuur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($factuur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('factuur_index');
    }
}
