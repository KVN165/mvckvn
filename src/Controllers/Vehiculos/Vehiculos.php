<?php

namespace Controllers\Vehiculos;

use \Dao\Vehiculos\Vehiculos as DaoVehiculos;

const SESSION_VEHICULOS_DATA = "vehiculos_search_data";

class Vehiculos extends \Controllers\PublicController{
    public function run(): void{
        $viewData = array();
        $viewData["datave"] = DaoVehiculos::getVehiculos();


        $viewData["search"] = $this->getSessionSearchData();
        if ($this->isPostBack()){
            $viewData["search"] = $this->getSearchData();
            $this->setSessionSearchData($viewData["search"]);
        }

        $viewData["datave"] = DaoVehiculos::readAllVehiculos($viewData["search"]);
        $viewData["total"] = count($viewData["datave"]);

        \Views\Renderer::render('vehiculos/lista', $viewData);
    }

    //sesiones total
    private function getSearchData(){
        if (isset($_POST["search"])){
            return $_POST["search"];
        }
        return "";
    }
    private function getSessionSearchData(){
        
        if (isset($_SESSION[SESSION_VEHICULOS_DATA])){
            return $_SESSION[SESSION_VEHICULOS_DATA];
        }
        return "";
    }

    private function setSessionSearchData($search){
        $_SESSION[SESSION_VEHICULOS_DATA] = $search;
    }

}