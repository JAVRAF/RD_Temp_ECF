<?php

namespace App\Controller;

use App\Entity\Store;
use App\Form\StoreType;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    /**
     * @route("/store")
     */
    public function list(StoreRepository $storeRepository): Response
    {
        $stores = $storeRepository->findAll();

        return $this->render('store/list.html.twig', [
            'controller_name' => 'new safe store !',
            'stores' => $stores,
            'StoresCount' => count($stores),
        ]);
    }

    /**
     * @Route("/store/add")
     **/
    public function add(Request $request): Response
    {
        $isadded = false;
        $store = new Store();
        $store->setUsername();
        $store->setRoles();

        $form = $this->createForm(StoreType::class, $store);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($store);
            $entityManager->flush();
            $store->setUsername();
            $entityManager->persist($store);
            $entityManager->flush();
            $isadded = true;
        }
        return $this->render('store/add.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'new safe store',
            'isAdded' => $isadded,
            'store' => $store,
        ]);
    }

    /**
     * @Route("/store/edit/{id}", requirements={"id"="\d+"})
     */
    public function edit(int $id, Request $request, StoreRepository $storeRepository): Response
    {
        $isedited = false;
        $store = $storeRepository->find($id);

        try {
            if (!$store) {
                throw new Exception('<h2>This store does not exist</h2>');
            }
            $form = $this->createForm(StoreType::class, $store);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($store);
                $entityManager->flush();
                $isedited = true;
            }
            return $this->render('store/edit.html.twig', [
                'store' => $store,
                'form' => $form->createView(),
                'isedited' => $isedited
            ]);
        } catch (Exception $e) {
            return new Response ($e->getMessage());
        }
    }

    /**
     * @Route("/store/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete(int $id, StoreRepository $storeRepository): Response
    {
        $store = $storeRepository->find($id);

        try {
            if (!$store) {
                throw new Exception('<h2>This agent does not exist</h2>');
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($store);
            $entityManager->flush();

            return $this->render('store/delete.html.twig', [
                'store' => $store,
            ]);
        } catch (Exception $e) {
            return new Response ($e->getMessage());
        }
    }
}
