<?php

namespace Controllers\Vehiculos;

use \Dao\Vehiculos\Vehiculos as DaoVehiculos;
use \Utilities\Validators as Validators;
use \Utilities\Site as Site;

class Vehiculo extends \Controllers\PublicController{

    private $mode = "NAN";
    private $modeDscArr= [
        "INS" => "Nuevo Vehiculo",
        "UPD" => "Actualizando vehiculo %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s", 
    ];

    private $modeDsc = "";

    private $id_vehiculo = 0;
    private $marca = "";
    private $modelo = "";
    private $anofabric = 0;
    private $tipocombust = "";
    private $kilometraje = 0;

    private $errors = array();
    private $xsrftk = "";
    
    public function run(): void{
        $this->obtenerDatosDelGet();
        $this->getDatosFromDB();
        if ($this->isPostBack()){
            $this->obtenerDatosDePost();
            if(count($this->errors) === 0){
            $this->procesarAccion();
            }
        }
        $this->showView();
    }

    private function obtenerDatosDelGet(){
        if (isset($_GET["mode"])){
            $this->mode = $_GET["mode"];
        }
        if (!isset($this->modeDscArr[$this->mode])){
            throw new \Exception("Modo no valido");
        }
        if (isset($_GET["id_vehiculo"])){
            $this->id_vehiculo = intval($_GET["id_vehiculo"]);
        }
        if ($this->mode != "INS" && $this->id_vehiculo <= 0){
            throw new \Exception("ID no valido");
        }

    }

    private function getDatosFromDB(){
        if ($this-> id_vehiculo > 0){
            $vehiculo = DaoVehiculos::getVehiculos($this->id_vehiculo);
            if (!$vehiculo){
                throw new \Exception("Vehiculo no encontrado");
            }
            $this->marca = $vehiculo["marca"];
            $this->modelo = $vehiculo["modelo"];
            $this->anofabric = $vehiculo["anofabricacion"];
            $this->tipocombust = $vehiculo["tipo_combustible"];
            $this->kilometraje = $vehiculo["kilometraje"];
        }
        
    }

    private function obtenerDatosDePost(){
        $tempMarca = $_POST["marca"] ?? "";
        $tempModelo = $_POST["modelo"] ?? "";
        $tempAnoFab = $_POST["anofabricacion"] ?? "";
        $tempTipoComb = $_POST["tipo_combustible"] ?? "";
        $tempKilo = $_POST["kilometraje"] ?? "";
        $tempMode = $_POST["mode"] ?? "";

        if(Validators::IsEmpty($tempMarca)){
            $this->addError("marca", "La marca no puede estar vacia", "error");
        }
        $this->marca = $tempMarca;

        if(Validators::IsEmpty($tempModelo)){
            $this->addError("morelo", "El modelo no puede estar vacia", "error");
        }
        $this->modelo = $tempModelo;

        if(Validators::IsEmpty($tempAnoFab)){
            $this->addError("anofabricacion", "El Año de Fabricación no puede estar vacio", "error");
        }else if(!Validators::IsCurrency($tempAnoFab)){
            $this->addError("anofabricacion", "El Año no es valido", "error");
        }
        $this->anofabric = $tempAnoFab;

        if(Validators::IsEmpty($tempTipoComb)){
            $this->addError("tipo_combustible", "El tipo de combustible no puede estar vacio", "error");
        }
        $this->tipocombust = $tempTipoComb;


        if(Validators::IsEmpty($tempKilo)){
            $this->addError("kilometraje", "El kilometraje no puede estar vacio", "error");
        }else if(!Validators::IsInteger($tempKilo)){
            $this->addError("kilometraje", "El stock no es valido", "error");
        }
        $this->kilometraje = $tempKilo;

        if(Validators::IsEmpty($tempMode) || !in_array($tempMode,["INS", "UPD", "DEL"])){
            $this->throwError("Ocurrio un error al procesar la solicitud");
        } 

        
     }
     private function procesarAccion(){
            switch ($this->mode){
                case "INS":
                    $insResult = DaoVehiculos::createVehiculo(
                    $this->marca,
                    $this->modelo,
                    $this->anofabric,
                    $this->tipocombust,
                    $this->kilometraje,
                    );
                    $this->validateDBOperation(
                        "Vehiculo insertado correctamente",
                        "Ocurrio un error al insertar el vehiculo",
                        $insResult
                    );
                    break;
                case "UPD":
                    $updResult = DaoVehiculos::updateVehiculo(
                    $this->id_vehiculo,
                    $this->marca,
                    $this->modelo,
                    $this->anofabric,
                    $this->tipocombust,
                    $this->kilometraje,
                    );
                    $this->validateDBOperation(
                        "Vehiculo actualizado correctamente",
                        "Ocurrio un error al actualizar el vehiculo",
                        $updResult
                    );
                    break;
                case "DEL":
                    $delResult = DaoVehiculos::deleteVehiculo($this->id_vehiculo);
                    $this->validateDBOperation(
                        "Vehiculo eliminado correctamente",
                        "Ocurrio un error al eliminar el vehiculo",
                        $delResult
                    );
                    break;
            }
    }

    private function validateDBOperation($msg, $error, $result){
        if(!$result){
            $this->errors["error_general"] = $error;
        }else {
            Site::redirectToWithMsg(
                "index.php?page=Vehiculos-Vehiculos",
                $msg
            );
        }
    }

    private function throwError($msg){
        Site::redirectToWithMsg(
            "index.php?page=Vehiculos-Vehiculos",
            $msg

        );

     }
    private function addError($key, $msg, $context = "general"){
        if(!isset($this->errors[$context."_".$key])){
            $this->errors[$context."_".$key] = [];
        }
        $this->errors[$context."_".$key] [] = $msg;
    }

    private function showView(){
        $viewData = array();
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->modelo);
        $viewData["id_vehiculo"] = $this->id_vehiculo;
        $viewData["marca"] = $this->marca;
        $viewData["modelo"] = $this->modelo;
        $viewData["anofabricacion"] = $this->anofabric;
        $viewData["tipo_combustible"] = $this->tipocombust;
        $viewData["kilometraje"] = $this->kilometraje;
        $viewData["errors"] = $this->errors;
        \Views\Renderer::render("vehiculos/formulario", $viewData);
    }
}