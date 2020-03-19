<?php

namespace App\Controller;

use App\Service\PublicsApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GeoApi;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(GeoApi $geoApi, Request $request, PublicsApi $publicsApi)
    {
        $resultCommune = "";
        $resultPublics = "";

        $postal = $request->request->get('postal');
        $commune = $request->request->get('commune');

        if ($postal && $commune) {
            $resultCommune = $geoApi->getCommune($postal, $commune);
            if ($resultCommune) {
                echo "OK<br>";
                $resultPublics = $publicsApi->getEtablissementsPublics($resultCommune);
            } else {
                echo "RIEN<br>";
            }
        }

        return $this->render('home/index.html.twig', [
            'commune' => $resultCommune,
            'etablissement' => $resultPublics
        ]);
    }
}
