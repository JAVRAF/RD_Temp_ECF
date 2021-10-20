<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @route("/")
     */
    public function index(): Response
    {
        if ($this->getUser()) {
            $name = $this->getUser()->getUserIdentifier();

            return $this->render('home/index.html.twig', [
                'username' => $name,
            ]);
        }

        return $this->render('home/index.html.twig');
    }
}
