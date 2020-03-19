<?php


namespace App\Service;


class PublicsApi
{
    public function getEtablissementsPublics($code)
    {

        // Initialisation de la session
        $cm = curl_init();

        // Configuration des options
        curl_setopt($cm, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cm, CURLOPT_URL, "https://etablissements-publics.api.gouv.fr/v3/communes/".$code."/accompagnement_personnes_agees");

        // Exécution de la session
        $resultat = curl_exec($cm);

        // Fermeture de la session
        curl_close($cm);

        $jsonData = json_decode($resultat,true);

        if (!empty($jsonData)) {
            return $val = $jsonData['features'];
        }
        else {
            return $val = "";
        }
    }
}