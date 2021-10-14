<?php

namespace App\Controller;

use App\Entity\CoolingChamber;
use App\Form\CoolingChamberType;
use App\Repository\CoolingChamberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoolingChamberController extends AbstractController
{
    /**
     * @route("/chamber")
     */
    public function list(CoolingChamberRepository $coolingChamberRepository): Response
    {
        $chambers = $coolingChamberRepository->findAll();

        return $this->render('cooling_chamber/list.html.twig', [
            'chambers' => $chambers,
            'chambersCount' => count($chambers),
        ]);
    }

    /**
     * @Route("/chamber/add")
     **/
    public function add(Request $request): Response
    {
        $isadded = false;
        $chamber = new CoolingChamber();
        $chamber->setTempProbe();
        $chamber->setHygroProbe();

        $form = $this->createForm(CoolingChamberType::class, $chamber);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chamber);
            $entityManager->flush();
            $chamber->setTempProbe();
            $chamber->setHygroProbe();
            $entityManager->persist($chamber);
            $entityManager->flush();
            $isadded = true;
        }
        return $this->render('cooling_chamber/add.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'new safe chamber',
            'isAdded' => $isadded,
            'chamber' => $chamber,
        ]);
    }

    /**
     * @Route("/chamber/edit/{id}", requirements={"id"="\d+"})
     */
    public function edit(int $id, Request $request, CoolingChamberRepository $coolingChamberRepository): Response
    {
        $isedited = false;
        $chamber = $coolingChamberRepository->find($id);

        try {
            if (!$chamber) {
                throw new Exception('<h2>This cooling chamber does not exist</h2>');
            }
            $form = $this->createForm(CoolingChamberType::class, $chamber);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($chamber);
                $entityManager->flush();
                $isedited = true;
            }
            return $this->render('cooling_chamber/edit.html.twig', [
                'chamber' => $chamber,
                'form' => $form->createView(),
                'isedited' => $isedited
            ]);
        } catch (Exception $e) {
            return new Response ($e->getMessage());
        }
    }

    /**
     * @Route("/chamber/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete(int $id, CoolingChamberRepository $coolingChamberRepository): Response
    {
        $chamber = $coolingChamberRepository->find($id);

        try {
            if (!$chamber) {
                throw new Exception('<h2>This cooling chamber does not exist</h2>');
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chamber);
            $entityManager->flush();

            return $this->render('cooling_chamber/delete.html.twig', [
                'chamber' => $chamber,
            ]);
        } catch (Exception $e) {
            return new Response ($e->getMessage());
        }
    }
}
