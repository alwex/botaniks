<?php
class Application_Model_Plante extends Application_Model_Abstract
{
    protected $_name = "plante";
    
    public $c_id;
    public $c_nom;
    
    public function setNom($nom)
    {
        $this->c_nom = $nom;
    }
    
    public function getNom()
    {
        return $this->c_nom;
    }
}

