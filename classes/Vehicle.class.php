<?php

class Vehicle{

    // Attributes
    private $id;
    private $model;
    private $builder;
    private $fuel;
    private $color;
    private $kilometer;
    private $immatriculation;
    private $technical_control;

    const FUEL_DIESEL = 'diesel';
    const FUEL_ESSENCE = 'essence';
    const FUEL_HYBRIDE = 'hybride';
    const FUEL_ELECTRIQUE = 'electrique';

    const VALID = 'valide';
    const INVALID = 'invalide';

    // Constructor
    public function __construct(){
        // $this->setId();
        $this->setModel('modele');
        $this->setBuilder('marque');
        $this->setFuel(Vehicle::FUEL_ESSENCE);
        $this->setColor('blanc');
        $this->setKilometer(0);
        $this->setImmatriculation('');
        $this->setTechnical_control(Vehicle::INVALID);
        // [[[[[[ compléter ci-dessus les autres attributs, voir le fichier read-table.png ]]]]]]
    }

    // Getters
        // [[[[[[ à compléter ]]]]]]
        public function getId(){
            return ($this->id);
        }
        public function getModel(){
            return ($this->model);
        }
        public function getBuilder(){
            return ($this->builder);
        }
        public function getFuel(){
            return ($this->fuel);
        }
        public function getColor(){
            return ($this->color);
        }
        public function getKilometer(){
            return ($this->kilometer);
        }
        public function getImmatriculation(){
            return ($this->immatriculation);
        }
        public function getTechnical_control(){
            return ($this->technical_control);
        }

    // Setters
        // [[[[[[ à compléter ]]]]]]
        public function setId(int $id){
            $this->id = $id;
        }
        public function setModel(string $model){
            $this->model = $model;
        }
        public function setBuilder(string $builder){
            $this->builder = $builder;
        }
        public function setFuel(string $fuel){
            $this->fuel = $fuel;
        }
        public function setColor(string $color){
            $this->color = $color;
        }
        public function setKilometer(int $kilometer){
            $this->kilometer = $kilometer;
        }
        public function setImmatriculation(string $immatriculation){
            $this->immatriculation = $immatriculation;
        }
        public function setTechnical_control(string $technical_control){
            $this->technical_control = $technical_control;
        }

    // Methods
    public function describe(){
        echo '
            <ul style="text-align: center;">
                <li>Modèle du véhicule: '.$this->getModel().'</li>
                <li>Immatriculation: '.$this->getImmatriculation().'</li>
                <li>Constructeur: '.$this->getBuilder().'</li>
                <li>Carburant: '.$this->getFuel().'</li>
                <li>Couleur: '.$this->getColor().'</li>
                <li>CT: '.$this->getTechnical_control().'</li>
                <li style="color: blue;">km: '.$this->getKilometer().'</li>
            </ul>
        ';
    }
    
    /**
     * Permet de compléter toutes les données de l'objet véhicule à partir d'un tableau associatif
     *
     * @param  mixed $tab un tableau associatif dont **les clés correspondent aux attributs de l'objet**
     * @return void
     */
    public function hydrate($tab){

        // [[[[[[ à compléter ]]]]]]
        if(isset($tab['id']) && !empty($tab['id']))
        {
            $this->setId($tab['id']);
        }
        if(isset($tab['model']) && !empty($tab['model']))
        {
            $this->setModel($tab['model']);
        }
        if(isset($tab['builder']) && !empty($tab['builder']))
        {
            $this->setBuilder($tab['builder']);
        }
        if(isset($tab['fuel']) && !empty($tab['fuel']))
        {
            $this->setFuel($tab['fuel']);
        }if(isset($tab['color']) && !empty($tab['color']))
        {
            $this->setColor($tab['color']);
        }
        if(isset($tab['kilometer']) && !empty($tab['kilometer']))
        {
            $this->setKilometer($tab['kilometer']);
        }
        if(isset($tab['immatriculation']) && !empty($tab['immatriculation']))
        {
            $this->setImmatriculation($tab['immatriculation']);
        }
        if(isset($tab['technical_control']) && !empty($tab['technical_control']))
        {
            $this->setTechnical_control($tab['technical_control']);
        }
       
        
        return ($tab);

    }

}
