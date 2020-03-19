<?php


namespace App\Service;


class GeoApi
{
    public function getCommune($cp, $n)
    {

        // Initialisation de la session
        $cm = curl_init();

        // Configuration des options
        curl_setopt($cm, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cm, CURLOPT_URL, "https://geo.api.gouv.fr/communes?codePostal=".$cp."&nom=".$n."&fields=code&format=json");

        // Exécution de la session
        $resultat = curl_exec($cm);

        // Fermeture de la session
        curl_close($cm);

        $jsonData = json_decode($resultat,true);
        if (!empty($jsonData)) {
            return $val = $jsonData[0]['code'];
        }
        else {
            return $val = "";
        }
    }
}