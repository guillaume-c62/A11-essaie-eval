<?php
class Manager{
    // attributes
    private $db;
    const TABLE_NAME = 'vehicles';
    // constructor
    public function __construct(PDO $db){
        $this->setDb($db);
    }
    // setters
    public function setDb(PDO $db){
        $this->db = $db;
    }
    // methods
    public function createTable(){
        // [[[[[[ à compléter ]]]]]]
        $this->db->query(
        "CREATE TABLE IF NOT EXISTS `vehicles` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `model` varchar(80) NOT NULL,
          `builder` varchar(80) NOT NULL,
          `fuel` varchar(80) NOT NULL,
          `color` varchar(80) NOT NULL,
          `kilometer` int(11) NOT NULL,
          `immatriculation` varchar(16) NOT NULL,
          `technical_control` varchar(32) NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `immatriculation` (`immatriculation`)
        ) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8" );
    }
    /**
     * Vérifie la présense de la table des véhicules dans la base de données
     *
     * @return boolean retourne *false* en cas d'absence
     */
    public function existTable(){
        return $this->db->query('DESCRIBE '.Manager::TABLE_NAME);
        return false;
    }
    /**
     * Permet d'afficher le contenu de la table des véhicules
     *  - vérifie la présence de la table avec *existTable()*
     *
     * @return void
     */
    public function readTable(){

        if($this->existTable()){
            $sql=$this->db->prepare("SELECT * FROM `vehicles`");
            $sql->execute();
            $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch as $value){
                echo '<table>';
                echo'<thead>';
                echo'<tr>';
                echo'<th colspan="2"> haut du tableaux</th>';
                echo'</tr>';
                echo'</thead>';
                echo'<tbody>';
                echo'<tr>';
                echo'<td>'.$value['model'].'&nbsp'.$value['builder'].'&nbsp'.'</td>';
                echo'<td>'.$value['fuel'].'&nbsp'.$value['color'].'&nbsp'.'</td>';
                echo'</tr>';
                echo'</tbody>';
                echo '</table>';
            }
            // [[[[[[ à compléter ]]]]]]
            return $fetch;
        }
        else
            echo '<p style="text-align: center;">La table "'.Manager::TABLE_NAME.'" n\'existe pas</p>';
    }
    public function truncateTable(){
        $this->db->query("TRUNCATE `a11`.`vehicles`");
        // [[[[[[ à compléter ]]]]]]
    }
    public function dropTable(){
        $sql =$this->db->prepare ("DROP TABLE IF EXISTS `vehicles`");
        $sql->execute();
        // [[[[[[ à compléter ]]]]]]

    }
    /**
     * Permet d'ajouter une entrée dans la table des véhicules
     *
     * @param  Vehicle $vehicle un objet véhicule
     * @return void
     */
    public function create(Vehicle $vehicle){
        $sql = $this->db->prepare("INSERT INTO vehicles(model, builder, fuel, color, kilometer,immatriculation,technical_control) 
        VALUES (:param1, :param2, :param3, :param4, :param5,:param6,:param7)");
        $sql->bindValue(':param1', $vehicle->getModel(),PDO::PARAM_STR);
        $sql->bindValue(':param2', $vehicle->getBuilder(),PDO::PARAM_STR);
        $sql->bindValue(':param3', $vehicle->getFuel(),PDO::PARAM_STR);
        $sql->bindValue(':param4', $vehicle->getColor(),PDO::PARAM_STR);
        $sql->bindValue(':param5', $vehicle->getKilometer(),PDO::PARAM_INT);
        $sql->bindValue(':param6', $vehicle->getImmatriculation(),PDO::PARAM_STR);
        $sql->bindValue(':param7', $vehicle->getTechnical_control(),PDO::PARAM_STR);
        $sql->execute();
        return $vehicle;

        // [[[[[[ à compléter ]]]]]]

    }
    /**
     * Permet de sélectionner la première entrée dans la table des véhicules
     *
     * @return Vehicle retourne un objet véhicule
     */
    public function selectFirst(){
        $sql = $this->db->prepare('SELECT * FROM '.Manager::TABLE_NAME.' LIMIT 1');
    $sql->execute();
    $fetch=$sql->fetch(PDO::FETCH_ASSOC);

    $frist= new Vehicle;
    $frist->hydrate($fetch);
    return $frist;
        // [[[[[[ à compléter ]]]]]]

    }

    /**
     * Permet de modifier une entrée dans la table des véhicules
     *
     * @param  Vehicle $vehicle un objet véhicule
     * @return void
     */
    public function update(Vehicle $vehicle){
        $sql =$this->db->prepare ("UPDATE vehicles SET model=:param1, builder=:param2, fuel=:param3,color=:param4, kilometer=:param5,immatriculation=:param6, technical_control=:param7 WHERE id=:param8 ");
        $sql->bindValue(':param1',
        $vehicle->getModel(),
        PDO::PARAM_STR);
        $sql->bindValue(':param2',$vehicle->getBuilder(),PDO::PARAM_STR);
        $sql->bindValue(':param3',$vehicle->getFuel(),PDO::PARAM_STR);
        $sql->bindValue(':param4',$vehicle->getColor(),PDO::PARAM_STR);
        $sql->bindValue(':param5',$vehicle->getKilometer(),PDO::PARAM_INT);
        $sql->bindValue(':param6',$vehicle->getImmatriculation(),PDO::PARAM_INT);
        $sql->bindValue(':param7',$vehicle->getTechnical_control(),PDO::PARAM_STR);
        $sql->bindValue(':param7',$vehicle->getId(),PDO::PARAM_INT);
        // $sql->execute();
    }

    public function delete(Vehicle $vehicle){
        $sql =$this->db->prepare('DELETE FROM vehicles WHERE vehicles.immatriculation =:param1');
        $sql->bindvalue(':param1', $vehicle->getImmatriculation());

           //we delete the first  vehicles  by chosing the first immatriculation

        $sql->execute();
    }

    /**
     * Retourne la liste des véhicules d'un constructeur
     *  - classés par ordre croissant des modèles
     * 
     * @param  string $builder nom du constructeur (*Renault* par défaut)
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfVehiclesByBuilder(string $builder = 'Renault'){
        $sql=$this->db->prepare("SELECT*FROM vehicles
        WHERE builder = '$builder'");
        // print_r($sql);
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        $listOfVehicles=[];
        foreach($fetch AS $key){
            $value = new Vehicle();
            $value->hydrate($key);
            $listOfVehicles[]=$value;
            // var_dump($value);
        }
    return $listOfVehicles;
        $sql=$this->db->prepare("SELECT*FROM vehicles");
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retourne la liste des véhicules dont le contrôle technique est invalide
     * 
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfInvalidVehicles(){
        $sql=$this->db->prepare("SELECT*FROM vehicles WHERE technical_control ='invalide';");
        // print_r($sql);
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        $listOfInvalidVehicles=[];
        // var_dump($fetch);
        foreach($fetch AS $key){
            $value = new Vehicle();
            $value->hydrate($key);
            $listOfInvalidVehicles[]=$value;
        }
    return $listOfInvalidVehicles;

    }

    /**
     * Retourne la liste des véhicules essence
     * 
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfGasolineVehicles(){
        $sql=$this->db->prepare("SELECT*FROM vehicles WHERE fuel ='essence';");
        // print_r($sql);
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        $listOfGasolineVehicles=[];
        // var_dump($fetch);
        foreach($fetch AS $key){
            $value = new Vehicle();
            $value->hydrate($key);
            $listOfGasolineVehicles[]=$value;
        }
    return $listOfGasolineVehicles;
    }
    /**
     * Retourne la liste des véhicules par km
     *  - classés par ordre croissant des km
     * 
     * @param  int $kilometer nombre de km (0 par défaut)
     * @return array retourne une liste contenant des objets véhicules
     */
    public function listOfVehiclesByMoreKm(int $kilometer = 0){
        $sql=$this->db->prepare("SELECT*FROM vehicles WHERE kilometer >= 50000;");
        // print_r($sql);
        $sql->execute();
        $fetch=$sql->fetchAll(PDO::FETCH_ASSOC);
        $listOfVehiclesByMoreKm=[];
        // var_dump($fetch);
        foreach($fetch AS $key){
            $value = new Vehicle();
            $value->hydrate($key);
            $listOfVehiclesByMoreKm[]=$value;
        }
    return $listOfVehiclesByMoreKm;
    }
}
