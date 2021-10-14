<?php

namespace App\Controller;


use App\Entity\Tech;
use App\Form\TechType;
use App\Repository\TechRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TechController extends AbstractController
{
    /**
     * @route("/tech")
     */
    public function list(TechRepository $techRepository): Response
    {
        $techs = $techRepository->findAll();

        return $this->render('tech/list.html.twig', [
            'controller_name' => 'new safe tech !',
            'Techs' => $techs,
            'TechsCount' => count($techs),
        ]);
    }

    /**
     * @Route("/tech/add")
     **/
    public function add(Request $request): Response
    {
        $isadded = false;
        $tech = new Tech();
        $tech->setRoles();

        $form = $this->createForm(TechType::class, $tech);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tech);
            $entityManager->flush();
            $isadded = true;
        }
        return $this->render('tech/add.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'new safe tech',
            'isAdded' => $isadded,
            'tech' => $tech,
        ]);
    }

    /**
     * @Route("/tech/edit/{id}", requirements={"id"="\d+"})
     */
    public function edit(int $id, Request $request, TechRepository $techRepository): Response
    {
        $isedited = false;
        $tech = $techRepository->find($id);

        try {
            if (!$tech) {
                throw new Exception('<h2>This tech does not exist</h2>');
            }
            $form = $this->createForm(TechType::class, $tech);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tech);
                $entityManager->flush();
                $isedited = true;
            }
            return $this->render('tech/edit.html.twig', [
                'tech' => $tech,
                'form' => $form->createView(),
                'isedited' => $isedited
            ]);
        } catch (Exception $e) {
            return new Response ($e->getMessage());
        }
    }

    /**
     * @Route("/tech/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete(int $id, TechRepository $techRepository): Response
    {
        $tech = $techRepository->find($id);

        try {
            if (!$tech) {
                throw new Exception('<h2>This agent does not exist</h2>');
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tech);
            $entityManager->flush();

            return $this->render('tech/delete.html.twig', [
                'tech' => $tech,
            ]);
        } catch (Exception $e) {
            return new Response ($e->getMessage());
        }
    }
}
