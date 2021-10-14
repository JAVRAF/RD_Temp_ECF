<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\AdminType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/add")
     **/
    public function add(Request $request): Response
    {
        $isadded = false;
        $admin = new Admin();
        $admin->setRoles();

        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($admin);
            $entityManager->flush();
            $isadded = true;
        }
        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
            'isAdded' => $isadded,
            'admin' => $admin,
        ]);
    }
}
