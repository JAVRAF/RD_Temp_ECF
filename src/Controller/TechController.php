<?php

namespace App\Controller;


use App\Entity\Tech;
use App\Form\TechEditType;
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

    /**
     * @Route("/changepassword")
     */
    public function change(TechRepository $techRepository, Request $request): Response
    {
        $user = $this->getUser()->getid();
        $isedited = false;
        $tech = $techRepository->find($user);

        try {
            if (!$tech) {
                throw new Exception('<h2>This tech does not exist</h2>');
            }
            $form = $this->createForm(TechEditType::class, $tech);
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
     * @Route("/import")
     */
    public function import(): Response
    {
        $isuploaded = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_FILES["text"]) && $_FILES["text"]["error"] == 0) {
                $allowed = array("csv" => "application/vnd.ms-excel");
                $filename = $_FILES["text"]["name"];
                $filetype = $_FILES["text"]["type"];
                $filesize = $_FILES["text"]["size"];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)) die("Error : wrong format.");

                $maxsize = 10 * 1024 * 1024;
                if ($filesize > $maxsize) die("Error: file size exceeded.");

                if (in_array($filetype, $allowed)) {

                    if (file_exists($_FILES["text"]["tmp_name"] . $filename)) {
                        $isuploaded = "error: " . $filename . " already exists.";
                    } else {
//                        move_uploaded_file($_FILES["text"]["tmp_name"], "rd-temp/public/csv/" . $filename);

                        $con = mysqli_connect('c8u4r7fp8i8qaniw.chr7pe7iynqr.eu-west-1.rds.amazonaws.com', 'kr3x31eyuu2mj853', 'putibko55spih8zd', 'j8knpia3omrkra47');
                        if (!$con) {
                            die('Could not connect: ' . mysqli_error($con));
                        } else {
                            mysqli_select_db($con, "rdtemp_db");

                            $sql = "LOAD DATA INFILE '".$_FILES["text"]["tmp_name"] . $filename . "' INTO TABLE probe_data FIELDS TERMINATED BY ',' LINES TERMINATED BY '\\n' IGNORE 1 ROWS;";

                            mysqli_query($con, $sql);

                            $isuploaded = 'Upload successful !';
                        }
                    }
                } else {
                    $isuploaded = 'error : ' . $filename . ' is not a CSV file.';
                }
            } else {
                $isuploaded = 'Error : File was not uploaded to the server correctly';
            }
        }
        return $this->render('tech/import.html.twig', [
            'isuploaded' => $isuploaded
        ]);
    }
}
