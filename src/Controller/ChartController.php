<?php

namespace App\Controller;

use App\Repository\CoolingChamberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    /**
     * @route("/chart")
     */
    public function chart(CoolingChamberRepository $coolingChamberRepository): Response
    {
        $id = $this->getUser()->getid();
        $chambers = $coolingChamberRepository->findBystore($id);

        return $this->render('chart/chart.html.twig', [
            'chambers' => $chambers

        ]);
    }

    /**
     * @route("/displaychart")
     */
    public function showchart(): Response
    {
        $q = $_GET['date'];
        list($tp, $hp) = explode(",", $_GET['probe'], 2);

        $con = mysqli_connect('127.0.0.1:3306', 'root', '', 'rdtemp_db');
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }

        mysqli_select_db($con, "rdtemp_db");
        $temp = "SELECT * FROM probe_data WHERE date >= '" . $q . "' AND date < ADDDATE('" . $q . "', INTERVAL 1 DAY) and probe = '" . $tp . "' ORDER BY date ASC;";
        $hygro = "SELECT * FROM probe_data WHERE date >= '" . $q . "' AND date < ADDDATE('" . $q . "', INTERVAL 1 DAY)and probe = '" . $hp . "' ORDER BY date ASC;";
        $tempresult = mysqli_query($con, $temp);
        $hygroresult = mysqli_query($con, $hygro);

        $tempvalue = array();
        $hygrovalue = array();
        if ($tempresult) {
            $tempdata = mysqli_fetch_all($tempresult);
            foreach ($tempdata as $val) {
                array_push($tempvalue, (integer)$val[3]);
            }
        }
        if ($hygroresult) {
            $hygrodata = mysqli_fetch_all($hygroresult);
            foreach ($hygrodata as $val) {
                array_push($hygrovalue, (integer)$val[3]);
            }
        }
        mysqli_close($con);

        return $this->render('chart/ajax.html.twig', [
            'tempdata' => $tempdata,
            'hygrodata' => $hygrodata,
            'tempvalue' => $tempvalue,
            'hygrovalue' => $hygrovalue
        ]);
    }
}
