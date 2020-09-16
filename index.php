<?php
require_once './settings/db.php';
require_once './classes/Manager.class.php';
require_once './classes/Vehicle.class.php';

$manager = new Manager($db);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eval PHPObjet</title>
    </head>
    <body>
        <!-- Table links -->
        <p style="text-align: center;">Table</p>
        <div style="margin: 0 0 30px 0; text-align: center;">
            <a href="index.php" ><=</a>&emsp;
            <a href="index.php?option=1">Créer</a>&emsp;

            <?php if($manager->existTable()): ?>

            <a href="index.php?option=2">Lire</a>&emsp;
            <a href="index.php?option=3">Vider</a>&emsp;
            <a href="index.php?option=4">Supprimer</a>
        </div>

        <hr />

        <!-- Vehicles links -->
        <p style="text-align: center;">Véhicules</p>
        <div style="margin: 0 0 10px 0; text-align: center;">
            <a href="index.php?option=5">Créer tout</a>&emsp;
            <a href="index.php?option=6">Décrire le 1er</a>&emsp;
            <a href="index.php?option=7">+ 1 km au 1er</a>&emsp;
            <a href="index.php?option=8">Supprimer le 1er</a>&emsp;
        </div>
        
        <div style="margin: 0 0 30px 0; text-align: center;">
            <a href="index.php?option=9">Liste des Renault</a>&emsp;
            <a href="index.php?option=10">Liste ct non valides</a>&emsp;
            <a href="index.php?option=11">Liste véhicules essence</a>&emsp;
            <a href="index.php?option=12">Liste km &#8805; 50 000</a>
        </div>

            <?php else: ?>
        </div>
            <?php endif; ?>

        <hr />

        <?php

        $center = 'style="text-align: center;"';

        $option = (isset($_GET['option'])) ? $_GET['option'] : null ;
        switch($option){
            case 1: // CREATE Table

                echo '<h1 '.$center.'>Créer</h1>';
                $manager->createTable();
                echo '<p '.$center.'>La table a été créée</p>';

                break;
            case 2: // READ Table
              
                echo '<h1 '.$center.'>Lire</h1>';
                $manager->readTable();

                break;
            case 3: // TRUNCATE Table

                echo '<h1 '.$center.'>Vider</h1>';
                $manager->truncateTable();
                echo '<p '.$center.'>La table a été vidée</p>';

                break;
            case 4: // DROP Table

                echo '<h1 '.$center.'>Supprimer</h1>';
                $manager->dropTable();
                echo '<p '.$center.'>La table a été supprimée</p>';

                break;
            case 5: // CREATE all vehicules
                echo '<h1 '.$center.'>Créer tout</h1>';
                $data = [
                    ["model" => "KADJAR", "builder" => "Renault", "fuel" => "Essence", "color" => "Blanc", "kilometer" => 0, "immatriculation" => "KZ-483-AN", "technical_control" => "Valide"],
                    ["model" => "TRAFIC", "builder" => "Renault", "fuel" => "Diesel", "color" => "Anthracite", "kilometer" => 2723, "immatriculation" => "JZ-9MA-8D", "technical_control" => "Valide"],
                    ["model" => "108", "builder" => "Peugeot", "fuel" => "Essence", "color" => "Kaki", "kilometer" => 59724, "immatriculation" => "J9-K18-P2"],
                    ["model" => "TALISMAN Estate", "builder" => "Renault", "fuel" => "Diesel", "color" => "Bleu marine", "kilometer" => 39808, "immatriculation" => "FA-491-CZ", "technical_control" => "Valide"],
                    ["model" => "208", "builder" => "Peugeot", "fuel" => "Essence", "color" => "Rouge foncé", "kilometer" => 6920, "immatriculation" => "AS-025-VE", "technical_control" => "Valide"],
                    ["model" => "ASTRA", "builder" => "Opel", "fuel" => "Diesel", "color" => "Noir", "kilometer" => 109047, "immatriculation" => "CQ-S77-EK"],
                    ["model" => "YETI", "builder" => "Skoda", "fuel" => "Diesel", "color" => "Rose crevette", "kilometer" => 136896, "immatriculation" => "DG-356-LY", "technical_control" => "Valide"],
                    ["model" => "KADJAR", "builder" => "Renault", "fuel" => "Essence", "color" => "Noir", "kilometer" => 48203, "immatriculation" => "AE-S21-KQ", "technical_control" => "Valide"],
                    ["model" => "E-class", "builder" => "Mercedes", "fuel" => "Diesel", "color" => "Blanc", "kilometer" => 78529, "immatriculation" => "ET-356-LK"],
                    ["model" => "Ducato", "builder" => "Fiat", "fuel" => "Diesel", "color" => "Noir", "kilometer" => 139730, "immatriculation" => "BY-303-HA", "technical_control" => "Valide"],
                    ["model" => "Hatch", "builder" => "Mini", "fuel" => "Essence", "color" => "Jaune", "kilometer" => 96294, "immatriculation" => "DC-632-TR", "technical_control" => "Valide"],
                    ["builder" => "Peugeot", "fuel" => "Essence", "color" => "Orange", "kilometer" => 16920, "immatriculation" => "AE-521-KQ", "technical_control" => "Valide"],
                    ["model" => "Sandero", "fuel" => "Essence", "color" => "Blanc", "kilometer" => 174329, "immatriculation" => "FF-992-ZZ"],
                    ["model" => "E-2008", "builder" => "Peugeot", "color" => "Bleu", "kilometer" => 8306, "immatriculation" => "DC-076-CT", "technical_control" => "Valide"],
                    ["model" => "C3", "builder" => "Citroën", "fuel" => "Essence", "kilometer" => 127292, "immatriculation" => "ET-277-VL"],
                    ["model" => "ZOÉ", "builder" => "Renault", "fuel" => "Électrique", "color" => "Bordeau", "immatriculation" => "FB-080-SK", "technical_control" => "Valide"],
                    ["model" => "Prius", "builder" => "Toyota", "fuel" => "Hybride", "color" => "Gris Foncé", "kilometer" => 203927, "immatriculation" => "AF-515-AT"]
                ];
                // $vehicle = new Vehicle();
                // $vehicle->hydrate($data);
                // $manager->create($vehicle);
             $line=0;
                foreach($data AS $line){
                $vehicle = new Vehicle();
                $vehicle->hydrate($line);
                $manager->create($vehicle);
                $line++;

                    // $value->describe();
                    // return $data;
                }
                // return $data;






                echo '<p '.$center.'>Tous les véhicules ont été ajoutés</p>';

                break;
            case 6: // Describe first vehicle

                echo '<h1 '.$center.'>Décrire le 1er</h1>';
                $vehicle = $manager->selectFirst();
                $vehicle->describe();

                break;
            case 7: // UPDATE first vehicle (km + 1)

                echo '<h1 '.$center.'>Décrire le 1er</h1>';
                $vehicle = $manager->selectFirst();
                $vehicle->describe();

                echo '<h2 '.$center.'>+ 1 km</h2>';
                // [[[[[[ à compléter ]]]]]]
                 $manager = new Manager($db);
                $ToUpdate = $manager->selectFirst();
                $kmToUpdate =  $ToUpdate->getKilometer();
                $kmToUpdate = $kmToUpdate + 1;

                $updateVehicule =[
                    'id'=>$ToUpdate->getId(),
                    'km'=>$kmToUpdate
                ];

                $updateObjet = new Vehicle();
                $updateObjet->hydrate($updateVehicule);
                
                $manager->update($updateObjet);
                $ToUpdate = $manager->selectFirst();
                $updateObjet->describe();

                break;
            case 8: // DELETE first vehicle

                echo '<h1 '.$center.'>Supprimer le 1er</h1>';
                $manager->delete($manager->selectFirst());
                echo '<p '.$center.'>Le véhicule a été supprimé</p>';

                break;
            case 9: // List: Renault

                echo '<h1 '.$center.'>Liste des Renault</h1>';
                $listOfVehicles = $manager->listOfVehiclesByBuilder();

                foreach($listOfVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                            $vehicle->getModel().' ('.$vehicle->getImmatriculation().')
                        </p>
                    ';
                }

                break;
            case 10: // List: invalid vehicles

                echo '<h1 '.$center.'>Liste des ct non valides</h1>';
                $listOfInvalidVehicles = $manager->listOfInvalidVehicles();

                foreach($listOfInvalidVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                            $vehicle->getBuilder().' '.$vehicle->getModel().' ('.$vehicle->getImmatriculation().')
                        </p>
                    ';
                }

                break;
            case 11: // List: gasoline vehicles

                echo '<h1 '.$center.'>Liste des véhicules essence</h1>';
                $listOfGasolineVehicles = $manager->listOfGasolineVehicles();

                foreach($listOfGasolineVehicles as $vehicle){
                    echo '
                        <p '.$center.'>'.
                            $vehicle->getBuilder().' '.$vehicle->getModel().' ('.$vehicle->getImmatriculation().')
                        </p>
                    ';
                }

                break;
            case 12: // List: km > 50000

                echo '<h1 '.$center.'>Liste des véhicules &#8805; 50 000 km</h1>';
                $listOfVehiclesByMoreKm = $manager->listOfVehiclesByMoreKm(50000);

                foreach($listOfVehiclesByMoreKm as $vehicle){
                    echo '
                        <p '.$center.'>'.
                            $vehicle->getBuilder().' '.$vehicle->getModel().' ('.$vehicle->getImmatriculation().') '.$vehicle->getKilometer().' km
                        </p>
                    ';
                }

                break;
            default:
                echo '<h1 '.$center.'>WrommMM!</h1>';
        }

        ?>
    </body>
</html>
